<form action="" class="form-control" id="frmActualizarCompra">
    <input type="hidden" name="id_compra" id="id_compra">

    <div class="form-group">
        <label for="producto">Producto: </label>
        <select name="producto" id="producto" class="form-control" required>
            <option value="">Seleccione un producto</option>
            <!-- Opciones cargadas dinámicamente -->
        </select>
    </div>

    <div class="form-group">
        <label for="cantidad">Cantidad: </label>
        <input type="number" class="form-control" required id="cantidad" name="cantidad" min="1">
    </div>

    <div class="form-group">
        <label for="precio">Precio: </label>
        <input type="number" class="form-control" required id="precio" name="precio" min="0.01" step="0.01">
    </div>

    <div class="form-group">
        <label for="trabajador">Trabajador: </label>
        <select name="trabajador" id="trabajador" class="form-control" required>
            <option value="">Seleccione un trabajador</option>
            <!-- Opciones cargadas dinámicamente -->
        </select>
    </div>

    <div class="form-group">
        <label for="fecha">Fecha de Compra: </label>
        <input type="date" class="form-control" required id="fecha" name="fecha">
    </div>

    <div class="form-group">
        <label for="observaciones">Observaciones: </label>
        <textarea class="form-control" id="observaciones" name="observaciones" rows="3"></textarea>
    </div>

    <button type="button" class="btn btn-info" onclick="actualizarCompra();">Actualizar</button>
</form>

<script src="<?php echo BASE_URL; ?>views/js/funtions-compra.js"></script>

<script>
    const id_compra = <?php $pagina = explode("/", $_GET['views']); echo $pagina[1]; ?>;
    ver_compra(id_compra);
</script>
