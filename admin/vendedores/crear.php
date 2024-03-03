<?php
require "../../includes/app.php";

use App\Vendedor;

estaAutenticado();
$vendedor = new Vendedor;

//ARREGLO CON MSJ DE ERRORES
$errores = Vendedor::getErrores();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  //CREAR NUEVA INSTANCIA
  $vendedor = new Vendedor($_POST['vendedor']);
  //VALIDAR CAMPOS VACIOS
  $errores = $vendedor->validar();

  //No hay errores->hay que guardarlos
  if (empty($errores)) {
    $vendedor->guardar();
  }
}

incluirTemplate("header");
?>

<main class="contenedor seccion">
  <h1>Registrar Vendedor</h1>

  <a href="../index.php" class="boton boton-verde">Volver</a>

  <?php foreach ($errores as $error) : ?>
    <div class="alerta error">
      <?php echo $error; ?>
    </div>
  <?php endforeach; ?>

  <form class="formulario" method="POST" action="/admin/vendedores/crear.php">
    <?php include '../../includes/templates/formulario_vendedores.php'; ?>
    <input type="submit" value="Registrar Vendedores" class="boton boton-verde">
  </form>
</main>

<?php
incluirTemplate("footer");
?>