FORMULARIO DE EDITAR CATEGORIA
<form action="" class="form-control" id="frmActualizar">
<input type="hidden" name="id_categoria" id="id_categoria">
    <div class="form-group">
        <label for="">Nombre de Categoría:</label>
        <input type="text" class="form-control" required id="nombre" name="nombre">
    </div>
    
    <div class="form-group">
        <label for="">Detalle de Categoría:</label>
        <input type="text" class="form-control" required id="detalle" name="detalle">
    </div>
    
    <br>
    <button type="button" class="btn btn-info" onclick="actualizarCategoria();">Actualizar</button>
</form>

<!-- Cargar script de funciones para categorías -->
<script src="<?php echo BASE_URL;?>views/js/function_categoria.js"></script>
<script>
        //http://localhost/Ventas_2024/editar-producto/1
        const id_p=<?php $pagina=explode("/",$_GET['views']); echo $pagina['1'];?>;
        ver_categoria(id_p);
    </script>