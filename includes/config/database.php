<?php

function conectarDB(): mysqli
{
  $db = new mysqli($_ENV['D_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']); //mysqli es la forma O.Objetos
  if (!$db) {
    echo "Error no se pudo conectar";
    exit;
  }

  return $db;
}
