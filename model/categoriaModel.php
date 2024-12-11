<?php
require_once "../librerias/conexion.php";

class CategoriaModel{

    private $conexion;


    function __construct(){
        $this->conexion =new Conexion();
        $this->conexion =$this->conexion->connect();
    }

    public function Obtener_categorias(){
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM categoria");
        while($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
    
        }
        return $arrRespuesta;

    }
    public function registrarCategoria($nombre, $detalle){
        $sql=$this->conexion->query("CALL insertarCategoria('{$nombre}', 
        '{$detalle}')");
         $sql  = $sql->fetch_object();
         return $sql;
     }
     public function obtener_categoria_por_id($id_categoria){
    $respuesta = $this->conexion->query("SELECT nombre FROM categoria WHERE id_categoria = '{$id_categoria}'");
    $objeto = $respuesta->fetch_object();
    return $objeto;
    }


     public function verCategoria($id){
        $sql = $this->conexion->query("SELECT * FROM categoria WHERE id='$id'");
        $sql = $sql->fetch_object();
        return $sql;

     }


     public function actualizarCategoria($id_categoria, $nombre, $detalle){
         $sql = $this->conexion->query("CALL actualizarCategoria('{$id_categoria}', '{$nombre}', '{$detalle}')");
         $sql = $sql->fetch_object();
         return $sql;
     }
     
 
     public function eliminarCategoria($id_categoria){
    $sql = $this->conexion->query("CALL eliminarCategoria('{$id_categoria}')");
    $sql = $sql->fetch_object();
    return $sql;
}


}

?>