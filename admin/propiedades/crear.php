<?php

require "../../includes/functions.php";

incluirTemplate("header");

?>

<main class="contenedor seccion">
  <h1>Crear</h1>

  <a href="/admin" class="boton-verde">Volver</a>
  <form class="formulario">
    <fieldset>
      <legend>Infromación General</legend>

      <label for="titulo">Título:</label>
      <input type="text" placeholder="titulo propiedad" id="titulo">

      <label for="precio">Precio:</label>
      <input type="number" placeholder="precio propiedad" id="precio">

      <label for="imagen">Imagen:</label>
      <input type="file" id="imagen" accept="image/jpeg, image/png">

      <label for="descripcion">Descripción:</label>
      <textarea id="descripcion"></textarea>
    </fieldset>

    <fieldset>
      <legend>Información Propiedad</legend>

      <label for="habitaciones">Habitaciones:</label>
      <input type="number" id="habitaciones" min="1" max="8" placeholder="--Seleccione cantidad--">

      <label for="baños">Baños:</label>
      <input type="number" id="baños" min="1" max="8" placeholder="--Seleccione cantidad--">

      <label for="parking">Parking:</label>
      <input type="number" id="parking" min="1" max="8" placeholder="--Seleccione cantidad--">
    </fieldset>

    <fieldset>
      <legend>Vendedor</legend>

      <select name="" id="">
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