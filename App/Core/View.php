<?php 

namespace App\Core;

class View {
    protected $path;
    protected $layout = 'default';
    protected $route;

    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['controller'].'/'.$route['action'];
    }

    public function render(string $title, array $vars = [])
    {
        if($vars > 0){
            extract($vars);
        }
        if(file_exists('App/View/Layouts/'.$this->layout.'.php')){
            ob_start();
            require_once 'App/View/'.$this->path.'.php';
            $content = ob_get_clean();
            require_once 'App/View/Layouts/'.$this->layout.'.php';
        }else{
            echo 'Нет такого шаблона'.'App/View/Layouts/'.$this->layout.'.php';
            View::errorCode(404);
        }
    }
    public static function redirect($url){
        header('location: '.$url);
        exit;
    }
    public static function errorCode($code)
    {
        http_response_code($code);

        require_once 'App/View/Errors/'.$code.'.php';

        exit;
    }
    
}