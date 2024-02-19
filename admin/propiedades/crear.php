<?php
//Base de datos
require "../../includes/config/database.php";
$db = conectarDB();




if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $titulo = $_POST["titulo"];
  $precio = $_POST["precio"];
  $descripcion = $_POST["descripcion"];
  $habitaciones = $_POST["habitaciones"];
  $wc = $_POST["wc"];
  $estacionamiento = $_POST["estacionamiento"];
  $vendedores_Id = $_POST["vendedor"];

  //Incluir en la DB
  $query = " INSERT INTO propiedades(titulo,precio,descripcion,habitaciones,wc,estacionamiento,vendedores_Id) 
  VALUES ('$titulo','$precio','$descripcion','$habitaciones','$wc','$estacionamiento','$vendedores_Id');";
  //echo $query;

  $resultado = mysqli_query($db, $query);

  if ($resultado) {
    echo "Insertado correctamente";
  }
}
require "../../includes/functions.php";

incluirTemplate("header");

?>

<main class="contenedor seccion">
  <h1>Crear</h1>

  <a href="/admin" class="boton-verde">Volver</a>

  <form class="formulario" method="POST">
    <fieldset>
      <legend>Infromación General</legend>

      <label for="titulo">Título:</label>
      <input type="text" name="titulo" placeholder="titulo propiedad" id="titulo">

      <label for="precio">Precio:</label>
      <input type="number" name="precio" placeholder="precio propiedad" id="precio">

      <label for="imagen">Imagen:</label>
      <input type="file" name="imagen" id="imagen" accept="image/jpeg, image/png">

      <label for="descripcion">Descripción:</label>
      <textarea name="descripcion" id="descripcion"></textarea>
    </fieldset>

    <fieldset>
      <legend>Información Propiedad</legend>

      <label for="habitaciones">Habitaciones:</label>
      <input type="number" name="habitaciones" id="habitaciones" min="1" max="8" placeholder="--Seleccione cantidad--">

      <label for="baños">Baños:</label>
      <input type="number" name="wc" id="baños" min="1" max="8" placeholder="--Seleccione cantidad--">

      <label for="parking">Parking:</label>
      <input type="number" name="estacionamiento" id="parking" min="1" max="8" placeholder="--Seleccione cantidad--">
    </fieldset>

    <fieldset>
      <legend>Vendedor</legend>

      <select name="vendedor">
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