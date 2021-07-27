<?php

namespace App\Lib;



class QueryBilder{


    protected $sql = '';
    protected $db;
    public function __construct( $pdo)
    {
        $this->db = $pdo;
    }

    public function query( $params =[])
    {
        
        $stmt = $this->db->query($this->sql);
        
        // if(!empty($params)){
        //     foreach($params as $param => $val){
        //         $stmt->bindValue(':'.$key, $val);
        //     }
        // }
        // $stmt->execute();
        dd( $this->db );
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
    public function select(Type $var = null)
    {
        # code...
    }
    public function create($table, $vars)
    {
        
       
        
        $this->query();
    }
    public function update(Type $var = null)
    {
        # code...
    }

    public function delete(Type $var = null)
    {
        # code...
    }


}