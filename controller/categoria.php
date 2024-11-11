<?php
require_once('../model/categoriaModel.php');
$tipo=$_REQUEST['tipo'];

//instanciar la clase categoria model
$objCategoria = new CategoriaModel();

if ($tipo=="listar"){
//respuesta
    $arr_respuesta = array('status'=>false,'contenido'=>'');
    $arr_categorias =  $objCategoria->obtener_categorias();

    if (!empty($arr_categorias)) {
        //recorremos el arraypsrs sgregar las opciones de las categorias
        for ($i=0; $i < count($arr_categorias); $i++) { 
            $id_categoria = $arr_categorias[$i]->id;
            $categoria = $arr_categorias[$i]->nombre;
            $opciones ='';
            $arr_categorias[$i]->options = $opciones;
        }
        $arr_respuesta ['status']=true;
        $arr_respuesta ['contenido']= $arr_categorias;
    }
        //$arr_respuesta['contenido']=$arr_categorias;
      echo json_encode($arr_respuesta);
}


?>


