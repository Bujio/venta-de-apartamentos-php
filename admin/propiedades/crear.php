<?php
//Base de datos
require "../../includes/config/database.php";
$db = conectarDB();

//Errores
$errores = [];

//iniciamos las variables vacias
$titulo = "";
$precio = "";
$descripcion = "";
$habitaciones = "";
$wc = $_POST["wc"];
$estacionamiento = "";
$vendedores_Id = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $titulo = $_POST["titulo"];
  $precio = $_POST["precio"];
  $descripcion = $_POST["descripcion"];
  $habitaciones = $_POST["habitaciones"];
  $wc = $_POST["wc"];
  $estacionamiento = $_POST["estacionamiento"];
  $vendedores_Id = $_POST["vendedor"];

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

  //Revisar si el array de errores está vacio
  if (empty($errores)) {
    //Incluir en la DB
    $query = " INSERT INTO propiedades(titulo,precio,descripcion,habitaciones,wc,estacionamiento,vendedores_Id)
  VALUES ('$titulo','$precio','$descripcion','$habitaciones','$wc','$estacionamiento','$vendedores_Id');";
    //echo $query;

    $resultado = mysqli_query($db, $query);
    if ($resultado) {
      echo "Insertado correctamente";
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
  <form class="formulario" method="POST">
    <fieldset>
      <legend>Información General</legend>

      <label for="titulo">Título:</label>
      <input type="text" name="titulo" placeholder="titulo propiedad" id="titulo" value="<?php echo $titulo; ?>">

      <label for="precio">Precio:</label>
      <input type="number" name="precio" placeholder="precio propiedad" id="precio" value="<?php echo $precio; ?>">

      <label for="imagen">Imagen:</label>
      <input type="file" name="imagen" id="imagen" accept="image/jpeg, image/png">

      <label for="descripcion">Descripción:</label>
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
        <option value="1">Juan</option>
        <option value="2">Karen</option>
      </select>
    </fieldset>

    <input type="submit" value="crear propiedad" class="boton-verde">
  </form>
</main>

<?php
incluirTemplate("footer");
?>