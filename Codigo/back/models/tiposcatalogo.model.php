<?php
//TODO: Clase de TiposCatalogo
require_once('../config/comun.php');

class TiposCatalogo
{
    //TODO: Implementar los metodos de la clase TiposCatalogo
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("tiposcatalogo","id_tipocatalogo");
        $this->tabla->AgregarCampo("tipo");
    }

    public function todos() 
    {
    
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }

    public function uno($id_tipocatalogo) 
    {
        
        $datos = $this->tabla->DevolverUno($id_tipocatalogo);
        return $datos;
    }

    public function insertar($tipo) 
    {
        $valores = array($tipo);
        return $this->tabla->InsertarRegistro($valores);
    }
    public function actualizar($id_tipocatalogo, $tipo) 
    {
        $valores = array($tipo);
        return $this->tabla->ActualizarRegistro($id_tipocatalogo, $valores);
    }
    public function eliminar($id_tipocatalogo) 
    {
        $this->tabla->EliminarRegistro($id_tipocatalogo);
    }
}