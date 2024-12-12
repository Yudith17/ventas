<?php 
require_once('../model/compraModel.php');
require_once('../model/personaModel.php');
require_once('../model/productoModel.php');

$tipo  = $_REQUEST['tipo'];
//instancio la clase  productoModel

$objCompra = new CompraModel();
$objProducto = new ProductoModel();
$objPersona = new PersonaModel();

if ($tipo == "listar") {
    $arr_Respuesta = array('status' => false, 'contenido' => '');
    $arrCompra = $objCompra->obtener_compra();

    if (!empty($arrCompra)) {
        for ($i = 0; $i < count($arrCompra); $i++) {
            $id_compra = $arrCompra[$i]->id;
            $id_producto = $arrCompra[$i]->id_producto;
            $cantidad = $arrCompra[$i]->cantidad;
            $precio = $arrCompra[$i]->precio;
            $id_trabajador = $arrCompra[$i]->id_trabajador;

            $id_producto = $arrCompra[$i]->id_producto;
            $r_producto = $objProducto->obtener_producto_id($id_producto);
            $arrCompra[$i]->producto=$r_producto;

            $id_trabajador = $arrCompra[$i]->id_trabajador;
            $r_trabajador = $objPersona->obtener_trabajador_id($id_trabajador);
            $arrCompra[$i]->trabajador=$r_trabajador;

            $opciones = '
            <a href="'.BASE_URL.'editar-compra/'.$id_compra.'"><i class="fas fa-edit btn btn-success btn-sm"></i></a>
                 <button onclick="eliminar_compra('.$id_compra.');"class="btn btn-warning btn-sm"><i class="fas fa-trash-alt"></i></button>
                 ';
            $arrCompra[$i]->options = $opciones;
            
        }
            $arr_Respuesta['status'] = true;
            $arr_Respuesta['contenido'] =  $arrCompra;
    }
    echo json_encode($arr_Respuesta); //convertir en formato -- 
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
