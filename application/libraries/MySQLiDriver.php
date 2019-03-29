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

    /**
     * @param $table = 'employee'
     * @param $data = [
     * 'firstname'=>'qwe',
     *  'lastname'=>'',
     * ]
     */
    public function insert($table, $data)
    {

        $result = null;
        $keys = array_keys($data);
        $values = array_values($data);

        $query = sprintf(
            'INSERT INTO %s (%s) VALUES (\'%s\')',
            $table,
            implode(', ',$keys),
            implode('\', \'',$values)
        );

        $resultQuery = $this->getConnection()->query($query);

        if($resultQuery) {
            $result = $this->getConnection()->insert_id;
        }
        return $result;

    }

    public function update($table, $data, $condition, $comparator = 'AND')
    {
        $result = null;
        $keys = array_keys($data);
        $values = array_values($data);

        $keysCondition = array_keys($condition);
        $valuesCondition = array_values($condition);

        $dataStr = array_map(
            function ($key,$value){
                return $key." = '".$value."'";
            },
            $keys,
            $values
        );

        $conditionStr = array_map(
            function ($key,$value){
                return $key." = '".$value."'";
            },
            $keysCondition,
            $valuesCondition
        );


        $comparator = " ".strtoupper($comparator)." ";
        $query = sprintf(
            'UPDATE %s SET %s WHERE %s',
            $table,
            implode(', ',$dataStr),
            implode($comparator,$conditionStr)
        );

        $resultQuery = $this->getConnection()->query($query);

        if($resultQuery) {
            $result = true;
        }
        return $result;

    }

    public function delete($table, $id)
    {


        $queryStr = sprintf('DELETE FROM %s WHERE id= ?',$table);
        $query = $this->getConnection()->prepare($queryStr);
        $query->bind_param('i',$id);
        $query->execute();

        return $query->get_result();

    }

    public function __destruct()
    {
        $this->getConnection()->close();
    }
}

//$query = prepare($query)
//$query->bind_param('i', $id);
//$query->execute();
//
//$data = $query->get_result();
//$result = $data->fetch_assoc();