<?php

namespace App\Controller;

use Framework\Abstract\AbstractController;

class HomeController extends AbstractController {

    public function index() {
        echo $this->render("home.html.twig");
    }

}