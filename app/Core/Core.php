<?php

namespace app\Core;

class Core
{
    private $controller;
    private $action;
    private $params;

    public function __construct()
    {
        $this->controller = 'app\\Controller\\HomeController';
        $this->action = 'index';
        $this->params = array();
    }

    public function start($url)
    {
        if (isset($url['url'])) {
            $url = explode('/', $url['url']);

            $this->controller = 'app\\Controller\\' . ucfirst($url[0]) . 'Controller';
            array_shift($url);

            if (isset($url[0]) && $url[0] != '') {
                $this->action = $url[0];
                array_shift($url);
            }

            if (!class_exists($this->controller)) {
                $this->controller = 'app\\Controller\\' .  'ErroController';
                $this->title = 'Página não encontrada';
            }

            $this->params = $url;
        }

        $this->controller = new $this->controller;

        if (!method_exists($this->controller, $this->action)) {
            $this->action = 'index';
        }

        call_user_func_array(array($this->controller, $this->action), $this->params);
    }
}
