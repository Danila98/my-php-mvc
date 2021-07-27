<?php


namespace App\Controllers;
use App\Core\Controller;
use App\Models\Main;
class MainController extends Controller{
    
    public function indexAction()
    { 
        $main = new Main();
        $main->create(['name' => 'Вася', 'description' => 'test', 'price' => 20]);
        $this->view->render('главная');
    }
}