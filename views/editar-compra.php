<div class="container mt-5">
<h1 class="text-center mb-4 ">Formulario de Editar compras</h1>

<form action="" class="from-control" id="formACtualizar" >
    <input type="hidden" name="id_compra" id="id_compra">
        <div class="mb-3">
            <label for="id_producto">Producto: </label>
            <select type="text" name="id_producto" id="id_producto"  class="form-control" required>
            <option  class="id_proveedor" >Seleccione</option></select>
        </div>
        <div class="mb-3">
            <label for="cantidad">Cantidad: </label>
            <input type="number" name="cantidad" id="cantidad"  class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="precio">Precio: </label>
            <input type="number" name="precio" id="precio"  class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="trabajador">Trabajador: </label>
            <select type="text" name="trabajador" id="trabajador"  class="form-control" required>
            <option  class="trabajador" >Seleccione</option></select>
        </div>
        <button type="button" class="mb-3 btn btn-outline-info" onclick="actualizarCompra();"><i class="fas fa-check"></i> Actualizar</button>
    </form>
</div>

<script src="<?php echo BASE_URL;?>views/js/funtions-compra.js"></script>
<script>listar_productos();</script>
<script>listar_trabajadores();</script>
<script>

const id_p=<?php $pagina=explode("/", $_GET['views']); echo $pagina['1']; ?>;
ver_compra(id_p);
</script>