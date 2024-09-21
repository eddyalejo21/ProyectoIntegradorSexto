<?php
//TODO: Clase de ReservasActividades
require_once('../config/comun.php');

class ReservasActividades
{
    //TODO: Implementar los metodos de la clase ReservasActividades
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("reservasactividades","id_reservaactividad");
        $this->tabla->AgregarCampo("id_reserva");
        $this->tabla->AgregarCampo("id_actividadeslugar");
        $this->tabla->AgregarCampo("fecha");
        $this->tabla->AgregarCampo("hora");
        $this->tabla->AgregarCampo("cantidad");
        $this->tabla->AgregarCampo("id_estado");
    }
    public function todos() 
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }
    public function uno($id_reservaactividad) 
    {
        $datos = $this->tabla->DevolverUno($id_reservaactividad);
        return $datos;
    }
    public function insertar($id_reserva,$id_actividadeslugar,$fecha,$hora,$cantidad,$id_estado ) 
    {
        $valores = array($id_reserva,$id_actividadeslugar,$fecha,$hora,$cantidad,$id_estado );
        return $this->tabla->InsertarRegistro($valores);
    }
    public function actualizar($id_reservaactividad, $id_reserva,$id_actividadeslugar,$fecha,$hora,$cantidad,$id_estado ) 
    {
        $valores = array($id_reserva,$id_actividadeslugar,$fecha,$hora,$cantidad,$id_estado);
        return $this->tabla->ActualizarRegistro($id_reservaactividad, $valores);
    }
    public function eliminar($id_reservaactividad) 
    {
        $this->tabla->EliminarRegistro($id_reservaactividad);
    }
}