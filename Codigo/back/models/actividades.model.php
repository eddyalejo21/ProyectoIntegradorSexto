<?php
//TODO: Clase de Actividades
require_once('../config/comun.php');

class Actividades
{
    //TODO: Implementar los metodos de la clase Actividades
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("actividades","id_actividad");
        $this->tabla->AgregarCampo("nombre");
        $this->tabla->AgregarCampo("id_tipo_actividad");
    }
    public function todos() 
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }
    public function uno($id_actividad) 
    {
        $datos = $this->tabla->DevolverUno($id_actividad);
        return $datos;
    }
    public function insertar($nombre,$id_tipo_actividad ) 
    {
        $valores = array($nombre,$id_tipo_actividad );
        return $this->tabla->InsertarRegistro($valores);
    }
    public function actualizar($id_actividad, $nombre,$id_tipo_actividad ) 
    {
        $valores = array($nombre,$id_tipo_actividad);
        return $this->tabla->ActualizarRegistro($id_actividad, $valores);
    }
    public function eliminar($id_actividad) 
    {
        $this->tabla->EliminarRegistro($id_actividad);
    }
}