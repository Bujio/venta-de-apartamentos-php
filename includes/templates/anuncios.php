<?php

use App\Propiedad;

//debugear($_SERVER); SIRVE PARA VER DATOS DEL SERVIDOR
if ($_SERVER['SCRIPT_NAME'] === '/anuncios.php') {
  $propiedades = Propiedad::all();
} else {
  $propiedades = Propiedad::get(3);
}

?>

<div class="contenedor-anuncios">
  <?php foreach ($propiedades as $propiedad) { ?>
    <div class="anuncio">

      <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="anuncio">

      <div class="contenido-anuncio">

        <h3 class="module line-clamp-title uppercase"><?php echo $propiedad->titulo; ?></h3>
        <p class="module line-clamp"><?php echo $propiedad->descripcion; ?></p>
        <p class="precio"><?php echo $propiedad->precio; ?>€</p>
        <ul class="iconos-caracteristicas">
          <li>
            <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
            <p><?php echo $propiedad->wc; ?></p>
          </li>
          <li>
            <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
            <p><?php echo $propiedad->estacionamiento; ?></p>
          </li>
          <li>
            <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
            <p><?php echo $propiedad->habitaciones; ?></p>
          </li>
        </ul>
        <a href="anuncio.php?id=<?php echo $propiedad->id; ?>" class="boton boton-amarillo-block">
          Ver propiedad
        </a>
      </div> <!--.contenido-anuncio-->
    </div><!--.anuncio-->
  <?php } ?>
</div><!--.contenedor-anuncios-->