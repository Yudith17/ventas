<?php
require_once('../model/compraModel.php');
require_once('../model/productoModel.php');
require_once('../model/personaModel.php');
//instancio la clase  ComprasModel

$objCompra = new CompraModel();
$objProducto = new ProductoModel();
$objPersona = new PersonaModel();

$tipo  = $_REQUEST['tipo'];


if ($tipo == "listar") {
    //respuesta 
    $arr_Respuesta = array('status' => false, 'contenido' => '');
    $arr_Compra = $objCompra->obtener_compra();
    if (!empty($arr_Compra)) {
 
       for ($i = 0; $i < count($arr_Compra); $i++) {
 
          // Obtener producto
          $id_producto = $arr_Compra[$i]->id_producto;
          $r_producto = $objProducto->obtener_producto_por_id($id_producto);
          $arr_Compra[$i]->producto = $r_producto;
 
          // Obtener trabajador
          $id_trabajador = $arr_Compra[$i]->id_trabajador;
          $r_trabajador = $objPersona->obtener_trabajador_por_id($id_trabajador);
          $arr_Compra[$i]->persona = $r_trabajador;
 
          $id_Compras = $arr_Compra[$i]->id;
         
          $opciones ='<a href="'.BASE_URL.'editar-compra/'.$id_Compras.'">Editar</a>
                    <button onclick="Eliminar_compra('.$id_Compras.');">Eliminar</button>';
            $arr_Compra[$i]->options = $opciones;
       }
       $arr_Respuesta['status'] = true;
       $arr_Respuesta['contenido'] = $arr_Compra;
    }
 
    echo json_encode($arr_Respuesta);
 }



if ($tipo == "registrar") {
    if ($_POST) {
        $producto = $_POST['producto'];
        $cantidad = $_POST['cantidad'];
        $precio = $_POST['precio'];
        $trabajador = $_POST['trabajador'];

        // Validate that all fields are filled
        if ($producto == "" || $cantidad == "" || $precio == "" || $trabajador == "") {
            $arr_respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
        } else {
            // Call the method to register the purchase
            $arrCompra = $objCompra->registrar_Compra($producto, $cantidad, $precio, $trabajador);
              
            if ($arrCompra->id > 0) {
                $arr_respuesta = array('status' => true, 'mensaje' => 'Compra registrada exitosamente');
            } else {
                $arr_respuesta = array('status' => false, 'mensaje' => 'Error al registrar la compra');
            }
            echo json_encode($arr_respuesta);
        }
    }
}

if ($tipo == "listar") {
    $compras = $objCompra->listarCompras();
    echo json_encode($compras);
}

if ($tipo == "ver") {
    // Verifica si se ha recibido el ID de la compra
    $id_compra = $_POST['id_compra'] ;

    if ($id_compra) {
        // Llama al método del modelo para obtener la compra
        $arr_Respuesta = $objCompras->verCompra($id_compra);

        // Comprueba si se obtuvo información
        if (empty($arr_Respuesta)) {
            $response = array('status' => false, 'mensaje' => "Error, No hay información");
        } else {
            $response = array('status' => true, 'mensaje' => "Datos Encontrados", 'contenido' => $arr_Respuesta);
        }
    } else {
        $response = array('status' => false, 'mensaje' => "Error, ID de compra no proporcionado");
    }

    echo json_encode($response);
}


if ($tipo == "actualizar") {
    if ($_POST) {
        $id = $_POST['id'];
        $producto = $_POST['roducto'];
        $cantidad = $_POST['cantidad'];
        $precio = $_POST['precio'];
        $trabajador = $_POST['id_trabajador'];

        if ($producto == "" || $cantidad == "" || $precio == "" || $trabajador == "") {
            $arr_respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
        } else {
            $arrCompra = $objCompra->actualizarCompra($id, $producto, $cantidad, $precio, $trabajador);
              
            if ($arrCompra) {
                $arr_respuesta = array('status' => true, 'mensaje' => 'Compra actualizada exitosamente');
            } else {
                $arr_respuesta = array('status' => false, 'mensaje' => 'Error al actualizar la compra');
            }
            echo json_encode($arr_respuesta);
        }
    }
}

if ($tipo == "eliminar") {
    $id = $_REQUEST['id'];
    $resultado = $objCompra->eliminarCompra($id);
    if ($resultado) {
        $arr_respuesta = array('status' => true, 'mensaje' => 'Compra eliminada exitosamente');
    } else {
        $arr_respuesta = array('status' => false, 'mensaje' => 'Error al eliminar la compra');
    }
    echo json_encode($arr_respuesta);
}
?>
