<?php

namespace application\libraries;

use PDO;

class PdoDriver implements IDriver{

    public $connection;

    public function __construct($server, $database, $user, $password)
    {
        $this->connection = new PDO(sprintf('mysql:host=%s;dbname=%s',$server,$database),$user,$password);
    }


    public function getConnection()
    {
        return $this->connection;
    }

    public function find($table, $id = 0)
    {
        // TODO: Implement find() method.
    }

    public function insert($table, $data)
    {
        // TODO: Implement insert() method.
    }

    public function update($table, $data, $condition, $comparator = 'AND')
    {
        // TODO: Implement update() method.
    }

    public function delete($table, $id)
    {
        // TODO: Implement delete() method.
    }

    public function __destruct()
    {
       $this->connection=null;
    }
}

//prepare($query)
//execute($data)
//setFetchMode(PDO::FETCH_CLASS, $model);