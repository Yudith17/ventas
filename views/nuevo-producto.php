<form action="" id="frmRegistrar">
    <div>
        <label for="">Codigo: </label>
        <input type="text" class="form-control" required id="codigo" name="codigo">
    </div>
    <div>
        <label for="">Nombre: </label>
        <input type="text" class="form-control" required id="nombre" name="nombre">
       
    </div>
    <div>
        <label for="">Detalle:</label>
        <input type="text" class="form-control" required id= "detalle" name="detalle">
    </div>
    <div>
        <label for="">Precio: </label>
        <input type="number" class="form-control" required id="precio" name="precio">
    </div>
    <div>
        <label for="">Stock: </label>
        <input type="number" class="form-control" required id="stock"  name="stock">
    </div>
    <div>
        <label for="">Categoria</label>
        <select name="categoria" id="categoria" class="form-control"
            required>
            <option>Seleccione</option>
        </select>
    </div>
    <div>
        <label for="">Imagen: </label>
        <input type="file" class="form-control" required id="imagen" name="imagen">
    </div>
    <div>
        <label for="">Proveedor: </label>
        <select name="proveedor" id="proveedor" class="form-control"
            required>
            <option>Seleccione</option>
        </select>
    </div>
    <button type="button" class="btn btn-info " onclick="registrar_producto();">Registrar</button>
</form>
<script src="<?php echo BASE_URL;?>views/js/functions_producto.js"></script>
<script> listar_Categoria();</script>
<script> listar_proveedor();</script>