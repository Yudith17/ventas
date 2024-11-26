<?php
require_once "../librerias/conexion.php";

class CompraModel {

    private $conexion;

    function __construct() {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }

    
    public function registrar_Compra($producto, $cantidad, $precio, $trabajador) {
        $sql = $this->conexion->query("CALL insertarCompra('{$producto}', '{$cantidad}', '{$precio}', '{$trabajador}')");
        $sql = $sql->fetch_object();
        return $sql;
    }

   
    public function listarCompras() {
        $result = $this->conexion->query("SELECT * FROM compra");
        $compras = [];
        while ($row = $result->fetch_assoc()) {
            $compras[] = $row;
        }
        return $compras;
    }

    
    public function verCompra($id) {
        $result = $this->conexion->query("SELECT * FROM compra WHERE id = '{$id}'");
        return $result->fetch_assoc();
    }

    
    public function actualizarCompra($id, $producto, $cantidad, $precio, $trabajador) {
        $sql = $this->conexion->query("UPDATE compra SET 
            producto = '{$producto}', 
            cantidad = '{$cantidad}', 
            precio = '{$precio}', 
            trabajador = '{$trabajador}' 
            WHERE id = '{$id}'");
        return $sql;
    }

    
    public function eliminarCompra($id) {
        $sql = $this->conexion->query("DELETE FROM compra WHERE id = '{$id}'");
        return $sql;
    }
}
?>
