<?php
//TODO: Clase de Comercios
require_once('../config/comun.php');

class PorcentajeGanancia
{
    //TODO: Implementar los metodos de la clase Porcentaje de Ganancia
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("porcentaje_ganancia","id_porcentajeganancia");
        $this->tabla->AgregarCampo("descripcion");
        $this->tabla->AgregarCampo("valor");
        $this->tabla->AgregarCampo("estado");
    }
    public function todos() 
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }
    public function uno($id_porcentajeganancia) 
    {
        $datos = $this->tabla->DevolverUno($id_porcentajeganancia);
        return $datos;
    }
    public function insertar($descripcion, $valor, $estado) 
    {
        $valores = array($descripcion, $valor, $estado);
        return $this->tabla->InsertarRegistro($valores);
    }
    public function actualizar($id_porcentajeganancia, $descripcion, $valor, $estado) 
    {
        $valores = array($descripcion, $valor, $estado);
        return $this->tabla->ActualizarRegistro($id_porcentajeganancia, $valores);
    }
    public function eliminar($id_porcentajeganancia) 
    {
       return $this->tabla->EliminarRegistro($id_porcentajeganancia);
        
    }
}