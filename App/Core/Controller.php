<?php

namespace App\Core;
use  App\Core\View;
abstract class Controller {

    protected $param_request;
    protected $view;
    protected $modal;

    public function __construct($param_request){
        $this->param_request = $param_request;
        $this->view = new View($param_request);
        $this->modal = $this->loadModel($param_request['controller']);
    }

    public function loadModel(string $name)
    {
        $path = 'App\Models\\'.ucfirst($name);
        if(class_exists($path)){
            return new $path;
        }
    }
}