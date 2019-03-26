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

    public function __destruct()
    {
       $this->connection=null;
    }
}