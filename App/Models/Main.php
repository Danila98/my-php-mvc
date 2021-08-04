<?php

namespace App\Models;
use App\Core\Model;

class Main extends Model{
    
    protected $table =  'mains';
    protected $fullable = ['id', 'name', 'description', 'price']; 

    public function __construct()
    {
        parent::__construct();
        $this->table = 'mains';
    }

}