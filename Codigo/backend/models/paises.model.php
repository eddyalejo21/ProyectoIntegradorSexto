<?php
//TODO: Clase de Paises
require_once('../config/comun.php');

class Paises
{
    //TODO: Implementar los metodos de la clase paises
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("paises","id_pais");
        $this->tabla->AgregarCampo("nombre");
        $this->tabla->AgregarCampo("codigo");
    }
    public function todos() 
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }
    
}