<?php
require_once "../librerias/conexion.php";

class CategoriaModel{

    private $conexion;
    function __construct()
    {
        $this->conexion =new Conexion();
        $this->conexion =$this->conexion->connect();
    }
    public function insertarCategoria( $nombre, $detalle, ){
       $sql=$this->conexion->query("CALL insertarCategoria( '{$nombre}', 
       '{$detalle}')");
        $sql  = $sql->fetch_object();
        return $sql;
    }

    public function Obtener_categorias(){
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM categoria");
        while($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
    
        }
        return $arrRespuesta;

    }
}

?>