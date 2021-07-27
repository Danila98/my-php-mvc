<?php

namespace App\Core;

use App\Lib\Db;
use App\Lib\QueryBilder;

abstract class Model{

    protected  $db;
    protected  $table = 'das';
    protected  $fullable;

    public function __construct()
    {
        $this->db = new QueryBilder(Db::getConnetction());
        
    }
    public static function select()
    {
        return $this->db->select($this->table);
    }
    public function create(array $vars)
    {
        return $this->db->create($this->table, $vars);
    }
    public static function update()
    {
        return $this->db->update($this->table);
    }
    public static function delete()
    {
        return $this->db->delete($this->table);
    }
}