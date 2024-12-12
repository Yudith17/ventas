<?php 
require_once('../model/productoModel.php');
require_once('../model/categoriaModel.php');
require_once('../model/personaModel.php');
$tipo=$_REQUEST['tipo'];

//instancio la clase modeloproducto
$objProducto = new ProductoModel();
$objCategoria = new CategoriaModel();
$objPersona = new PersonaModel();
$objproveedor = new PersonaModel();
if ($tipo == "listar") {

    $arr_respuesta = array('status'=>false,'contenido'=>'');
    $arr_productos =  $objProducto->obtener_productos();

    if (!empty($arr_productos)) {
        
        for ($i=0; $i < count($arr_productos); $i++) {

            $id_categoria = $arr_productos[$i]->id_categoria;
            $r_categoria= $objCategoria->Obtener_categorias($id_categoria);
            $arr_productos[$i]->categoria=$r_categoria;

            $id_proveedor = $arr_productos[$i]->id_proveedor;
            $r_proveedor= $objPersona->obtener_persona($id_proveedor);
            $arr_productos[$i]->proveedor=$r_proveedor;

            $id_producto = $arr_productos[$i]->id;
            $producto = $arr_productos[$i]->nombre;
            //localhost/editar-producto/4                                                               //eliminar_producto(va llamar al id);
            $opciones ='<a href=" '.BASE_URL.'editar-producto/'.$id_producto.'">Editar</a><button onclick="Eliminar_producto('.$id_producto.');">Eliminar</button>';
            $arr_productos[$i]->options = $opciones;
        }
        $arr_respuesta ['status']=true;
        $arr_respuesta ['contenido']= $arr_productos;
    }
       
      echo json_encode($arr_respuesta);
}



if ($tipo=="registrar") {
   // print_r($_POST);
  //echo $_FILES['imagen']['tmp_name'];

    if($_POST){
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $detalle = $_POST['detalle'];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];
        $categoria = $_POST['categoria'];
        $imagen = 'imagen';
        $proveedor = $_POST['proveedor'];

        if ($codigo=="" || $nombre=="" || $detalle=="" || $precio=="" || $stock=="" || $categoria=="" ||
        $imagen=="" || $proveedor=="") {
            //respuesta
            $arr_respuesta = array('status'=>false,'mensaje'=>'Error,campos vacíos');
        }else {

          //cargar archivos
          $archivo = $_FILES['imagen']['tmp_name'];
          $destino = '../assets/img_productos/';
          $tipoArchivo = strtolower(pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION));

            $arrProducto = $objProducto->registrarProducto($codigo, $nombre, $detalle, $precio, $stock, $categoria, $imagen, $proveedor, $tipoArchivo);
            if ($arrProducto->id_n > 0) {
                $arr_Respuesta = array(
                  'status' => true,
                  'mensaje' => 'Registro exitoso'
        );
                $nombre = $arrProducto->id_n . "." . $tipoArchivo;
                if (move_uploaded_file($archivo, $destino . '' . $nombre)) {
                } else {
                  $arr_Respuesta = array('status' => true, 'mensaje' => 'Registro exitoso, error al subir la imagen');
                }
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
        


if ($tipo== 'obtener') {
    $id = $_GET['id'];
    $producto = obtener_producto_por_id($id); // Función que obtiene el producto por su ID
    if ($producto) {
        echo json_encode(['status' => true, 'contenido' => $producto]);
    } else {
        echo json_encode(['status' => false, 'mensaje' => 'Producto no encontrado']);
    }
}


if ($tipo=="ver") {
    //print_r($_POST);
    $id_producto = $_POST['id_producto'];
    $arr_Respuesta = $objProducto->verProducto($id_producto);
    //print_r($arr_Respuesta);
    if (empty($arr_Respuesta)) {
        $response = array('status'=> false,'mensaje'=>"Error, no hay informacion");
    }else{
        $response = array('status'=> true,'mensaje'=>"datos encontrados", 'contenido'=>$arr_Respuesta);
    }
    echo json_encode($response);

}

if ($tipo == "actualizar") {
    //print_r($_POST);
    //print_r($_FILES['imagen']['tmp_name']);

    $id_producto = $_POST['id_producto'];
    //$img = $_POST['img'];
    $nombre = $_POST['nombre'];
    $detalle = $_POST['detalle'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];
    $proveedor = $_POST['proveedor'];
    if ($nombre == "" || $detalle == "" || $precio == "" || $categoria == "" || $proveedor == "") {
        //repuesta
        $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
    } else {
        $arrProducto = $objProducto->actualizarProducto($id_producto, $nombre, $detalle, $precio, $categoria, $proveedor);
        if ($arrProducto->p_id > 0) {
            $arr_Respuesta = array('status' => true, 'mensaje' => 'Actualizado Correctamente');

            if ($_FILES['imagen']['tmp_name'] != "") {
                unlink('../assets/img_productos/' . $img);

                //cargar archivos
                $archivo = $_FILES['imagen']['tmp_name'];
                $destino = '../assets/img_productos/';
                $tipoArchivo = strtolower(pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION));
                if (move_uploaded_file($archivo, $destino . '' . $id_producto.'.'.$tipoArchivo)) {
                }
            }
        } else {
            $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al actualizar producto');
        }
    }
    echo json_encode($arr_Respuesta);
}

if ($tipo=="eliminar") {
    $id_producto = $_POST['id_producto'];
    $arr_Respuesta = $objProducto->eliminarProducto($id_producto);
    //print_r($arr_Respuesta);
    if (empty($arr_Respuesta)) {
        $response = array('status'=> false);
    }else{
        $response = array('status'=> true);
    }
    echo json_encode($response);

}

?>