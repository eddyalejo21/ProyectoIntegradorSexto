<?php
//TODO: Clase de Comercios
require_once('../config/comun.php');

class Proveedores
{
    //TODO: Implementar los metodos de la clase Proveedores
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("proveedores","id_proveedor");
        $this->tabla->AgregarCampo("nombre_empresa");
        $this->tabla->AgregarCampo("nombre_representante");
        $this->tabla->AgregarCampo("direccion");
        $this->tabla->AgregarCampo("telefono_principal");
        $this->tabla->AgregarCampo("telefono_secundario");
        $this->tabla->AgregarCampo("correo");
    }
    public function todos() 
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }
    public function uno($id_proveedor) 
    {
        $datos = $this->tabla->DevolverUno($id_proveedor);
        return $datos;
    }
    public function insertar($nombre_empresa, $nombre_representante, $direccion, $telefono_principal, $telefono_secundario, $correo) 
    {
        $valores = array($nombre_empresa, $nombre_representante, $direccion, $telefono_principal, $telefono_secundario, $correo);
        return $this->tabla->InsertarRegistro($valores);
    }
    public function actualizar($id_proveedor, $nombre_empresa, $nombre_representante, $direccion, $telefono_principal, $telefono_secundario, $correo) 
    {
        $valores = array($nombre_empresa, $nombre_representante, $direccion, $telefono_principal, $telefono_secundario, $correo);
        return $this->tabla->ActualizarRegistro($id_proveedor, $valores);
    }
    public function eliminar($id_proveedor) 
    {
       return $this->tabla->EliminarRegistro($id_proveedor);
        
    }
}