<?php

//Importar conexión DB
require 'includes/config/database.php';
$db = conectarDB();

//Crear un email y un password
$email= "admin@correo.com";
$password= "admin12345";
//Hasheamos Password
$paswordHash = password_hash($password, PASSWORD_BCRYPT);

//Query para crear el usuario
$query = "INSERT INTO usuarios (email, password) VALUES ('$email', '$paswordHash');";

//Agregarlo a la DB
mysqli_query($db, $query);
