<?php

require "functions.php";
require "config/database.php";
require __DIR__ . "/../vendor/autoload.php";

//CONECTAR DB
$db = conectarDB();
use App\Propiedad;

Propiedad::setDB($db);


