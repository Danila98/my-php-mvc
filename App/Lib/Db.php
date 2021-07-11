<?php 

namespace App\Lib;

use PDO;

class Db{

    protected $db;

    public function __construct()
    {
       $config = require_once('App\Config\db.php');
       $dsn = 'mysql:host='.$config['host'].';dbname='.$config['name'].'';
       $this->db = new PDO($dsn, $config['user'], $config['password']);
    }

    public function query($sql, $params =[])
    {
        $stmt = $this->db->prepare($sql);
        
        if(!empty($params)){
            foreach($params as $param => $val){
                $stmt->bindValue(':'.$key, $val);
            }
        }
        $stmt->execute();

        return $stmt;
    }


    public function row($sql, $params =[])
    {
       $result = $this->query($sql, $params);
       return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function col($sql, $params =[])
    {
       $result = $this->query($sql, $params);
       return $result->fetchColumn();
    }
}