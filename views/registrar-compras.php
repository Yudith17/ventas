<form action="" id="frmRegistrarCompra">
    <div>
        <label for="producto">Producto: </label>
        <select name="producto" id="producto" class="form-control" required>
            <option>Seleccione un producto</option>
            
        </select>
    </div>
    <div>
        <label for="cantidad">Cantidad: </label>
        <input type="number" class="form-control" required id="cantidad" name="cantidad" min="1">
    </div>
    <div>
        <label for="precio">Precio: </label>
        <input type="number" class="form-control" required id="precio" name="precio" min="0.01" step="0.01">
    </div>
    <div>
        <label for="trabajador">Trabajador: </label>
        <select name="trabajador" id="trabajador" class="form-control" required>
            <option>Seleccione un trabajador</option>
            
        </select>
    </div>
    <button type="button" class="btn btn-info" onclick="registrar_compra();">Registrar</button>
</form>

<script src="<?php echo BASE_URL;?>views/js/functions-compra.js"></script>
<script> listar_Trabajador();</script>
<script> listar_Producto();</script>