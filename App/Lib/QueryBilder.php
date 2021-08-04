<?php

namespace App\Lib;
use PDO;
use Core\Model;


class QueryBilder{


    protected $sql = '';
    protected $db;
    public function __construct( $pdo)
    {
        $this->db = $pdo;
    }

    public function query()
    {
        $stmt = $this->db->query($this->sql);
        return $stmt;
    }


    public function row()
    {
        $result = $this->query($this->sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        $models = [];
        foreach($rows as $row){
            $model = new $this->modelName;
            foreach($row as $label => $value){
                $model->setLabel($label, $value);
            }
            $models[] = $model;
        }
        
        return $models; 
    }

    public function first(){
        $result = $this->query($this->sql);
        $result->fetchAll(PDO::FETCH_ASSOC);

    }

    public function col()
    {
        $result = $this->query(); 
        return $result->fetchColumn();
    }
    public function select(string $modelName, string $table, $col = "*")
    {
        $this->modelName = $modelName;
        $this->sql = "SELECT $col FROM $table";
        return $this;
    }
    public function create(string $table, array $vars)
    {
        
        $this->sql = "INSERT INTO $table ";
        $labes ='';
        $values = '';
        $count = 0;
        foreach($vars as $label => $value) {
            if ($count === 0){
                $labes .= '('.$label.', ';
                $values .= "('".$value."', ";
            }elseif($count === count($vars) - 1){
                $labes .= $label.')';
                $values .= "'".$value."')";
            }else{
                $labes .= $label.', ';
                $values .= "'".$value."', ";
            }
            $count++;
        }

        $this->sql .= $labes.' VALUES '.$values;
        
        return $this;
    }
    public function update(Model $model)
    {
        $this->sql = "UPDATE $model->table SET ";
        $values = '';
        $count = 0;
        foreach($model->fullable as $label => $value) {

            if($label !== 'id'){
                if($count === count($vars) - 1){
                    $values .= "$label = $value,";
                }else{
                    $values .= "`$label` = '$value'";
                }
            }
            $count++;
        }

        $this->sql .= $values;
        dd($this->sql);
        return $this;
    }

    public function delete()
    {
        # code...
        return $this;
    }


}