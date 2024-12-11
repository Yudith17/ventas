<?php

require_once "../librerias/conexion.php";
class PersonaModel
{

    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }

    public function registrarPersona(
        $nro_identidad,
        $razon_social,
        $telefono,
        $correo,
        $departamento,
        $provincia,
        $distrito,
        $cod_postal,
        $direccion,
        $rol,
        $password
    ) {
        // Ejecutar un procedimiento almacenado y el procedimiento almacena los datos de una persona en la base de datos
        $sql = $this->conexion->query("CALL insertarPersona(
            '{$nro_identidad}', '{$razon_social}', '{$telefono}', 
            '{$correo}', '{$departamento}', '{$provincia}', 
            '{$distrito}', '{$cod_postal}', '{$direccion}', 
            '{$rol}', '{$password}')");
        $sql = $sql->fetch_object();
        return $sql;
    }
    
   
    public function obtener_personas()
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query(" SELECT * FROM persona");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }

     public function buscarPersonaPorDNI($nro_identidad)
    {
        $sql = $this->conexion->query("SELECT * FROM persona WHERE nro_identidad='{$nro_identidad}'");
        $sql = $sql->fetch_object();
        return $sql;
    }

    public function obtener_trabajadores()
    {
        $arrRespuesta = array();
        // Consulta a la tabla persona de la BD para obtener los trabajadores
        $respuesta = $this->conexion->query("SELECT * FROM persona WHERE rol = 'trabajador'");

        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }

        return $arrRespuesta;
    }

    public function obtener_proveedores()
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM persona WHERE rol = 'proveedor'");

        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function obtener_persona($id){
        $respuesta = $this->conexion->query("SELECT * FROM persona WHERE id='{$id}'");
        $respuesta = $respuesta->fetch_object();
        return $respuesta;
    }

    public function obtener_proveedor_por_id($id)
    {
        $respuesta = $this->conexion->query("SELECT razon_social FROM persona WHERE id = '{$id}'");
        $objeto = $respuesta->fetch_object();
        return $objeto;
    }
    public function obtener_trabajador_por_id($id)
{
    $respuesta = $this->conexion->query("SELECT razon_social FROM persona WHERE id = '{$id}'");
    return $respuesta->fetch_object();
}
public function verPersona($id){
    $sql = $this->conexion->query("SELECT * FROM persona WHERE id='{$id}'");
    $sql = $sql->fetch_object();
    return $sql;
} 

public function actualizarPersona($id, $nro_identidad, $razon_social, $telefono, $correo, $departamento, $provincia, $distrito, $cod_postal, $direccion, $rol){
    $sql = $this->conexion->query("CALL actualizarPersona('{$id}', '{$nro_identidad}', '{$razon_social}', '{$telefono}', '{$correo}', '{$departamento}', '{$provincia}', '{$distrito}', '{$cod_postal}', '{$direccion}', '{$rol}')");
    $sql = $sql->fetch_object();
    return $sql;
}

public function eliminarPersona($id){
    $sql = $this->conexion->query("CALL eliminarPersona('{$id}')");
    $sql = $sql->fetch_object();
    return $sql;
}

}
?>