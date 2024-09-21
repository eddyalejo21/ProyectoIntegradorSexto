<?php
//TODO: Clase de Comercios
require_once('../config/comun.php');

class TipoCliente
{
    //TODO: Implementar los metodos de la clase Proveedores
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("tipo_cliente","id_tipocliente");
        $this->tabla->AgregarCampo("nombre");
    }
    public function todos() 
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }
    public function uno($id_tipocliente) 
    {
        $datos = $this->tabla->DevolverUno($id_tipocliente);
        return $datos;
    }
    public function insertar($nombre) 
    {
        $valores = array($nombre);
        return $this->tabla->InsertarRegistro($valores);
    }
    public function actualizar($id_tipocliente, $nombre) 
    {
        $valores = array($nombre);
        return $this->tabla->ActualizarRegistro($id_tipocliente, $valores);
    }
    public function eliminar($id_tipocliente) 
    {
       return $this->tabla->EliminarRegistro($id_tipocliente);
        
    }
}