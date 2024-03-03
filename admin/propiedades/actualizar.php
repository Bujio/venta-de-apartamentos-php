<?php

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;


require "../../includes/app.php";
estaAutenticado();

//VALIDAR QUE SEA UN ID VALIDO 
$id = $_GET["id"];
$id = filter_var($id, FILTER_VALIDATE_INT);
if (!$id) {
  header("Location: /admin");
}



//OBTENER LOS DATOS DE LA PROPIEDAD
$propiedad = Propiedad::find($id);
$vendedores = Vendedor::all();





//CONSULTAR PARA OBTENER LOS VENDEDORES
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);


//ARREGLO CON MSJ DE ERRORES
$errores = Propiedad::getErrores();



//EJECUTA EL CODIGO DESPUES DE QUE EL USUARIO ENVIA EL FORMULARIO
if ($_SERVER['REQUEST_METHOD'] === "POST") {


  //ASIGNAR LOS ATRIBUTOS
  $args = [];
  $args = $_POST['propiedad'];

  $propiedad->sincronizar($args);

  //VALIDACION
  $errores = $propiedad->validar();

  //GENERA NOMBRE UNICO DE LA IMAGEN
  $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
  //SUBIDA DE ARCHIVOS
  if ($_FILES['propiedad']['tmp_name']['imagen']) {
    $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
    $propiedad->setImagen($nombreImagen);
  }


  if (empty($errores)) {
    if ($_FILES['propiedad']['tmp_name']['imagen']) {
      //ALMACENAR LA IMAGEN
      $image->save(CARPETA_IMAGENES . $nombreImagen);
    }
    $propiedad->guardar();
  }
}


incluirTemplate("header");
?>


<main class="contenedor seccion">
  <h1>Actualizar Propiedad</h1>

  <a href="../index.php" class="boton boton-verde">Volver</a>

  <?php foreach ($errores as $error) : ?>
    <div class="alerta error">
      <?php echo $error; ?>
    </div>
  <?php endforeach; ?>

  <form class="formulario" method="POST" enctype="multipart/form-data">
    <?php include '../../includes/templates/formulario_propiedades.php'; ?>
    <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
  </form>
</main>

<?php
incluirTemplate("footer");
?>