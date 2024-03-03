<?php
require "../../includes/app.php";

use App\Vendedor;

estaAutenticado();

//VALIDAR EL ID QUE SEA VALIDO
$id = $_GET["id"];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
  header("Location: /admin");
}

//OBTENER EL ARREGLO DEL VENDEDOR DESDE DB
$vendedor = Vendedor::find($id);
//ARREGLO CON MSJ DE ERRORES
$errores = Vendedor::getErrores();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  //ASIGNAR LOS VALORES
  $args = $_POST['vendedor'];
  //SINCRONIZAR OBT EN MEMORIA CON LO QUE EL USUARIO ESCRIBIO
  $vendedor->sincronizar($args);
  //VALIDACION
  $errores = $vendedor->validar();

  if (empty($errores)) {
    $vendedor->guardar();
  }
}

incluirTemplate("header");
?>

<main class="contenedor seccion">
  <h1>Actualizar Vendedor</h1>

  <a href="../index.php" class="boton boton-verde">Volver</a>

  <?php foreach ($errores as $error) : ?>
    <div class="alerta error">
      <?php echo $error; ?>
    </div>
  <?php endforeach; ?>

  <form class="formulario" method="POST">
    <?php include '../../includes/templates/formulario_vendedores.php'; ?>
    <input type="submit" value="Guardar Cambios" class="boton boton-verde">
  </form>
</main>

<?php
incluirTemplate("footer");
?>