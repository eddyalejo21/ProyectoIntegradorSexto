<?php
//TODO: Clase de DetallesActividad
require_once('../config/comun.php');

class DetallesActividad
{
    //TODO: Implementar los metodos de la clase DetallesActividad
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("detallesactividad","id_detalleactividad");
        $this->tabla->AgregarCampo("id_actividad");
        $this->tabla->AgregarCampo("detalle");
    }
    public function todos() 
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }
    public function uno($id_detalleactividad) 
    {
        $datos = $this->tabla->DevolverUno($id_detalleactividad);
        return $datos;
    }
    public function insertar($id_actividad,$detalle ) 
    {
        $valores = array($id_actividad,$detalle );
        return $this->tabla->InsertarRegistro($valores);
    }
    public function actualizar($id_detalleactividad, $id_actividad,$detalle ) 
    {
        $valores = array($id_actividad,$detalle);
        return $this->tabla->ActualizarRegistro($id_detalleactividad, $valores);
    }
    public function eliminar($id_detalleactividad) 
    {
        $this->tabla->EliminarRegistro($id_detalleactividad);
    }
}