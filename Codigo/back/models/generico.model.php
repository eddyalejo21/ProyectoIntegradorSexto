<?php
//TODO: Clase de NombreTablas
require_once('../config/comun.php');

class NombreTablas
{
    //TODO: Implementar los metodos de la clase NombreTablas
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("nombretablas","id_nombreID");
        $this->tabla->AgregarCampo("nombrecampo");
    }
    public function todos() 
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }
    public function uno($id_nombreID) 
    {
        $datos = $this->tabla->DevolverUno($id_nombreID);
        return $datos;
    }
    public function insertar($nombrecampo, ) 
    {
        $valores = array($nombrecampo, );
        return $this->tabla->InsertarRegistro($valores);
    }
    public function actualizar($id_nombreID, $nombrecampo, ) 
    {
        $valores = array($nombrecampo,);
        return $this->tabla->ActualizarRegistro($id_nombreID, $valores);
    }
    public function eliminar($id_nombreID) 
    {
        $this->tabla->EliminarRegistro($id_nombreID);
    }
}