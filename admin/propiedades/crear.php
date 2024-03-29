<?php

require "../../includes/app.php";

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;


estaAutenticado();

$propiedad = new Propiedad;

//CONSULTA PARA OBTENER TOPDOS LOS VENDEDORES
$vendedores = Vendedor::all();

//ARREGLO CON MSJ DE ERRORES
$errores = Propiedad::getErrores();


//EJECUTA EL CODIGO DESPUES DE QUE EL USUARIO ENVIA EL FORMULARIO
if ($_SERVER['REQUEST_METHOD'] === "POST") {

  //CREA NUEVA INSTANCIA
  $propiedad = new Propiedad($_POST['propiedad']);


  //++SUBIDA DE ARCHIVOS++//
  //GENERAR UN NOMBRE UNICO
  $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

  //SETEAR LA IMAGEN
  //REALIZA UN RESIZE A LA IMAGEN CON INTERVENTION
  if ($_FILES['propiedad']['tmp_name']['imagen']) {
    $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
    $propiedad->setImagen($nombreImagen);
  }

  //VALIDAR
  $errores = $propiedad->validar();


  if (empty($errores)) {    // SI NO HAY ERRORES LO VA A GUARDAR EN LA BD



    //CREAR UNA CARPETA
    $carpetaImagenes = "../../imagenes/";
    if (!is_dir(CARPETA_IMAGENES)) {
      mkdir(CARPETA_IMAGENES);
    }

    //GUARDA LA IMAGEN EN EL SERVIDOR
    $image->save(CARPETA_IMAGENES . $nombreImagen);

    //GUARDA EN LA BASE DE DATOS
    $propiedad->guardar();
  }
}

incluirTemplate("header");
?>


<main class="contenedor seccion">
  <h1>Crear</h1>

  <a href="../index.php" class="boton boton-verde">Volver</a>

  <?php foreach ($errores as $error) : ?>
    <div class="alerta error">
      <?php echo $error; ?>
    </div>
  <?php endforeach; ?>

  <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
    <?php include '../../includes/templates/formulario_propiedades.php'; ?>
    <input type="submit" value="Crear Propiedad" class="boton boton-verde">
  </form>
</main>

<?php
incluirTemplate("footer");
?>