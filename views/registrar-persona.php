<form action="" id="frmRegistrarPersona">
    <div>
        <label for="nro_identidad">Nro Identidad: </label>
        <input type="text" class="form-control" required id="nro_identidad" name="nro_identidad">
    </div>
    <div>
        <label for="razon_social">Razón Social: </label>
        <input type="text" class="form-control" required id="razon_social" name="razon_social">
    </div>
    <div>
        <label for="telefono">Teléfono: </label>
        <input type="text" class="form-control" required id="telefono" name="telefono">
    </div>
    <div>
        <label for="correo">Correo: </label>
        <input type="email" class="form-control" required id="correo" name="correo">
    </div>
    <div>
        <label for="departamento">Departamento: </label>
        <input type="text" class="form-control" required id="departamento" name="departamento">
    </div>
    <div>
        <label for="provincia">Provincia: </label>
        <input type="text" class="form-control" required id="provincia" name="provincia">
    </div>
    <div>
        <label for="distrito">Distrito: </label>
        <input type="text" class="form-control" required id="distrito" name="distrito">
    </div>
    <div>
        <label for="cod_postal">Código Postal: </label>
        <input type="text" class="form-control" required id="cod_postal" name="cod_postal">
    </div>
    <div>
        <label for="direccion">Dirección: </label>
        <input type="text" class="form-control" required id="direccion" name="direccion">
    </div>
    <div>
        <label for="rol">Rol: </label>
        <select name="rol" id="rol" class="form-control" required>
            <option value="">Seleccione</option>
            <option value="admin">Admin</option>
            <option value="usuario">Usuario</option>
        </select>
    </div>

    <button type="button" class="btn btn-info" onclick="registrarPersona();">Registrar</button>
</form>

<script src="<?php echo BASE_URL; ?>views/js/functions-persona.js"></script>
