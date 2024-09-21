<?php
//TODO: Clase de PreferenciasPersona
require_once('../config/comun.php');

class PreferenciasPersona
{
    //TODO: Implementar los metodos de la clase PreferenciasPersona
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("preferenciaspersona","id_preferenciapersona");
        $this->tabla->AgregarCampo("id_preferencia");
        $this->tabla->AgregarCampo("id_persona");
        $this->tabla->AgregarCampo("grado");
    }
    public function todos() 
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }
    public function uno($id_preferenciapersona) 
    {
        $datos = $this->tabla->DevolverUno($id_preferenciapersona);
        return $datos;
    }
    public function insertar($id_preferencia,$id_persona,$grado ) 
    {
        $valores = array($id_preferencia,$id_persona,$grado );
        return $this->tabla->InsertarRegistro($valores);
    }
    public function actualizar($id_preferenciapersona, $id_preferencia,$id_persona,$grado ) 
    {
        $valores = array($id_preferencia,$id_persona,$grado);
        return $this->tabla->ActualizarRegistro($id_preferenciapersona, $valores);
    }
    public function eliminar($id_preferenciapersona) 
    {
        $this->tabla->EliminarRegistro($id_preferenciapersona);
    }
}