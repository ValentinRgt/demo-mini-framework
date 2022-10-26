<?php

namespace App\Controller;

use Framework\Abstract\AbstractController;
use Framework\Request;

class LoginController extends AbstractController {

    public function index() {
        echo $this->render("login.html.twig");
    }

    public function login() {
        $request = new Request();

        $error = true;
        if(!empty($request->request()->get("email")) && $request->request()->get("email") == "john.doe@john.com"){
            $error = false;
        }

        if(!empty($request->request()->get("password")) && $request->request()->get("password") == "john.doe"){
            $error = false;
        }

        if($error){
            $this->setFlashMessage("danger", "The identifiers are not valid");
        } else {
            setCookie("logged", true, time() + 3600*24, "/", $_SERVER["HTTP_HOST"], false, false);
            $this->setFlashMessage("success", "You are connected");
        }


        echo $this->redirect("login");
    }

    public function logout() {
        setCookie("logged", false, -1, "/", $_SERVER["HTTP_HOST"], false, false);


        echo $this->redirect("login");
    }

}