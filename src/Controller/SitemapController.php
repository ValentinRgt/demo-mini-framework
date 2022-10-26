<?php

namespace App\Controller;

use DateTime;
use Framework\Abstract\AbstractController;

class SitemapController extends AbstractController {

    public function index() {
        $urls = [];
        $i = 0;
        foreach ($_SERVER["router"] as $row) {
            if(isset($row["options"]["sitemap"]) && $row["options"]["sitemap"] == true){
                $urls += [
                    $i => [
                        "url" => $row["path"],
                        "lastmod" => (new DateTime())->format("Y-m-d"),
                        "changefreq" => "daily",
                        "priority" => "1.0"
                    ]
                ];
                $i++;
            }
        }
        header('Content-Type: application/xml');
        echo $this->render("sitemap.xml.twig", ["urls" => $urls]);
    }

}