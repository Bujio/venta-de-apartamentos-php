<?php
require '../includes/functions.php';
$auth = estaAutenticado();

if (!$auth) {
  header('Location: /');
}
//Importamos conexion de DB
require "../includes/config/database.php";
$db = conectarDB();
//Escribimos la query
$queryPropiedades = "SELECT * FROM propiedades;";

//Consultamos la db
$consultaPropiedades = mysqli_query($db, $queryPropiedades);



//Muestra mensaje opcional
$resultado = $_GET["resultado"] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //este id no va a existir hasta que no  se mande el POST, por eso lo evaluamos dentro.
  $id = $_POST['id'];
  $id = filter_var($id, FILTER_VALIDATE_INT);

  if ($id) {

    //eliminar imagen
    $queryImagen = "SELECT imagen FROM propiedades WHERE id='$id'";
    $resultado = mysqli_query($db, $queryImagen);
    $imagenPropiedad = mysqli_fetch_assoc($resultado);
    unlink('../src/img/' . $imagenPropiedad['imagen']);

    //eliminar propiedad de db
    $query = "DELETE FROM propiedades WHERE id=$id;";
    $resultado = mysqli_query($db, $query);

    if ($resultado) {
      header('Location: /admin?resultado=3');
    }
  }
}

//Incluye un template
require "../includes/functions.php";
incluirTemplate("header");

?>

<main class="contenedor seccion">
  <h1>Administrador</h1>
  <?php if (intval($resultado) === 1) : ?>
    <p class="alerta correcta">Propiedad Creada Correctamente</p>
  <?php elseif (intval($resultado) === 2) : ?>
    <p class="alerta correcta">Propiedad Actualizada Correctamente</p>
  <?php elseif (intval($resultado) === 3) : ?>
    <p class="alerta correcta">Propiedad Elimininada Correctamente</p>
  <?php endif ?>
  <a href="/admin/propiedades/crear.php" class="boton-verde">Nueva Propiedad</a>

  <table class="propiedades">
    <thead>
      <tr>
        <th>Id</th>
        <th>Título</th>
        <th>Imagen</th>
        <th>Precio</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($propiedad = mysqli_fetch_assoc($consultaPropiedades)) : ?>
        <tr>

          <td class="centrar-texto"><?php echo $propiedad["id"] ?></td>
          <td class="centrar-texto"><?php echo $propiedad["titulo"] ?></td>
          <td><img src="/src/img/<?php echo $propiedad["imagen"] ?>" class="imagen-tabla "></td>
          <td class="centrar-texto"><?php echo $propiedad["precio"] . " €" ?></td>
          <td>
            <form method="POST" class="w-100">
              <!-- para mandar datos y que no se vea el input -->
              <input type="hidden" name="id" value="<?php echo $propiedad["id"] ?>">
              <input type="submit" class=" boton-rojo-block" value="Eliminar">
            </form>
            <a class="boton-amarillo-block" href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad["id"] ?>">Actualizar</a>
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