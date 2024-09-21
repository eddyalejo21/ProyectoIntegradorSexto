<?php
//TODO: Clase de Usuarios
require_once('../config/comun.php');

class Usuarios
{
    //TODO: Implementar los metodos de la clase Usuarios
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("usuarios","id_usuario");
        $this->tabla->AgregarCampo("id_persona");
        $this->tabla->AgregarCampo("nick");
        $this->tabla->AgregarCampo("id_estado");
        $this->tabla->AgregarCampo("id_rol");
    }
    public function todos() 
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }
    public function uno($id_usuario) 
    {
        $datos = $this->tabla->DevolverUno($id_usuario);
        return $datos;
    }
    public function insertar($id_persona,$nick,$id_estado,$id_rol ) 
    {
        $valores = array($id_persona,$nick,$id_estado,$id_rol );
        return $this->tabla->InsertarRegistro($valores);
    }
    public function actualizar($id_usuario, $id_persona,$nick,$id_estado,$id_rol ) 
    {
        $valores = array($id_persona,$nick,$id_estado,$id_rol);
        return $this->tabla->ActualizarRegistro($id_usuario, $valores);
    }
    public function eliminar($id_usuario) 
    {
        $this->tabla->EliminarRegistro($id_usuario);
    }
}