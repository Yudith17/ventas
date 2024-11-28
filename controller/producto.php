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
    
}
if ($tipo=="actualizar") {
   
}

if ($tipo=="eliminar") {
    
}
?>