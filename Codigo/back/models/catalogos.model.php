<?php
//TODO: Clase de Catalogos
require_once('../config/comun.php');

class Catalogos
{
    //TODO: Implementar los metodos de la clase Catalogos
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("catalogos","id_catalogo");
        $this->tabla->AgregarCampo("detalle");
        $this->tabla->AgregarCampo("id_tipo");
        $this->tabla->AgregarCampo("valor");
    }

    public function todos() 
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }

    public function uno($idcatalogo) 
    {
        $datos = $this->tabla->DevolverUno($idcatalogo);
        return $datos;
    }

    public function insertar($detalle, $id_tipo, $valor) 
    {
        $valores = array($detalle, $id_tipo, $valor);
        return $this->tabla->InsertarRegistro($valores);
    }
    public function actualizar($id_catalogo, $detalle, $id_tipo, $valor) 
    {
        $valores = array($detalle, $id_tipo, $valor);
        return $this->tabla->ActualizarRegistro($id_catalogo, $valores);
    }
    public function eliminar($id_catalogo) 
    {
        $this->tabla->EliminarRegistro($id_catalogo);
    }
}