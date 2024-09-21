<?php
//TODO: Clase de Preferencias
require_once('../config/comun.php');

class Preferencias
{
    //TODO: Implementar los metodos de la clase Preferencias
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("preferencias","id_preferencia");
        $this->tabla->AgregarCampo("descripcion");
        $this->tabla->AgregarCampo("id_tipo_actividad");
    }
    public function todos() 
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }
    public function uno($id_preferencia) 
    {
        $datos = $this->tabla->DevolverUno($id_preferencia);
        return $datos;
    }
    public function insertar($descripcion,$id_tipo_actividad ) 
    {
        $valores = array($descripcion,$id_tipo_actividad );
        return $this->tabla->InsertarRegistro($valores);
    }
    public function actualizar($id_preferencia, $descripcion,$id_tipo_actividad ) 
    {
        $valores = array($descripcion,$id_tipo_actividad);
        return $this->tabla->ActualizarRegistro($id_preferencia, $valores);
    }
    public function eliminar($id_preferencia) 
    {
        $this->tabla->EliminarRegistro($id_preferencia);
    }
}