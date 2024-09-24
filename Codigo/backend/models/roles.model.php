<?php
//TODO: Clase de Comercios
require_once('../config/comun.php');

class Roles
{
    //TODO: Implementar los metodos de la clase empleados
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("roles", "id_rol");
        $this->tabla->AgregarCampo("nombre");
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
    public function insertar($nombre)
    {
        $valores = array($nombre);
        return $this->tabla->InsertarRegistro($valores);
    }
    public function actualizar($id_rol, $nombre)
    {
        $valores = array($nombre);
        return $this->tabla->ActualizarRegistro($id_rol, $valores);
    }
    public function eliminar($id_rol)
    {
        return $this->tabla->EliminarRegistro($id_rol);
    }

}
