<?php
//TODO: Clase de Reservas
require_once('../config/comun.php');

class Reservas
{
    //TODO: Implementar los metodos de la clase Reservas
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("reservas","id_reserva");
        $this->tabla->AgregarCampo("id_persona");
        $this->tabla->AgregarCampo("fecha_inicio");
        $this->tabla->AgregarCampo("fecha_fin");
        $this->tabla->AgregarCampo("id_estado");
        $this->tabla->AgregarCampo("nombrecampo");
    }
    public function todos() 
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }
    public function uno($id_reserva) 
    {
        $datos = $this->tabla->DevolverUno($id_reserva);
        return $datos;
    }
    public function insertar($id_persona,$fecha_inicio,$fecha_fin,$id_estado ) 
    {
        $valores = array($id_persona,$fecha_inicio,$fecha_fin,$id_estado );
        return $this->tabla->InsertarRegistro($valores);
    }
    public function actualizar($id_reserva, $id_persona,$fecha_inicio,$fecha_fin,$id_estado ) 
    {
        $valores = array($id_persona,$fecha_inicio,$fecha_fin,$id_estado);
        return $this->tabla->ActualizarRegistro($id_reserva, $valores);
    }
    public function eliminar($id_reserva) 
    {
        $this->tabla->EliminarRegistro($id_reserva);
    }
}