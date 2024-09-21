<?php
//TODO: Clase de Comercios
require_once('../config/comun.php');

class Comercios
{
    //TODO: Implementar los metodos de la clase Comercios
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("comercios","id_comercio");
        $this->tabla->AgregarCampo("nombre");
        $this->tabla->AgregarCampo("direccion");
        $this->tabla->AgregarCampo("id_estado");
        $this->tabla->AgregarCampo("longitud");
        $this->tabla->AgregarCampo("latitud");
    }
    public function todos() 
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }
    public function uno($id_comercio) 
    {
        $datos = $this->tabla->DevolverUno($id_comercio);
        return $datos;
    }
    public function insertar($nombre,$direccion,$id_estado,$longitud,$latitud ) 
    {
        $valores = array($nombre,$direccion,$id_estado,$longitud,$latitud );
        return $this->tabla->InsertarRegistro($valores);
    }
    public function actualizar($id_comercio, $nombre,$direccion,$id_estado,$longitud,$latitud ) 
    {
        $valores = array($nombre,$direccion,$id_estado,$longitud,$latitud);
        return $this->tabla->ActualizarRegistro($id_comercio, $valores);
    }
    public function eliminar($id_comercio) 
    {
        $this->tabla->EliminarRegistro($id_comercio);
    }
}