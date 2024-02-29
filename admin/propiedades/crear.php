<?php
require '../../includes/app.php';

use App\Propiedad;


estaAutenticado();


//Base de datos
require "../../includes/config/database.php";
$db = conectarDB();

//consultar vendedores
$consulta = "SELECT * FROM vendedores;";
$resultado = mysqli_query($db, $consulta);



//Errores
$errores = [];

//iniciamos las variables vacias
$titulo = "";
$precio = "";
$descripcion = "";
$habitaciones = "";
$wc = mysqli_real_escape_string($db, $_POST["wc"]);
$estacionamiento = "";
$vendedores_Id = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $titulo = mysqli_real_escape_string($db, $_POST["titulo"]);
  $precio = mysqli_real_escape_string($db, $_POST["precio"]);
  $descripcion = mysqli_real_escape_string($db, $_POST["descripcion"]);
  $habitaciones = mysqli_real_escape_string($db, $_POST["habitaciones"]);
  $wc = mysqli_real_escape_string($db, $_POST["wc"]);
  $estacionamiento = mysqli_real_escape_string($db, $_POST["estacionamiento"]);
  $vendedores_Id = mysqli_real_escape_string($db, $_POST["vendedor"]);
  $creado = date("Y/m/d");

  //Asignar files a la imagen

  $imagen = $_FILES["imagen"];

  if (!$titulo) {
    $errores[] = "Debes incluir un título";
  }
  if (!$precio) {
    $errores[] = "Debes incluir un precio";
  }
  if (strlen($descripcion) < 50) {
    $errores[] = "Debes incluir una descripción y ésta debe ser mayor a 50 caracteres";
  }
  if (!$habitaciones) {
    $errores[] = "Debes indicar el número de habitaciones";
  }
  if (!$wc) {
    $errores[] = "Debes indicar el número de baños";
  }
  if (!$estacionamiento) {
    $errores[] = "Debes indicar el número de estacionamientos";
  }
  if (!$vendedores_Id) {
    $errores[] = "Debes seleccionar un vendedor";
  }

  if (!$imagen["name"]) {
    $errores[] = "La imagen es obligatoria";
  }

  //Validar tamaño de la imagen (100 mb máximo)
  $medida = 1000 * 1000;

  if ($imagen["size"] > $medida) {
    $errores[] = "La imagen es muy pesada";
  }

  //Revisar si el array de errores está vacio
  if (empty($errores)) {

    /**SUBIDA DE ARCHIVOS **/

    //Crear carpeta
    $carpetaImagenes = "../../src/img/";
    if (!is_dir($carpetaImagenes)) {
      mkdir($carpetaImagenes);
    }


    //Generar nombre único de imagen
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    //Subir imagen
    move_uploaded_file($imagen["tmp_name"], $carpetaImagenes  . $nombreImagen);

    // echo "<pre>";
    // var_dump($imagen);
    // echo "</pre>";
    // exit;


    //Incluir en la DB
    $query = " INSERT INTO propiedades(titulo,precio,imagen,descripcion,habitaciones,wc,estacionamiento,creado,vendedores_Id)
  VALUES ('$titulo','$precio','$nombreImagen','$descripcion','$habitaciones','$wc','$estacionamiento','$creado','$vendedores_Id');";
    //echo $query;

    $resultado = mysqli_query($db, $query);
    if ($resultado) {
      //Redireccionar al usuario
      header("Location: /admin?resultado=1");
    }
  }
}
require "../../includes/functions.php";

incluirTemplate("header");

?>

<main class="contenedor seccion">
  <h1>Crear</h1>

  <a href="/admin" class="boton-verde">Volver</a>
  <?php foreach ($errores as $error) : ?>
    <div class="alerta error">
      <?php echo $error; ?>
    </div>
  <?php endforeach; ?>
  <form class="formulario" method="POST" enctype="multipart/form-data" <fieldset>
    <legend>Información General</legend>

    <label for="titulo">Título:</label>
    <input type="text" name="titulo" placeholder="titulo propiedad" id="titulo" value="<?php echo $titulo; ?>">

    <label for="precio">Precio:</label>
    <input type="number" name="precio" placeholder="precio propiedad" id="precio" value="<?php echo $precio; ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" name="imagen" id="imagen" accept="image/jpeg, image/png, image/webp" name="imagen">

    <label for=" descripcion">Descripción:</label>
    <textarea name="descripcion" id="descripcion"><?php echo $descripcion; ?></textarea>
    </fieldset>

    <fieldset>
      <legend>Información Propiedad</legend>

      <label for=" habitaciones">Habitaciones:</label>
      <input type="number" name="habitaciones" id="habitaciones" min="1" max="8" placeholder="--Seleccione cantidad--" value="<?php echo $habitaciones; ?>">

      <label for="baños">Baños:</label>
      <input type="number" name="wc" id="baños" min="1" max="8" placeholder="--Seleccione cantidad--" value="<?php echo $wc; ?>">

      <label for="parking">Parking:</label>
      <input type="number" name="estacionamiento" id="parking" min="1" max="8" placeholder="--Seleccione cantidad--" value="<?php echo $estacionamiento; ?>">
    </fieldset>

    <fieldset>
      <legend>Vendedor</legend>

      <select name="vendedor" value="<?php echo $vendedores_Id; ?>">
        <option value="" disabled selected>--Seleccione Vendedor--</option>
        <?php while ($vendedor = mysqli_fetch_assoc($resultado)) { ?>
          <option <?php echo $vendedores_Id === $vendedor["id"] ? "selected" : ""; ?> value="<?php echo $vendedor["id"] ?>"><?php echo $vendedor["nombre"] ?></option>
        <?php } ?>
      </select>
    </fieldset>

    <input type="submit" value="crear propiedad" class="uppercase boton-verde">
  </form>
</main>

<?php
incluirTemplate("footer");
?>