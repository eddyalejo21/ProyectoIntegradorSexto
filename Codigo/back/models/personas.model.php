<?php
//TODO: Clase de Personas
require_once('../config/comun.php');

class Personas
{
    //TODO: Implementar los metodos de la clase Personas
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("personas","id_persona");
        $this->tabla->AgregarCampo("nombres");
        $this->tabla->AgregarCampo("apellidos");
        $this->tabla->AgregarCampo("id_nacionalidad");
    }
    public function todos() 
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }
    public function uno($id_persona) 
    {
        $datos = $this->tabla->DevolverUno($id_persona);
        return $datos;
    }
    public function insertar($nombres,$apellidos,$id_nacionalidad ) 
    {
        $valores = array($nombres,$apellidos,$id_nacionalidad );
        return $this->tabla->InsertarRegistro($valores);
    }
    public function actualizar($id_persona, $nombres,$apellidos,$id_nacionalidad ) 
    {
        $valores = array($nombres,$apellidos,$id_nacionalidad);
        return $this->tabla->ActualizarRegistro($id_persona, $valores);
    }
    public function eliminar($id_persona) 
    {
        $this->tabla->EliminarRegistro($id_persona);
    }
}