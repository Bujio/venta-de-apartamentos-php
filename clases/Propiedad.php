<?php


namespace App;


class Propiedad
{
  public $id;
  public $titulo;
  public $precio;
  public $imagen;
  public $descripcion;
  public $habitaciones;
  public $wc;
  public $estacionamiento;
  public $vendedores_Id;

  public function __construct($args = [])
  {
    $this -> id = $args['id'] ?? "";
    $this -> titulo = $args['titulo'] ?? "";
    $this -> precio = $args['precio'] ?? "";
    $this -> imagen = $args['imagen'] ?? "";
    $this ->descripcion = $args['descripcion'] ?? "";
    $this ->habitaciones = $args['habitaciones'] ?? "";
    $this -> wc = $args['wc'] ?? "";
    $this ->estacionamiento = $args['estacionamiento'] ?? "";
    $this ->vendedores_Id = $args['vendedores_Id'] ?? "";
  }
};
