<?php

namespace app\Controller;

class HomeController
{
    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('home.html');

        $data = array();

        echo $twig->render($template, $data);;
    }
}
