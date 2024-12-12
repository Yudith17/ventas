<?php
require_once "../librerias/conexion.php";

class CompraModel {

    private $conexion;

    function __construct() {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }

    public function registrar_Compra($producto, $cantidad, $precio, $trabajador) {
        $sql = $this->conexion->query("CALL insertarCompras('{$producto}', '{$cantidad}', '{$precio}', '{$trabajador}')");
        
        if ($sql == false) {
            print_r(value: $this->conexion->error);
        }

        $sql = $sql->fetch_object();
        return $sql;
    }


    public function obtener_productos(){
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM producto");
        while($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
    
        }
        return $arrRespuesta;
    }


    public function obtener_compra(){
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM compras");
        while($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
    
        }
        return $arrRespuesta;
    }

    
  
     
    public function verCompra($id) {
        $result = $this->conexion->query("SELECT * FROM compras WHERE id = '{$id}'");
        $sql = $sql->fetch_object();
        return $sql;
    }

   
    public function listarCompras() {
        $result = $this->conexion->query("SELECT * FROM compras");
        $compras = [];
        while ($row = $result->fetch_assoc()) {
            $compras[] = $row;
        }
        return $compras;
    }

   
    
    public function actualizarCompra($id, $producto, $cantidad, $precio, $trabajador) {
        $sql = $this->conexion->query("UPDATE compras SET 
            producto = '{$producto}', 
            cantidad = '{$cantidad}', 
            precio = '{$precio}', 
            trabajador = '{$trabajador}' 
            WHERE id = '{$id}'");
        return $sql;
    }

    
    public function eliminarCompra($id) {
        $sql = $this->conexion->query("DELETE FROM compras WHERE id = '{$id}'");
        return $sql;
    }
}
?>
