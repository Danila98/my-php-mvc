<?php

namespace App\Lib\Database;
use PDO;
use Core\Model;


class TableQueryBilder implements IQueryBilder{


    protected $sql = '';
    protected $db;
    protected $data = '';
    public function __construct(PDO $pdo, string $table)
    {
        $this->db = $pdo;
        $this->table = $table;
    }
    /*Временное решение*/
    public function setSql(string $sql)
    {
        $this->sql = $sql;
    }
    public function query()
    {
        $stmt = $this->db->prepare($this->sql);
        $stmt->execute($this->data);
        return $stmt;
    }


    public function row()
    {
        $result = $this->db->prepare($this->sql);
        $result->execute();
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
 
        return $rows; 
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
    public function where(string $label, string $operator, $value)
    {
        $this->sql += " WHERE $label $operator $value";
    }
    public function orderBy(string $label)
    {
        $this->sql += " ORDER BY $label";
    }
    public function limit(int $limit)
    {
        $this->sql += " LIMIT  $limit";
    }
    public function select(string $col = "*")
    {
        $this->sql = "SELECT $col FROM {$this->table}";
        return $this;
    }
    public function create(array $vars)
    {
        
        $keys = implode(',', array_keys($vars));
        $tags = ":".implode(', :', array_keys($vars));
        $this->data = $vars;
        $this->sql = "INSERT INTO {$this->table} ($keys) VALUES ($tags)";
        
        
        return $this;
    }
    public function update(array $vars)
    {
        $this->sql = "UPDATE {$this->table} SET ";

        return $this;
    }

    public function delete(int $id)
    {
        # code...
        return $this;
    }


}