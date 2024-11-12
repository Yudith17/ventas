<?php 
require_once('../model/categoriaModel.php');  // Incluir el modelo de categoría
$tipo = $_REQUEST['tipo'];


$objCategoria = new CategoriaModel();

if ($tipo == "registrarCategoria") {

    
    if ($_POST) {
        $nombreCategoria = $_POST['nombre'];  
        $detalleCategoria = $_POST['detalle'];  

        
        if ($nombreCategoria == "" || $detalleCategoria == "") {
            
            $arr_respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
        } else {
            
            $arrCategoria = $objCategoria->registrarCategoria($nombreCategoria, $detalleCategoria);

            if ($arrCategoria->id > 0) {
                
                $arr_Respuesta = array('status' => true, 'mensaje' => 'Categoría registrada exitosamente');
            } else {
                
                $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al registrar categoría');
            }

            
            echo json_encode($arr_Respuesta);
        }
    }
}


if ($tipo == "listar") {
    
}

if ($tipo == "ver") {
    
}

if ($tipo == "actualizar") {
    
}

if ($tipo == "eliminar") {
    
}
?>



