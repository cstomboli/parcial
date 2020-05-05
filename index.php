<?php

include 'vendor/autoload.php';
include 'metod.php';

$metod= new Metod($_SERVER ['REQUEST_METHOD'], $_SERVER ['PATH_INFO']);
$metod->Conexion();
