<?php
//Importamos conexion de DB
require "../includes/config/database.php";
$db = conectarDB();
//Escribimos la query
$queryPropiedades = "SELECT * FROM propiedades;";

//Consultamos la db
$consultaPropiedades = mysqli_query($db, $queryPropiedades);

echo "<pre>";
var_dump($consulta);
echo "</pre>";


//Muestra mensaje opcional
$resultado = $_GET["resultado"] ?? null;

//Incluye un template
require "../includes/functions.php";
incluirTemplate("header");

?>

<main class="contenedor seccion">
  <h1>Administrador</h1>
  <?php if (intval($resultado) === 1) : ?>
    <p class="alerta correcta">Propiedad creada correctamente</p>
  <?php endif ?>
  <a href="/admin/propiedades/crear.php" class="boton-verde">Nueva Propiedad</a>

  <table class="propiedades">
    <thead>
      <tr>
        <th>Id</th>
        <th><?php echo $propiedad ?></th>
        <th>Imagen</th>
        <th>Precio</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($propiedad = mysqli_fetch_assoc($consultaPropiedades)) : ?>
        <tr>

          <td><?php echo $propiedad["id"] ?></td>
          <td><?php echo $propiedad["titulo"] ?></td>
          <td><img src="/imagenes/<?php echo $propiedad["imagen"] ?>" class="imagen-tabla"></td>
          <td><?php echo $propiedad["precio"] . "€" ?></td>
          <td>
            <a class=" boton-rojo-block" href="">Eliminar</a>
            <a class="boton-amarillo-block" href="">Actualizar</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

</main>

<?php

incluirTemplate("footer");
//Opcional: cerrar la conexion
mysqli_close($db);
?>