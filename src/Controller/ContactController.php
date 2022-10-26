<?php

namespace App\Controller;

use Framework\Abstract\AbstractController;
use Framework\Request;

class ContactController extends AbstractController {

    public function index() {
        echo $this->render("contact.html.twig");
    }

    public function send() {
        $request = new Request();

        $error = false;
        if(empty($request->request()->get("firstname"))){
            $error = true;
        }

        if(empty($request->request()->get("lastname"))){
            $error = true;
        }

        if(empty($request->request()->get("email"))){
            $error = true;
        }

        if(empty($request->request()->get("message"))){
            $error = true;
        }

        if($error){
            $this->setFlashMessage("danger", "You have filled in the form incorrectly");
        } else {
            $this->setFlashMessage("success", "Your message has been submitted");
        }

        echo $this->redirect("contact");
    }

}