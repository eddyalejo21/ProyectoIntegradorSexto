<?php
//TODO: Clase de LogsAcceso
require_once('../config/comun.php');

class LogsAcceso
{
    //TODO: Implementar los metodos de la clase LogsAcceso
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("logsacceso","id_logacceso");
        $this->tabla->AgregarCampo("id_usuario");
        $this->tabla->AgregarCampo("fecha_acceso");
        $this->tabla->AgregarCampo("hora_accceso");
    }
    public function todos() 
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }
    public function uno($id_logacceso) 
    {
        $datos = $this->tabla->DevolverUno($id_logacceso);
        return $datos;
    }
    public function insertar($id_usuario,$fecha_acceso,$hora_accceso ) 
    {
        $valores = array($id_usuario,$fecha_acceso,$hora_accceso );
        return $this->tabla->InsertarRegistro($valores);
    }
    public function actualizar($id_logacceso, $id_usuario,$fecha_acceso,$hora_accceso ) 
    {
        $valores = array($id_usuario,$fecha_acceso,$hora_accceso);
        return $this->tabla->ActualizarRegistro($id_logacceso, $valores);
    }
    public function eliminar($id_logacceso) 
    {
        $this->tabla->EliminarRegistro($id_logacceso);
    }
}