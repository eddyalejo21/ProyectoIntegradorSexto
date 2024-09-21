<?php
//TODO: Clase de ActividadesLugar
require_once('../config/comun.php');

class ActividadesLugar
{
    //TODO: Implementar los metodos de la clase ActividadesLugar
    public $actividadeslugar;

    public function __construct()
    {
        $this->actividadeslugar = new ClaseActividadeslugar("actividadeslugar","id_nombreID");
        $this->actividadeslugar->AgregarCampo("id_actividadcomerciolugar");
        $this->actividadeslugar->AgregarCampo("id_actividadcomercio");
        $this->actividadeslugar->AgregarCampo("id_lugar"); 
    }
    public function todos() 
    {
        $datos = $this->actividadeslugar->DevolverTodos();
        return $datos;
    }
    public function uno($id_nombreID) 
    {
        $datos = $this->actividadeslugar->DevolverUno($id_nombreID);
        return $datos;
    }
    public function insertar($id_actividadcomerciolugar,$id_actividadcomercio,$id_lugar ) 
    {
        $valores = array($id_actividadcomerciolugar,$id_actividadcomercio,$id_lugar );
        return $this->actividadeslugar->InsertarRegistro($valores);
    }
    public function actualizar($id_nombreID, id_actividadcomerciolugar,$id_actividadcomercio,$id_lugar ) 
    {
        $valores = array($id_actividadcomerciolugar,$id_actividadcomercio,$id_lugar);
        return $this->actividadeslugar->ActualizarRegistro($id_nombreID, $valores);
    }
    public function eliminar($id_nombreID) 
    {
        $this->actividadeslugar->EliminarRegistro($id_nombreID);
    }
}