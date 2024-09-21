<?php
//TODO: Clase de Claves
require_once('../config/comun.php');

class Claves
{
    //TODO: Implementar los metodos de la clase Claves
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("claves","id_clave");
        $this->tabla->AgregarCampo("valor");
        $this->tabla->AgregarCampo("id_estado");
        $this->tabla->AgregarCampo("id_usuario");
        $this->tabla->AgregarCampo("fecha_vigente");
    }
    public function todos() 
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }
    public function uno($id_clave) 
    {
        $datos = $this->tabla->DevolverUno($id_clave);
        return $datos;
    }
    public function insertar($valor,$id_estado,$id_usuario,$fecha_vigente ) 
    {
        $valores = array($valor,$id_estado,$id_usuario,$fecha_vigente );
        return $this->tabla->InsertarRegistro($valores);
    }
    public function actualizar($id_clave, $valor,$id_estado,$id_usuario,$fecha_vigente ) 
    {
        $valores = array($valor,$id_estado,$id_usuario,$fecha_vigente);
        return $this->tabla->ActualizarRegistro($id_clave, $valores);
    }
    public function eliminar($id_clave) 
    {
        $this->tabla->EliminarRegistro($id_clave);
    }
}