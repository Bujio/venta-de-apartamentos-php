<?php


namespace App;


class Propiedad
{
  //BASES DE DATOS
  protected static $db;
  protected static $columnasDB = ['id', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedores_Id'];
  public $id;
  public $titulo;
  public $precio;
  public $imagen;
  public $descripcion;
  public $habitaciones;
  public $wc;
  public $estacionamiento;
  public $creado;
  public $vendedores_Id;

  //DEFINIR LA CONEXION A LA DB
  public static function setDB($database)
  {
    self::$db = $database;
  }

  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? "";
    $this->titulo = $args['titulo'] ?? "";
    $this->precio = $args['precio'] ?? "";
    $this->imagen = $args['imagen'] ?? "imagen.jpg";
    $this->descripcion = $args['descripcion'] ?? "";
    $this->habitaciones = $args['habitaciones'] ?? "";
    $this->wc = $args['wc'] ?? "";
    $this->estacionamiento = $args['estacionamiento'] ?? "";
    $this->creado = date('Y/m/d');
    $this->vendedores_Id = $args['vendedores_Id'] ?? "";
  }
  public function guardar()
  {
    //SANITIZAR LOS DATOS
    $atributos = $this->sanitizarDatos();
    //Incluir en la DB
    $query = " INSERT INTO propiedades ( ";
    $query .= join(', ', array_keys($atributos));
    $query .= " ) VALUES (' ";
    $query .= join("', '", array_values($atributos));
    $query .= " ') ";
    $resultado = self::$db->query($query);

    debuguear($resultado);
  }

  //Identificar y unir los atributos de la DB
  public function atributos()
  {
    $atributos = [];
    foreach (self::$columnasDB as $columna) {
      //ignora la columna de id y continua.
      if ($columna === 'id') continue;
      $atributos[$columna] = $this->$columna;
    }
    return $atributos;
  }
  public function sanitizarDatos()
  {
    $atributos = $this->atributos();
    $sanitizado = [];

    foreach ($atributos as $key => $value) {
      $sanitizado[$key] = self::$db->escape_string($value);
    }
    return $sanitizado;
  }
};
