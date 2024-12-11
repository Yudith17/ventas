<?php
require_once('../model/personaModel.php');

$tipo = $_REQUEST['tipo'];

// instancio de la clase PersonaModel
$objPersona = new PersonaModel();


if ($tipo == "listar") {
    //respuesta 
    $arr_Respuesta = array('status' => false, 'contenido' => '');
    $arr_Persona = $objPersona->obtener_personas();
    if (!empty($arr_Persona)) {

        for ($i = 0; $i < count($arr_Persona); $i++) {

            $id_Persona = $arr_Persona[$i]->id;
            $razon_social = $arr_Persona[$i]->razon_social;

             //localhost/editar-producto/4                                                               //eliminar_producto(va llamar al id);
             $opciones ='<a href=" '.BASE_URL.'editar-producto/'.$id_Persona.'">Editar</a><button onclick="Eliminar_producto('.$id_Persona.');">Eliminar</button>';
             $arr_Persona[$i]->options = $opciones;
        }
        $arr_Respuesta['status'] = true;
        $arr_Respuesta['contenido'] = $arr_Persona;
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
    // $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Esto es para poder encriptar las contraseñas
    $secure_password = password_hash($nro_identidad, PASSWORD_DEFAULT);


    if (
      $nro_identidad == "" || $razon_social == "" || $telefono == "" || $correo == "" ||
      $departamento == "" || $provincia == "" || $distrito == "" || $cod_postal == "" ||
      $direccion == "" || $rol == "" || $secure_password == ""
    ) {
      //respuesta
      $arr_Respuesta = array(
        'status' => false,
        'mensaje' => 'Error, campos vacios'
      );
    } else {
      $objPersona =
        $objPersona->registrarPersona(
          $nro_identidad,
          $razon_social,
          $telefono,
          $correo,
          $departamento,
          $provincia,
          $distrito,
          $cod_postal,
          $direccion,
          $rol,
          $secure_password
        );
      if ($objPersona->id > 0) {
        $arr_Respuesta = array(
          'status' => true,
          'mensaje' => 'Registro exitoso'
        );
      } else {
        $arr_Respuesta = array(
          'status' => false,
          'mensaje' => 'Error al registrar producto'
        );
      }
      echo json_encode($arr_Respuesta);
    }
  }
}




if ($tipo == "listar_trabajador") {
  // Respuesta inicial
  $arr_Respuesta = array('status' => false, 'contenido' => '');

  // Obtener la lista de trabajadores
  $arr_Trabajador = $objPersona->obtener_trabajadores();
  if (!empty($arr_Trabajador)) {
    // Recorrer el array para agregar las opciones para trabajador
    for ($i = 0; $i < count($arr_Trabajador); $i++) {
      $id_trabajador = $arr_Trabajador[$i]->id;
      $razon_social = $arr_Trabajador[$i]->razon_social;
      $opciones = '';
      $arr_Trabajador[$i]->options = $opciones;
    }

    $arr_Respuesta['status'] = true;
    $arr_Respuesta['contenido'] = $arr_Trabajador;
  }

  echo json_encode($arr_Respuesta);
}
if($tipo=="ver"){
  // print_r($_POST);
  $id_persona = $_POST['id_persona'];
  $arr_Respuesta = $objPersona->verPersona($id_persona);
  // print_r($arr_Respuesta);eso es para hacer la prueba 
  if(empty($arr_Respuesta)){
    $response = array('status' => false, 'mensaje' =>"Error, No hay informacion");
  }else{
    $response = array('status' => true, 'mensaje' => "Datos Encontrados", 'contenido' =>$arr_Respuesta);
  }
  echo json_encode($response);
  }


  if ($tipo == "actualizar") {
    // Obtener los datos del formulario
    $id_persona = $_POST['id_persona']; // ID de la persona a actualizar
    $nro_identidad = $_POST['nro_identidad']; // Número de identidad
    $razon_social = $_POST['razon_social']; // Razón social
    $telefono = $_POST['telefono']; // Teléfono
    $correo = $_POST['correo']; // Correo
    $departamento = $_POST['departamento']; // Departamento
    $provincia = $_POST['provincia']; // Provincia
    $distrito = $_POST['distrito']; // Distrito
    $cod_postal = $_POST['cod_postal']; // Código postal
    $direccion = $_POST['direccion']; // Dirección
    $rol = $_POST['rol']; // Rol

    // Validación de campos
    if ($nro_identidad == "" || $razon_social == "" || $telefono == "" || $correo == "" || $departamento == "" || $provincia == "" || $distrito == "" || $cod_postal == "" || $direccion == "" || $rol == "") {
        // Respuesta de error si algún campo está vacío
        $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
    } else {
        // Llamada a la función para actualizar la persona
        $arrPersona = $objPersona->actualizarPersona($id_persona, $nro_identidad, $razon_social, $telefono, $correo, $departamento, $provincia, $distrito, $cod_postal, $direccion, $rol);
        
        // Verificar si la actualización fue exitosa
        if ($arrPersona->id_persona > 0) {
            $arr_Respuesta = array('status' => true, 'mensaje' => 'Persona actualizada correctamente');
        } else {
            $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al actualizar persona');
        }
    }

    // Enviar la respuesta en formato JSON
    echo json_encode($arr_Respuesta);
}


if ($tipo == "eliminar") {
    $id_persona = $_POST['id_persona'];
    $arr_Respuesta = $objPersona->eliminarPersona($id_persona);

    if (empty($arr_Respuesta)) {
        $response = array('status' => false);
    } else {
        $response = array('status' => true);
    }
    echo json_encode($response);
}

?>
