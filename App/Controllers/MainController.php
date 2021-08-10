<?php


namespace App\Controllers;
use App\Core\Controller;
use App\Models\Main;
class MainController extends Controller{
    
    public function indexAction()
    { 
        
        $main = new Main();
        $mains = $main->select()->row();

        foreach($mains as $main){

            dd($main->name);
        }
        $this->view->render('главная');
    }
}