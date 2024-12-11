<?php
require_once('../model/categoriaModel.php');
$tipo=$_REQUEST['tipo'];

$objCategoria = new CategoriaModel();

if ($tipo=="registrar") {
    // print_r($_POST);
   //echo $_FILES['imagen']['tmp_name'];
 
     
     if($_POST){
         $nombre = $_POST['nombre'];
         $detalle = $_POST['detalle'];
 
         if ($nombre=="" || $detalle=="") {
             $arr_respuesta = array('status'=>false,'mensaje'=>'Error,campos vacíos');
         }else {
            $arr_categorias = $objCategoria->registrarCategoria($nombre, $detalle);
               
            if ($arr_categorias->id>0 ) {
             $arr_Respuesta = array('status'=>true,
             'mensaje'=>'Registro Exitoso');

            }else {
             $arr_Respuesta = array('status'=>false,
             'mensaje'=>'Error al registrar categoria');
            }
            echo json_encode($arr_Respuesta);
         }
     }
 }
if ($tipo=="listar"){

    $arr_respuesta = array('status'=>false,'contenido'=>'');
    $arr_categorias =  $objCategoria->obtener_categorias();

    if (!empty($arr_categorias)) {
        
        for ($i=0; $i < count($arr_categorias); $i++) { 
            $id_categoria = $arr_categorias[$i]->id;
            $categoria = $arr_categorias[$i]->nombre;
            $opciones = '<a href="' . BASE_URL . 'editar-categoria/' . $id_categoria . '">Editar</a>
    <button onclick="Eliminar_categoria(' . $id_categoria . ');">Eliminar</button>';
    $arr_categorias[$i]->options = $opciones;}
        $arr_respuesta ['status']=true;
        $arr_respuesta ['contenido']= $arr_categorias;
    }
       
      echo json_encode($arr_respuesta);
}


if ($tipo == 'obtener') {
    $id_categoria = $_GET['id'];  // Cambié 'id' por 'id_categoria' para obtener la categoría
    $categoria = obtener_categoria_por_id($id_categoria); // Función que obtiene la categoría por su ID
    
    if ($categoria) {
        echo json_encode(['status' => true, 'contenido' => $categoria]);
    } else {
        echo json_encode(['status' => false, 'mensaje' => 'Categoría no encontrada']);
    }
}


if ($tipo == "ver") {
    $id_categoria = $_POST['id_categoria'];
    // Llamar al modelo para obtener los detalles de la categoría
    $categoria = $objCategoria->verCategoria($id_categoria);

    if ($categoria) {
        $arr_Respuesta = array('status' => true, 'contenido' => $categoria);
    } else {
        $arr_Respuesta = array('status' => false, 'mensaje' => 'Categoría no encontrada');
    }
    echo json_encode($arr_Respuesta);
}


if ($tipo == "actualizar") {
    // Obtener los datos del formulario
    $id_categoria = $_POST['id_categoria']; // ID de la categoría a actualizar
    $nombre = $_POST['nombre']; // Nombre de la categoría
    $detalle = $_POST['detalle']; // Detalle de la categoría
    
    // Validación de campos
    if ($nombre == "" || $detalle == "") {
        // Respuesta de error si algún campo está vacío
        $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
    } else {
        // Llamada a la función para actualizar la categoría
        $arrCategoria = $objCategoria->actualizarCategoria($id_categoria, $nombre, $detalle);
        
        // Verificar si la actualización fue exitosa
        if ($arrCategoria->p_id > 0) {
            $arr_Respuesta = array('status' => true, 'mensaje' => 'Categoría actualizada correctamente');
        } else {
            $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al actualizar categoría');
        }
    }

    // Enviar la respuesta en formato JSON
    echo json_encode($arr_Respuesta);
}


if ($tipo == "eliminar") {
    $id_categoria = $_POST['id_categoria']; // Cambié 'id_producto' por 'id_categoria'
    
    // Llamar a la función eliminarCategoria que está en el modelo para eliminar la categoría
    $arr_Respuesta = $objCategoria->eliminarCategoria($id_categoria);
    
    if (empty($arr_Respuesta)) {
        $response = array('status' => false);
    } else {
        $response = array('status' => true);
    }
    
    echo json_encode($response);
}


?>


