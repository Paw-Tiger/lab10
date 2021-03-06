<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once(__DIR__ . '/Autoload.php');
spl_autoload_register(['Autoload', 'loader']);

$config = require(__DIR__ . '/config.php');

use application\libraries\MySQLiDriver;
use application\libraries\PdoDriver;

try{

    $MySQLi = new MySQLiDriver($config['host'],$config['dbname'],$config['username'],$config['password']);

    $testFind = $MySQLi->find('employees',2);
    $testFindAll = $MySQLi->find('employees');
    $data = [
        'firstname'=>'Petro',
        'lastname'=>'Petrovich',
        'title'=>'Secretary',
        'age'=>30,
        'salary'=>10000,
    ];
    $condition = [
        'id'=>11
    ];
//    $insert = $MySQLi->insert(
//        'employees',
//        $data
//    );
//    var_dump($insert);
    $update = $MySQLi->update(
        'employees',
        $data,
        $condition
    );

    $delete = $MySQLi->delete(
        'employees',
        111
    );

    var_dump($delete);
//    var_dump($testFind);
//    var_dump($testFindAll);

}catch (Exception $exception){
    $e->getMessage();
}


//$Pdo = new PdoDriver($config['host'],$config['dbname'],$config['username'],$config['password']);
//
//var_dump($Pdo);