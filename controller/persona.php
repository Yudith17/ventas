<?php
require_once('../model/personaModel.php');

$tipo = $_REQUEST['tipo'];


$objpersona = new personaModel();

if ($tipo =="listar"){

    $arr_Respuesta =array('status'=>false, 'contenido'=>'');
    $arr_personas = $objpersona->obtener_Persona();
    
    if (!empty($arr_personas)){
       
        for($i=0;$i < count($arr_personas); $i++){
            $id_persona = $arr_personas[$i]->id;
            $razon_social = $arr_personas[$i]->razon_social;
           
           
            $opciones = '';
            $arr_personas[$i]->options = $opciones;
        }
        $arr_Respuesta['status'] = true;
        $arr_Respuesta['contenido'] = $arr_personas;
        
    }
    echo json_encode($arr_Respuesta);  
}


if ($tipo == "registrar") {
    if ($_POST) {
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

       $secure_password = password_hash($nro_identidad,PASSWORD_DEFAULT);

        if (
            empty($nro_identidad) || empty($razon_social) || empty($telefono) || empty($correo) ||
            empty($departamento) || empty($provincia) || empty($distrito) || empty($cod_postal) ||
            empty($direccion) || empty($rol) || empty($password)
        ) {
            $arr_respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
        } else {
            
            $arrPersona = $objPersona->registrarPersona(
                $nro_identidad, $razon_social, $telefono, $correo,
                $departamento, $provincia, $distrito, $cod_postal,
                $direccion, $rol, password_hash($password, PASSWORD_DEFAULT), 
                $estado, $fecha_reg
            );

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

