<?php

namespace application\libraries;

use mysqli;


class MySQLiDriver implements IDriver
{

    public $connection;

    public function __construct($server, $database, $user, $password)
    {
        $this->connection = new mysqli($server, $user, $password, $database);

        if ($this->connection->connect_error) {
            throw new \Exception('No connect');
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function find($table, $id = 0)
    {
        $result = NULL;
        if ($id) {
            $query = sprintf('SELECT * FROM %s WHERE id=%d', $table, $id);

            $resultQuery = $this->getConnection()->query($query);

            $result = $resultQuery->fetch_assoc();
        } else {
            $query = sprintf('SELECT * FROM %s', $table);

            $resultQuery = $this->getConnection()->query($query);

            while ($res = $resultQuery->fetch_assoc()) {
                $result[] = $res;
            }
        }

        return $result;
    }

    public function __destruct()
    {
        $this->getConnection()->close();
    }
}