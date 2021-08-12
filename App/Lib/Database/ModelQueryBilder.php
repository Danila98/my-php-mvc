<?php

namespace App\Lib\Database;
use PDO;
use Core\Model;


class ModelQueryBilder extends TableQueryBilder{

/* По задумке методы должны возвращать массив моделей, так как этот класс будет использоваться в модели */
    protected $sql = '';
    protected $db;
    protected $data;
    
    public function __construct(PDO $pdo, string $table, string $modelName)
    {
        parent::__construct($pdo, $table);
        $this->modelName = $modelName;
    }

    public function row()
    {
        $result = $this->db->prepare($this->sql);
        $result->execute();
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
        $result = $this->db->prepare($this->sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);

    }

    public function col()
    {
        $result = $this->db->prepare(); 
        $result->execute();
        return $result->fetchColumn();
    }


}