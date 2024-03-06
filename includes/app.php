<?php

use App\ActiveRecord;


require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
require 'funciones.php';
require 'config/database.php';

//CONECTARNOS A LA BASE DE DATOS
$db = conectarDB();


ActiveRecord::setDB($db);
