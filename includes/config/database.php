<?php

function conectarDB() : mysqli
{
  $db = new mysqli("localhost", "root", "Fado76072789", "bienesraices_crud");

  if (!$db) {
    echo "Error no se pudo contectar";
    exit;
  } else {
    return $db;
  }
}
