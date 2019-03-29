<?php

namespace application\libraries;

interface IDriver
{
    public function __construct($server, $database, $user, $password);

    public function getConnection();

    public function __destruct();

    public function find($table, $id = 0);

    public function insert($table, $data);

    public function update($table, $data, $condition, $comparator = 'AND');

    public function delete($table, $id);
}