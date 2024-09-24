<?php
//TODO: Clase de Paises
require_once('../config/comun.php');

class MetodosPago
{
    //TODO: Implementar los metodos de la clase paises
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("metodos_pago","id_metodospago");
        $this->tabla->AgregarCampo("nombre");
    }
    public function todos() 
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }
    
}