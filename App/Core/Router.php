<?php

namespace App\Core;


class Router {

    protected $routes = []; 
    protected $params = []; 
    
    
    public function __construct(){
        $routes = require ('App\Config\Routes.php');
        foreach($routes as $route => $param){
            $this->add($route, $param);
        }
    }

    public function add($route, $params){
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }
    
    public function match() : bool { 
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach($this->routes as $route => $params){
            if(preg_match($route, $url, $matches)){
                $this->params = $params;
                return true;
            }
        }
        return false;
    }
    
    public function run(){
        if($this->match()){
            $path = 'App\Controllers\\'.ucfirst($this->params['controller']).'Controller';
            if(class_exists($path)){
                $action = $this->params['action'].'Action';
                if(method_exists($path, $action)){
                    $controller = new $path($this->params);
                    $controller->$action();
                }
                else{
                    echo($action.' не определен');
                    View::errorCode(404);
                }
            }else{
                echo('Контроллер не найден: '. $path);
                View::errorCode(404);
            }
        }else {
            echo('Маршрут не найден');
            View::errorCode(404);
        }
    }
}