<?php
//TODO: Clase de Opiniones
require_once('../config/comun.php');

class Opiniones
{
    //TODO: Implementar los metodos de la clase Opiniones
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("opiniones","id_opinion");
        $this->tabla->AgregarCampo("id_reservaactividad");
        $this->tabla->AgregarCampo("detalle");
        $this->tabla->AgregarCampo("id_reservaactividad");
    }
    public function todos() 
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }
    public function uno($id_opinion) 
    {
        $datos = $this->tabla->DevolverUno($id_opinion);
        return $datos;
    }
    public function insertar($id_reservaactividad,$detalle,$valor ) 
    {
        $valores = array($id_reservaactividad,$detalle,$valor );
        return $this->tabla->InsertarRegistro($valores);
    }
    public function actualizar($id_opinion, $id_reservaactividad,$detalle,$valor ) 
    {
        $valores = array($id_reservaactividad,$detalle,$valor);
        return $this->tabla->ActualizarRegistro($id_opinion, $valores);
    }
    public function eliminar($id_opinion) 
    {
        $this->tabla->EliminarRegistro($id_opinion);
    }
}