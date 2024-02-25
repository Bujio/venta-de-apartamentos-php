<?php
//Identificar valores y validación
$id = filter_var($_GET["id"], FILTER_VALIDATE_INT);

//Base de datos
require "/bienesRaicesPHP_inicio/includes/config/database.php";
$db = conectarDB();


//Validación
if (!$id) {
    header("Location:/admin");
}
require "includes/functions.php";

// //Obtener datos de la propiedad
$datosPropiedad = "SELECT * FROM propiedades WHERE id= $id";
$queryDatosPropiedad = mysqli_query($db, $datosPropiedad);
$propiedad = mysqli_fetch_assoc($queryDatosPropiedad);

incluirTemplate("header");

?>

<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad["titulo"] ?></h1>

    <picture>
        <source srcset="build/img/<?php echo $propiedad["imagen"] ?>" type="image/webp">
        <source srcset="build/img/<?php echo $propiedad["imagen"] ?>" type="image/jpeg">
        <img loading="lazy" src="<?php echo $propiedad["imagen"] ?>" alt="imagen de la propiedad">
    </picture>

    <div class="resumen-propiedad">
        <p class="precio"><?php echo $propiedad["precio"] ?></p>
        <ul class="iconos-caracteristicas iconos-small">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad["wc"] ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p><?php echo $propiedad["estacionamiento"] ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                <p><?php echo $propiedad["habitaciones"] ?></p>
            </li>
        </ul>

        <p><?php echo $propiedad["descripcion"] ?></p>


    </div>
    <a href="/anuncios.php" class="boton-verde-block uppercase">ver otras propiedades</a>
</main>

<?php
incluirTemplate("footer");
?>

<script src="build/js/bundle.min.js"></script>
</body>

</html>