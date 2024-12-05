<form action="" id="frmActualizar ">
    <h1>FORMULARIO DE EDITAR PRODUCTO</h1>
    <input type="hidden"  name="id_prodcuto " id="id_producto" >
    <div>
        <label for="">Codigo: </label>
        <input type="text" class="form-control" id="codigo" name="codigo" readonly>
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
    <button type="button" class="btn btn-info " onclick="actualizarPorducto();">Editar</button>
</form>
<script src="<?php echo BASE_URL;?>views/js/functions_producto.js"></script>
<script> listar_categorias();</script>
<script> listar_proveedor();</script>
<script>
        //http://localhost/Ventas_2024/editar-producto/1
        const id_p=<?php $pagina=explode("/",$_GET['views']); echo $pagina['1'];?>;
        ver_producto(id_p);
    </script>