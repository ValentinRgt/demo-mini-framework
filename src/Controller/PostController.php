<?php

namespace App\Controller;

use Framework\Abstract\AbstractController;

class PostController extends AbstractController {

    public function get(string $slug, int $id) {
        echo $this->render("post.html.twig", [
            "id" => $id,
            "slug" => $slug
        ]);
    }

}