<?php 
require_once('../model/compraModel.php');
$tipo = $_REQUEST['tipo'];


$objCompra = new CompraModel();

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
            $arrCompra = $objCompra->registrarCompra($producto, $cantidad, $precio, $trabajador);
              
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
    $id = $_REQUEST['id'];
    $compra = $objCompra->verCompra($id);
    echo json_encode($compra);
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
