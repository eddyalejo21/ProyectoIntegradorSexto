<?php
//TODO: Clase de Roles
require_once('../config/comun.php');

class Roles
{
    //TODO: Implementar los metodos de la clase Roles
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("roles","id_rol");
        $this->tabla->AgregarCampo("nivel_acceso");
        $this->tabla->AgregarCampo("descripcion");
    }
    public function todos() 
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }
    public function uno($id_rol) 
    {
        $datos = $this->tabla->DevolverUno($id_rol);
        return $datos;
    }
    public function insertar($nivel_acceso,$descripcion ) 
    {
        $valores = array($nivel_acceso,$descripcion );
        return $this->tabla->InsertarRegistro($valores);
    }
    public function actualizar($id_rol, $nivel_acceso,$descripcion ) 
    {
        $valores = array($nivel_acceso,$descripcion);
        return $this->tabla->ActualizarRegistro($id_rol, $valores);
    }
    public function eliminar($id_rol) 
    {
        $this->tabla->EliminarRegistro($id_rol);
    }
}