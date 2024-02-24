<?php

require "includes/functions.php";
//Requerir DB
require "/bienesRaicesPHP_inicio/includes/config/database.php";
$db = conectarDB();
//Petición información
$infoAnuncio = "SELECT * FROM propiedades";
//Consulta
$query = mysqli_query($db, $infoAnuncio);

incluirTemplate("header");

?>

<main class="contenedor seccion">

    <h2>Casas y Apartamentos en Venta</h2>

    <div class="contenedor-anuncios">

        <div class="anuncio">
            <?php while ($anuncio = mysqli_fetch_assoc($query)) : ?>
                <picture>
                    <!-- <source srcset="build/img/anuncio1.webp" type="image/webp"> -->
                    <source srcset="build/img/<?php echo $anuncio["imagen"] ?>" type="image/jpeg">
                    <img loading="lazy" src="build/img/<?php echo $anuncio["imagen"] ?>" alt="anuncio">
                </picture>

                <div class="contenido-anuncio" key="<?php echo $anuncio["id"] ?>">
                    <h3><?php echo $anuncio["titulo"] ?></h3>
                    <p><?php echo $anuncio["descripcion"] ?></p>
                    <p class="precio"><?php echo $anuncio["precio"] . " €" ?></p>

                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                            <p><?php echo $anuncio["wc"] ?></p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                            <p><?php echo $anuncio["estacionamiento"] ?></p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                            <p><?php echo $anuncio["habitaciones"] ?></p>
                        </li>
                    </ul>

                    <a href="anuncio.php?id=<?php echo $anuncio["id"] ?>" class="boton-amarillo-block">
                        Ver Propiedad
                    </a>
                </div><!--.contenido-anuncio-->
            <?php endwhile ?>
        </div><!--anuncio-->


    </div> <!--.contenedor-anuncios-->
</main>

<?php
incluirTemplate("footer");
?>

<script src="build/js/bundle.min.js"></script>
</body>

</html>