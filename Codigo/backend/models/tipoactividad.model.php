<?php
//TODO: Clase de TipoActividad
require_once('../config/comun.php');

class TipoActividad
{
    //TODO: Implementar los metodos de la clase TipoActividad
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("tipo_actividad","id_tipoactividad");
        $this->tabla->AgregarCampo("nombre");
    }
    public function todos() 
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }
    public function uno($id_tipoactividad) 
    {
        $datos = $this->tabla->DevolverUno($id_tipoactividad);
        return $datos;
    }
    public function insertar($nombre) 
    {
        $valores = array($nombre);
        return $this->tabla->InsertarRegistro($valores);
    }
    public function actualizar($id_tipoactividad, $nombre) 
    {
        $valores = array($nombre);
        return $this->tabla->ActualizarRegistro($id_tipoactividad, $valores);
    }
    public function eliminar($id_tipoactividad) 
    {
       return $this->tabla->EliminarRegistro($id_tipoactividad);
        
    }
}