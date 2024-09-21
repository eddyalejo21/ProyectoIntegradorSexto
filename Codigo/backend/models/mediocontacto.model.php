<?php
//TODO: Clase de Comercios
require_once('../config/comun.php');

class MedioContacto
{
    //TODO: Implementar los metodos de la clase Proveedores
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("medio_contacto","id_mediocontacto");
        $this->tabla->AgregarCampo("nombre");
    }
    public function todos() 
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }
    public function uno($id_mediocontacto) 
    {
        $datos = $this->tabla->DevolverUno($id_mediocontacto);
        return $datos;
    }
    public function insertar($nombre) 
    {
        $valores = array($nombre);
        return $this->tabla->InsertarRegistro($valores);
    }
    public function actualizar($id_mediocontacto, $nombre) 
    {
        $valores = array($nombre);
        return $this->tabla->ActualizarRegistro($id_mediocontacto, $valores);
    }
    public function eliminar($id_mediocontacto) 
    {
       return $this->tabla->EliminarRegistro($id_mediocontacto);
        
    }
}