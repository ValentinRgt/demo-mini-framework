<?php

namespace Framework;

use Symfony\Component\Dotenv\Dotenv;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;
use Bramus\Router\Router;
use Twig\Extension\DebugExtension;

class Kernel
{
    private array $routes = [];

    public function start()
    {
        // load env file
        $this->loadEnv();

        // Load routes
        $this->loadRoutes();
    }

    private function loadEnv(){
        $dotenv = new Dotenv();
        $dotenv->load("../.env");
    }

    private function loadRoutes()
    {
        try {
            $yaml = Yaml::parseFile('../config/routes.yaml');
            $router = new Router();
            foreach ($yaml as $routeName => $routeValue) {
                $methods = [];
                foreach ($routeValue["methods"] as $methodValue) {
                    switch ($methodValue) {
                        case 'GET':
                            $router->get($routeValue["path"], $routeValue["controller"]);
                            break;
                        
                        case 'POST':
                            $router->post($routeValue["path"], $routeValue["controller"]);
                            break;
                        
                        case 'PATCH':
                            $router->patch($routeValue["path"], $routeValue["controller"]);
                            break;

                        case 'DELETE':
                            $router->delete($routeValue["path"], $routeValue["controller"]);
                            break;

                        case 'OPTIONS':
                            $router->options($routeValue["path"], $routeValue["controller"]);
                            break;

                        case 'PUT':
                            $router->put($routeValue["path"], $routeValue["controller"]);
                            break;
                        
                        default:
                            $router->get($routeValue["path"], $routeValue["controller"]);
                            $router->post($routeValue["path"], $routeValue["controller"]);
                            break;
                    }
                    $methods[] = $methodValue;
                }
                $options = [];
                if(isset($routeValue["options"])){
                    $options = $routeValue["options"];
                }
                $this->routes += [
                    $routeName => [
                        "path" => $routeValue["path"],
                        "_controller" => $routeValue["controller"],
                        "methods" => $methods,
                        "options" => $options
                    ]
                ];
            }

            $_SERVER["router"] = $this->routes;

            $router->set404(function() { die('404 Not Found'); });
        
            $router->run();

        } catch (ParseException $e) {
            printf('Unable to parse the YAML string: %s', $e->getMessage());
        }
    }

    public function environment(string $name)
    {
        return $_ENV[$name];
    }

    public function twig(string $page, array $data = [])
    {
        $loader = new FilesystemLoader('../templates');

        $yaml = Yaml::parseFile('../config/twig.yaml');

        foreach ($yaml["path"] as $key => $value) {
            $loader->addPath($value, $key);
        }

        if($_ENV["APP_ENV"] == "dev" || $_ENV["APP_DEBUG"] == true){
            $twigRender = new Environment($loader);
        }else{
            $twigRender = new Environment($loader, [
                'cache' => '../var/cache/twig',
                'charset' => 'utf-8'
            ]);
        }

        $twigRender->addGlobal('app', new App());
        $path = new \Twig\TwigFunction('path', function (string $url, array $data = []) {
            $url = $_SERVER["router"][$url]["path"];
            foreach ($data as $key => $value) {
                $url = str_replace("{".$key."}", $value, $url);
            }
            return $url; 
        });
        $twigRender->addFunction($path);
        $random = new \Twig\TwigFunction('random', function (int $length = 5) {
            return substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, $length);
        });
        $twigRender->addFunction($random);
        $twigRender->addExtension(new DebugExtension());

        return $twigRender->render($page, $data);
    }

}