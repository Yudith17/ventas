<?php
require_once('../model/personaModel.php');

// Get the 'tipo' parameter from the request
$tipo = $_REQUEST['tipo'];

// Create an instance of the personaModel class
$objpersona = new personaModel();

if ($tipo == "listar") {
    $arr_Respuesta = array('status' => false, 'contenido' => '');
    $arr_personas = $objpersona->obtener_persona();

    // Check if any persons were found
    if (!empty($arr_personas)) {
        // Iterate through the persons to add options or additional processing
        foreach ($arr_personas as $persona) {
            $persona->options = ''; // You can add dynamic options here if needed
        }
        $arr_Respuesta['status'] = true;
        $arr_Respuesta['contenido'] = $arr_personas;
    }
    echo json_encode($arr_Respuesta);
}

if ($tipo == "registrar") {
    // Process POST request for registration
    if ($_POST) {
        // Retrieve POST data
        $nro_identidad = $_POST['nro_identidad'];
        $razon_social = $_POST['razon_social'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $departamento = $_POST['departamento'];
        $provincia = $_POST['provincia'];
        $distrito = $_POST['distrito'];
        $cod_postal = $_POST['cod_postal'];
        $direccion = $_POST['direccion'];
        $rol = $_POST['rol'];
        $password = $_POST['password'];
        $estado = isset($_POST['estado']) ? $_POST['estado'] : 1;
        $fecha_reg = date("Y-m-d H:i:s");

        // Validate required fields
        if (
            empty($nro_identidad) || empty($razon_social) || empty($telefono) || empty($correo) ||
            empty($departamento) || empty($provincia) || empty($distrito) || empty($cod_postal) ||
            empty($direccion) || empty($rol) || empty($password)
        ) {
            $arr_respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
        } else {
            // Secure the password before storing it in the database
            $secure_password = password_hash($password, PASSWORD_DEFAULT);

            // Call the method to register a person
            $arrPersona = $objpersona->registrar_persona(
                $nro_identidad, $razon_social, $telefono, $correo,
                $departamento, $provincia, $distrito, $cod_postal,
                $direccion, $rol, $secure_password, // Use the hashed password
                $estado, $fecha_reg
            );

            // Check if registration was successful
            if ($arrPersona->id > 0) {
                $arr_respuesta = array('status' => true, 'mensaje' => 'Registro Exitoso');
            } else {
                $arr_respuesta = array('status' => false, 'mensaje' => 'Error al registrar persona');
            }
        }
        echo json_encode($arr_respuesta);
    }
}




if ($tipo == "ver") {
    
}

if ($tipo == "actualizar") {
    
}

if ($tipo == "eliminar") {
    
}
?>

