<?php
//TODO: Clase de Comercios
require_once('../config/comun.php');

class ActividadesProveedor
{
    //TODO: Implementar los metodos de la clase Proveedores
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("actividades_proveedor", "idactividades_proveedor");
        $this->tabla->AgregarCampo("tarifa_adultos");
        $this->tabla->AgregarCampo("tarifa_ninos");
        $this->tabla->AgregarCampo("tarifa_extranjero");
        $this->tabla->AgregarCampo("id_proveedor");
        $this->tabla->AgregarCampo("id_actividad");
    }
    public function todos()
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }
    public function uno($idactividades_proveedor)
    {
        $datos = $this->tabla->DevolverUno($idactividades_proveedor);
        return $datos;
    }
    public function insertar($tarifa_adultos, $tarifa_ninos, $tarifa_extranjero, $id_proveedor, $id_actividad)
    {
        $valores = array($tarifa_adultos, $tarifa_ninos, $tarifa_extranjero, $id_proveedor, $id_actividad);
        return $this->tabla->InsertarRegistro($valores);
    }
    public function actualizar($idactividades_proveedor, $tarifa_adultos, $tarifa_ninos, $tarifa_extranjero, $id_proveedor, $id_actividad)
    {
        $valores = array($tarifa_adultos, $tarifa_ninos, $tarifa_extranjero, $id_proveedor, $id_actividad);
        return $this->tabla->ActualizarRegistro($idactividades_proveedor, $valores);
    }
    public function eliminar($idactividades_proveedor)
    {
        return $this->tabla->EliminarRegistro($idactividades_proveedor);
    }

    public function todosJoin()
    {
        $con = new ClaseBaseDatos();
        $con = $con->Conectar();
        $cadena = "SELECT ap.idactividades_proveedor, a.id_actividad, a.nombre, p.id_proveedor, p.nombre_empresa, ap.tarifa_adultos, ap.tarifa_ninos, ap.tarifa_extranjero
                    FROM actividades_proveedor ap
                    JOIN actividades a ON ap.id_actividad = a.id_actividad
                    JOIN proveedores p ON ap.id_proveedor = p.id_proveedor";

        $result = mysqli_query($con, $cadena);

        if (!$result) {
            return ["error" => mysqli_error($con)];
        }

        $datos = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $datos;
    }
}
