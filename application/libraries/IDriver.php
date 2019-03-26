<?php

namespace application\libraries;

interface IDriver {
    public function __construct($server,$database,$user,$password);

    public function getConnection();

    public function __destruct();

    public function find($table,$id=0);
}