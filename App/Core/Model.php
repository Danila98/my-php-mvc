<?php

namespace App\Core;

use App\Lib\Database\Db;
use App\Lib\Database\ModelQueryBilder as QueryBilder;

abstract class Model{

    protected  $db;
    protected  $table;
    protected  $fullable;

    public function __get($propetry)
    {
        if(isset($this->fullable[$propetry])){
            return $this->fullable[$propetry];
        }else{
            return null;
        }
    }
    public function __construct()
    {
        $this->db = new QueryBilder(Db::getConnetction(), $this->table, get_called_class());
        if(count($this->fullable) > 0){
            $newLabels = [];
            foreach($this->fullable as $label){
                $newLabels[$label] = null; 
            }
            $this->fullable = $newLabels;
        }
        
    }
    public function setLabel($label, $value)
    {
        $this->fullable[$label] = $value;
    }
    public function select($col = "*")
    {
        return $this->db->select($col);
    }
    public function create(array $vars)
    {
        return $this->db->create($vars);
    }
    public function update()
    {
        return $this->db->update($this->fullable);
    }
    public function delete()
    {
        return $this->db->delete($this->table);
    }
    public function row()
    {
        return $this->db->row($this->table);
    }
    public function col()
    {
        return $this->db->col($this->table);
    }
}