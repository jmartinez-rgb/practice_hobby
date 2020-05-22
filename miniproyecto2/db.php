<?php

define('_DATABASE_NAME','MiniProject');
define('_DATABASE_PASSWORD','');
define('_DATABASE_USER_NAME','root');
define('_HOST_NAME','localhost');

$MySQLiconn = new MySQLI(_HOST_NAME, _DATABASE_USER_NAME, _DATABASE_PASSWORD, _DATABASE_NAME);

if($MySQLiconn->connect_errno){
    die("Error: ".$MySQLI->connect_errno);
}