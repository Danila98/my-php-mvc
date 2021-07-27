<?php

namespace App\Core;
use  App\Core\View;
abstract class Controller {

    protected $route;
    protected $view;
    protected $modal;

    function __call(string $name, array $arguments){
        echo(' Нет такого метода '.$name.'()');
        die();
    }
    public function __construct($route){
        $this->route = $route;
        $this->view = new View($route);
        $this->modal = $this->loadModel($route['controller']);
    }

    public function loadModel(string $name)
    {
        $path = 'App\Models\\'.ucfirst($name);
        if(class_exists($path)){
            return new $path;
        }
    }
}