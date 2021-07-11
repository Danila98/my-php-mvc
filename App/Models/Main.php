<?php

namespace App\Models;
use App\Core\Model;

class Main extends Model{
    
    public function __construct()
    {
        parent::__construct();
        dd($this->db);
    }

}