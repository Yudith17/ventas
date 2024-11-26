<form action="" id="frmRegistrar">
   
    <div>
        <label for="">Nombre: </label>
        <input type="text" class="form-control" required id="nombre" name="nombre">
       
    </div>
    <div>
        <label for="">Detalle:</label>
        <input type="text" class="form-control" required id= "detalle" name="detalle">
    </div>
   
    <button type="button" class="btn btn-info " onclick="registrar_categoria();">Registrar</button>
</form>
<script src="<?php echo BASE_URL;?>views/js/function_categoria.js"></script>