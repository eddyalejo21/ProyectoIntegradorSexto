<?php
//TODO: Clase para conectar a la Base de Datos
class ClaseConectar
{
    public $conexion;
    protected $db;
    public function ProcedimientoParaConectar($host, $usuario, $pass, $base, $puerto)
    {
        $this->conexion = mysqli_connect($host, $usuario, $pass, $base,$puerto);
        mysqli_query($this->conexion, "SET NAMES 'utf8'");
        if ($this->conexion->connect_error) {
            die("Error al conectar con el servidor: " . $this->conexion->connect_error);
        }
        $this->db = $this->conexion;
        if ($this->db == false) die("Error al conectar con la base de datos: " . $this->conexion->connect_error);
        return $this->conexion;
    }
}