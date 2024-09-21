<?php
//TODO: Clase de ActividadComercio
require_once('../config/comun.php');

class ActividadComercio
{
    //TODO: Implementar los metodos de la clase ActividadComercio
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("actividadcomercio", "id_actividadcomercio");
        $this->tabla->AgregarCampo("id_actividad");
        $this->tabla->AgregarCampo("id_comercio");
        $this->tabla->AgregarCampo("costo");
    }
    public function todos()
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }
    public function uno($id_actividadcomercio)
    {
        $datos = $this->tabla->DevolverUno($id_actividadcomercio);
        return $datos;
    }
    public function insertar($id_actividad, $id_comercio, $costo)
    {
        $valores = array($id_actividad, $id_comercio, $costo);
        return $this->tabla->InsertarRegistro($valores);
    }
    public function actualizar($id_actividadcomercio, $id_actividad, $id_comercio, $costo)
    {
        $valores = array($id_actividad, $id_comercio, $costo);
        return $this->tabla->ActualizarRegistro($id_actividadcomercio, $valores);
    }
    public function eliminar($id_actividadcomercio)
    {
        $this->tabla->EliminarRegistro($id_actividadcomercio);
    }

    public function todosJoin()
    {
        $con = new ClaseBaseDatos();
        $con = $con->Conectar();
        $cadena = "
           SELECT 
                ac.id_actividadcomercio,
                a.nombre as nombre_actividad,
                c.nombre as nombre_comercio,
                ac.costo
           FROM
                actividadcomercio ac
           JOIN
                actividades a ON ac.id_actividad = a.id_actividad
           JOIN
                comercios c ON ac.id_comercio = c.id_comercio
        ";

        $result = mysqli_query($con, $cadena);

        if (!$result) {
            return ["error" => mysqli_error($con)];
        }

        $datos = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $datos;
    }
}
