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

            $opciones = '<a href=" '.BASE_URL.'editar-persona/'.$id_Persona.'"><button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button></a>
                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"  onclick="eliminar_persona('.$id_Persona.');"></i></button>';  //eliminar_categoria(va llamar al id);
            $arr_Persona[$i]->options = $opciones;
        }
        $arr_Respuesta['status'] = true;
        $arr_Respuesta['contenido'] = $arr_Persona;
    }

    echo json_encode($arr_Respuesta);
}


if ($tipo == "registrar") {

  if ($_POST) {
    $nro_identidad = $_POST['numero_identidad'];
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
      $opciones = '<a href="" class="btn btn-success"><i class="fa fa-pencil"> Editar</i></a>
                       <a href="" class="btn btn-danger"><i class="fa fa-trash"> Eliminar</i></a>';
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
?>
