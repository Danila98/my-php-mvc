<?php


namespace App\Controllers;
use App\Core\Controller;
class AccountController extends Controller{
    
    public function loginAction()
    {
        $this->view->render('главная');
    }
    public function registerAction()
    {
        $this->view->render('главная');
    }
}