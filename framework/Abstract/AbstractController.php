<?php

namespace Framework\Abstract;

use Framework\FlashMessage;
use Framework\Kernel;

abstract class AbstractController extends Kernel
{

    public function getParameter(string $name)
    {
        return $this->environment($name);
    }

    public function setFlashMessage($type, $message){
        FlashMessage::setFlashMessage($type, $message);
    }

    public function render(string $page, array $data = [])
    {
        return $this->twig($page, $data);
    }

    public function redirect(string $url, bool $replace = true, int $httpCode = 0)
    {
        return header('Location: '.$_SERVER["router"][$url]["path"], $replace, $httpCode);
    }

}