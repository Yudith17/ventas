<?php 
require_once('../model/compraModel.php');
require_once('../model/productoModel.php');
require_once('../model/personaModel.php');
$tipo = $_REQUEST['tipo'];

// Instancio las clases
$objCompra = new CompraModel();  // Modelo de compras
$objProducto = new ProductoModel();
$objPersona = new PersonaModel();

if ($tipo == "listar") {

    $arr_respuesta = array('status' => false, 'contenido' => '');
    $arr_compras = $objCompra->obtener_compras();  // Obtenemos todas las compras

    if (!empty($arr_compras)) {
        for ($i = 0; $i < count($arr_compras); $i++) {
            
            // Relacionar el producto con la compra
            $id_producto = $arr_compras[$i]->id_producto;
            $r_producto = $objProducto->obtener_Producto($id_producto);  // Obtenemos la información del producto
            $arr_compras[$i]->producto = $r_producto;  // Añadimos el producto a la compra

            // Relacionar el trabajador con la compra
            $id_trabajador = $arr_compras[$i]->id_trabajador;
            $r_trabajador = $objPersona->obtener_Persona($id_trabajador);  // Obtenemos la información del trabajador
            $arr_compras[$i]->trabajador = $r_trabajador;  // Añadimos el trabajador a la compra

            // Información adicional de la compra
            $arr_compras[$i]->nro = $i + 1;  // Número de la compra (puedes ajustar cómo se numera)

            // No he añadido más, pero podrías incluir botones de acción si es necesario
            $arr_compras[$i]->options = '';  // Este campo puedes rellenarlo con los botones de "Editar" o "Eliminar"
        }
        
        // Respuesta exitosa
        $arr_respuesta['status'] = true;
        $arr_respuesta['contenido'] = $arr_compras;
    }

    // Respondemos con los datos en formato JSON
    echo json_encode($arr_respuesta);
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
