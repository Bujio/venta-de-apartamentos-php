<fieldset>
  <legend>Información General</legend>

  <label for="titulo">Título:</label>
  <input type="text" name="titulo" placeholder="titulo propiedad" id="titulo" value="<?php echo $titulo; ?>">

  <label for="precio">Precio:</label>
  <input type="number" name="precio" placeholder="precio propiedad" id="precio" value="<?php echo $precio; ?>">

  <label for="imagen">Imagen:</label>
  <input type="file" name="imagen" id="imagen" accept="image/jpeg, image/png, image/webp" name="imagen">

  <label for=" descripcion">Descripción:</label>
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

  <select name="vendedores_Id" value="<?php echo $vendedores_Id; ?>">
    <option value="" disabled selected>--Seleccione Vendedor--</option>
    <?php while ($vendedor = mysqli_fetch_assoc($resultado)) { ?>
      <option <?php echo $vendedores_Id === $vendedor["id"] ? "selected" : ""; ?> value="<?php echo $vendedor["id"] ?>"><?php echo $vendedor["nombre"] ?></option>
    <?php } ?>
  </select>
</fieldset>