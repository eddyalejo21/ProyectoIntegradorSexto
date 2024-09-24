<?php
//TODO: Clase de Paises
require_once('../config/comun.php');

class EstadosReserva
{
    //TODO: Implementar los metodos de la clase paises
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("estados_reserva","id_estadosreserva");
        $this->tabla->AgregarCampo("descripcion");
    }
    public function todos() 
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }
    
}