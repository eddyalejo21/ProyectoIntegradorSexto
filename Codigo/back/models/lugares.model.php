<?php
//TODO: Clase de Lugares
require_once('../config/comun.php');

class Lugares
{
    //TODO: Implementar los metodos de la clase Lugares
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("lugares","id_lugar");
        $this->tabla->AgregarCampo("nombre");
        $this->tabla->AgregarCampo("longitud");
        $this->tabla->AgregarCampo("latitud");
    }
    public function todos() 
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }
    public function uno($id_lugar) 
    {
        $datos = $this->tabla->DevolverUno($id_lugar);
        return $datos;
    }
    public function insertar($nombre,$longitud,$latitud ) 
    {
        $valores = array($nombre,$longitud,$latitud );
        return $this->tabla->InsertarRegistro($valores);
    }
    public function actualizar($id_lugar, $nombre,$longitud,$latitud ) 
    {
        $valores = array($nombre,$longitud,$latitud);
        return $this->tabla->ActualizarRegistro($id_lugar, $valores);
    }
    public function eliminar($id_lugar) 
    {
        $this->tabla->EliminarRegistro($id_lugar);
    }
}