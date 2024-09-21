<?php
//TODO: Clase de DatosReserva
require_once('../config/comun.php');

class DatosReserva
{
    //TODO: Implementar los metodos de la clase DatosReserva
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("datosreserva","id_datoreserva");
        $this->tabla->AgregarCampo("id_reserva");
        $this->tabla->AgregarCampo("id_tipodato");
        $this->tabla->AgregarCampo("valor");
    }
    public function todos() 
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }
    public function uno($id_datoreserva) 
    {
        $datos = $this->tabla->DevolverUno($id_datoreserva);
        return $datos;
    }
    public function insertar($id_reserva,$id_tipodato,$valor ) 
    {
        $valores = array($nombrecampo, );
        return $this->tabla->InsertarRegistro($valores);
    }
    public function actualizar($id_datoreserva, $nombrecampo, ) 
    {
        $valores = array($nombrecampo,);
        return $this->tabla->ActualizarRegistro($id_datoreserva, $valores);
    }
    public function eliminar($id_datoreserva) 
    {
        $this->tabla->EliminarRegistro($id_datoreserva);
    }
}