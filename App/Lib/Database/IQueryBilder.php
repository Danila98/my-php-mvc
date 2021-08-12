<?php

namespace App\Lib\Database;
use PDO;
use Core\Model;


interface IQueryBilder{

    public function query();
    public function row();
    public function first();
    public function col();

    public function where(string $label, string $operator, $value);
    public function orderBy(string $label);
    public function limit(int $limit);

    public function select(string $col);
    public function create(array $vars);
    public function update(array $vars);
    public function delete(int $id);
}