<?php
    require_once('../model/proveedorModel.php');
    $tipo=$_REQUEST['tipo'];

    $objproveedor = new proveedorModel();


    if ($tipo=="listar") {
        $arr_respuesta = array('status'=>false,'contenido'=>'');
        $arr_proveedor =  $objproveedor->obtener_proveedor();

        if (!empty($arr_proveedor)) {
            
            for ($i=0; $i < count($arr_proveedor); $i++) { 
                $rol_persona = $arr_proveedor[$i]->rol;
                $categoria = $arr_proveedor[$i]->razon_social;
                $opciones = '';
                $arr_proveedor[$i]->options = $opciones;
            }
            $arr_respuesta['status'] = true;
            $arr_respuesta['contenido'] = $arr_proveedor;
        }
        //$arr_respuesta['contenido']=$arr_proveedor;
        echo json_encode($arr_respuesta);

    }
?>