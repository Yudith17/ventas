FORMULARIO DE EDITAR PRODUCTO
<form action="" class="form-control" id="frmActualizar">
    <input type="hidden" name="id_producto" id="id_producto">
    <input type="hidden" name="img" id="img">
    <div class="form-group">
        <label for="">Codigo:</label>
        <input type="text" class="form-control" id="codigo" name="codigo" readonly disabled>
    </div>
    <div class="form-group">
        <label for="">Nombre:</label>
        <input type="text" required class="form-control" id="nombre" name="nombre">
    </div>
    <div class="form-group">
        <label for="">Detalle:</label>
        <input type="text" class="form-control" required id="detalle" name="detalle">
    </div>
    <div>
        <label for="">Precio:</label>
        <input type="number" class="form-control" required id="precio" name="precio">
    </div>
    <div>
        <label for="">Categoría:</label>
        <select name="categoria" id="categoria" class="form-control" required >
            <option>Seleccione</option>
        </select>
    </div>
    <div>
        <label for="">Imagen:</label>
        <input type="file" class="form-control"  id="imagen" name="imagen">
    </div>
    <div>
        <label for="">Proveedor:</label>
        <select class="form-control" required id="proveedor" name="proveedor">
            <option value="Seleccione"></option>
        </select>
    </div>
    <br>
    <button type="button" class="btn btn-success" onclick="actualizarProducto();">Actualizar</button>
</form>

<script src="<?php echo BASE_URL;?>views/js/functions_producto.js"></script>
<script> listar_Categorias();</script>
<script> listar_proveedor();</script>
<script>
        //http://localhost/Ventas_2024/editar-producto/1
        const id_p=<?php $pagina=explode("/",$_GET['views']); echo $pagina['1'];?>;
        ver_producto(id_p);
    </script>