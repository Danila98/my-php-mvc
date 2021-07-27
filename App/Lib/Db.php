<?php 

namespace App\Lib;

use PDO;

class Db{

    protected $db;

    public function __construct()
    {
       
    }

    public static function getConnetction(Type $var = null)
    {
        $config = include('App\Config\db.php');
        $db =new PDO ('mysql:host='. $config['host'] . ';dbname=' . $config['dbname'], $config['user'], $config['password']);
        return $db;
    }


}