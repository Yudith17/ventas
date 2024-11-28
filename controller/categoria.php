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
            $categoria = $arr_categorias[$i]->id;
            $categoria = $arr_categorias[$i]->nombre;
            $opciones ='';
            $arr_categorias[$i]->options = $opciones;
        }
        $arr_respuesta ['status']=true;
        $arr_respuesta ['contenido']= $arr_categorias;
    }
       
      echo json_encode($arr_respuesta);
}


?>


