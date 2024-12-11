FORMULARIO DE EDITAR PERSONA
<form action="" class="form-control" id="frmActualizar">
    <input type="hidden" name="id_persona" id="id_persona">
    
    <div class="form-group">
        <label for="nro_identidad">Nro Identidad: </label>
        <input type="text" class="form-control" required id="nro_identidad" name="nro_identidad">
    </div>

    <div class="form-group">
        <label for="razon_social">Razón Social: </label>
        <input type="text" class="form-control" required id="razon_social" name="razon_social">
    </div>

    <div class="form-group">
        <label for="telefono">Teléfono: </label>
        <input type="text" class="form-control" required id="telefono" name="telefono">
    </div>

    <div class="form-group">
        <label for="correo">Correo: </label>
        <input type="email" class="form-control" required id="correo" name="correo">
    </div>

    <div class="form-group">
        <label for="departamento">Departamento: </label>
        <input type="text" class="form-control" required id="departamento" name="departamento">
    </div>

    <div class="form-group">
        <label for="provincia">Provincia: </label>
        <input type="text" class="form-control" required id="provincia" name="provincia">
    </div>

    <div class="form-group">
        <label for="distrito">Distrito: </label>
        <input type="text" class="form-control" required id="distrito" name="distrito">
    </div>

    <div class="form-group">
        <label for="cod_postal">Código Postal: </label>
        <input type="text" class="form-control" required id="cod_postal" name="cod_postal">
    </div>

    <div class="form-group">
        <label for="direccion">Dirección: </label>
        <input type="text" class="form-control" required id="direccion" name="direccion">
    </div>

    <div class="form-group">
        <label for="rol">Rol: </label>
        <select name="rol" id="rol" class="form-control" required>
            <option value="">Seleccione</option>
            <option value="admin">Admin</option>
            <option value="usuario">Usuario</option>
        </select>
    </div>

    <button type="button" class="btn btn-info" onclick="actualizarPersona();">actualizar</button>
</form>

<script src="<?php echo BASE_URL; ?>views/js/functions-persona.js"></script>

<script>
    
    const id_persona = <?php $pagina = explode("/", $_GET['views']); echo $pagina[1]; ?>;
    ver_persona(id_persona); 
</script>
