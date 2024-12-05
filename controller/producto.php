<?php 
require_once('../model/productoModel.php');
require_once('../model/categoriaModel.php');
require_once('../model/personaModel.php');
$tipo=$_REQUEST['tipo'];

//instancio la clase modeloproducto
$objProducto = new ProductoModel();
$objCategoria = new CategoriaModel();
$objPersona = new PersonaModel();

if ($tipo == "listar") {

    $arr_respuesta = array('status'=>false,'contenido'=>'');
    $arr_productos =  $objProducto->obtener_productos();

    if (!empty($arr_productos)) {
        
        for ($i=0; $i < count($arr_productos); $i++) {

            $id_categoria = $arr_productos[$i]->id_categoria;
            $r_categoria= $objCategoria->obtener_Categoria($id_categoria);
            $arr_productos[$i]->categoria=$r_categoria;

            $id_proveedor = $arr_productos[$i]->id_proveedor;
            $r_proveedor= $objPersona->obtener_Persona($id_proveedor);
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
           $arrProducto = $objProducto->registrarProducto($codigo, $nombre, $detalle, $precio, $stock, $categoria, $imagen, $proveedor);
              
           if ($arrProducto->id>0 ) {
            $arr_Respuesta = array('status'=>true,
            'mensaje'=>'Registro Exitoso');

          //cargar archivos
            $archivo = $_FILES['imagen']['tmp_name'];
            $destino = './assets/img_productos/';
            $tipoArchivo = strtolower(pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION));


            $nombre = $arrProducto->id.".".$tipoArchivo;
            if (move_uploaded_file($archivo,$destino.$nombre)) {
               $arr_imagen = $objProducto->actualizar_imagen($id, $nombre);
            }else{
                $arr_respuesta = array('status'=>true,'mensaje'=>'Registro Exitoso, error al subir imagen');
            }

           }else {
            $arr_Respuesta = array('status'=>false,
            'mensaje'=>'Error al registrar producto');
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

if ($tipo == 'eliminar') {
    $id = $_GET['id'];
    $resultado = eliminar_producto($id); // Función para eliminar el producto
    if ($resultado) {
        echo json_encode(['status' => true, 'mensaje' => 'Producto eliminado']);
    } else {
        echo json_encode(['status' => false, 'mensaje' => 'Error al eliminar el producto']);
    }
}




if ($tipo=="ver") {
    //print_r($_POST);
    $id_producto = $_POST['id_producto'];
    $arr_Respuesta = $objProducto->verProducto($id_producto);
    //print_r($arr_Respuesta);
    if (empty($arr_Respuesta)) {
        $respuesta = array('status'=> false,'mensaje'=>"Error, no hay informacion");
    }else{
        $response = array('status'=> true,'mensaje'=>"datos encontrados", 'contenido'=>$arr_Respuesta);
    }
    echo json_encode($response);

}
if ($tipo=="actualizar") {
   //print_r($_POST['']);
   //print_r($_FILES['imagen']['tmp_name']);
   if($_POST){
    $id_producto = $_POST['id_producto']
    $img = $_POST['img'];
    $nombre = $_POST['nombre'];
    $detalle = $_POST['detalle'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];
    $proveedor = $_POST['proveedor'];

    if ($id_producto ==""|| $nombre=="" || $detalle=="" || $precio=="" ||$categoria=="" ||
     $proveedor=="") {
        //respuesta
        $arr_respuesta = array('status'=>false,'mensaje'=>'Error,campos vacíos');
    }else {
        $arrProducto = $objProducto->actualizarPorducto($id,$nombre,$detalle,$precio , $categoria,  $proveedor);
        if ($arrProducto->id_producto> 0) {
           $arr_respuesta = array ('status' => true mensaje => 'Actualizado correctamente');
            if ($_FILES ['imagen'] ['tmp_name'] !="") {
                unlink('../assets/img_producto/'.$img);

                //cargar archivo
                $archivo = $_FILES['imagen']['tmp_name'];
                $destino = './assets/img_productos/';
                $tipoArchivo = strtolower(pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION));
                
                if (move_uploaded_file($archivo, $destino . '' . $id_producto.' . ' .$tipoArchivo)) {
                    # code...
                }
    
            }

        }else{
            $arr_respuesta = array ('status' => false mensaje => 'Error al actualizar producto');
        }
    }

}
}

if ($tipo=="eliminar") {
    
}
?>