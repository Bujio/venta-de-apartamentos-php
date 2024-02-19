<?php

function conectarDB() : mysqli
{
  $db = mysqli_connect("localhost", "root", "Fado76072789", "bienesraices_crud");

  if (!$db) {
    echo "Error no se pudo contectar";
    exit;
  } else {
    return $db;
  }
}
