<?php
require_once "../librerias/conexion.php";

class PersonaModel {

    private $conexion;

    function __construct() {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }

    public function obtener_persona(){
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM persona");
        while($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
    
        }
        return $arrRespuesta;
    }

    
    public function registrarPersona(
        $nro_identidad, $razon_social, $telefono, $correo,
        $departamento, $provincia, $distrito, $cod_postal,
        $direccion, $rol, $password, $estado, $fecha_reg
    ) {
        $sql = $this->conexion->prepare("CALL insertarPersona(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param(
            "ssssssssssssi",
            $nro_identidad, $razon_social, $telefono, $correo,
            $departamento, $provincia, $distrito, $cod_postal,
            $direccion, $rol, $password, $estado, $fecha_reg
        );

        $sql->execute();
        $result = $sql->get_result();
        $persona = $result ? $result->fetch_object() : null;
        $sql->close();
        
        return $persona;
    }
   
  
    public function actualizarPersona($id, $razon_social, $telefono, $correo, $direccion, $rol, $estado) {
        $sql = $this->conexion->prepare("UPDATE persona SET 
            razon_social = ?, telefono = ?, correo = ?, direccion = ?, rol = ?, estado = ? 
            WHERE id = ?");
        $sql->bind_param("ssssssi", $razon_social, $telefono, $correo, $direccion, $rol, $estado, $id);

        $success = $sql->execute();
        $sql->close();

        return $success;
    }
    public function buscarPersonaPorDNI($dni){
        $sql = $this->conexion->query("SELECT * FROM persona WHERE nro_identidad='{$dni}'");
        $sql = $sql->fetch_object();
        return $sql;
    }

    
}
?>
