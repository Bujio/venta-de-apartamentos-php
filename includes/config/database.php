<?php

function conectarDB(): mysqli
{
  $db = new mysqli("localhost", "root", "Fado76072789", "bienesraices_crud"); //mysqli es la forma O.Objetos
  if (!$db) {
    echo "Error no se pudo conectar";
    exit;
  }

  return $db;
}
