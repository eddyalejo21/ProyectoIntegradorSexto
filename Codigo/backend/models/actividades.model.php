<?php
//TODO: Clase de Comercios
require_once('../config/comun.php');

class Actividades
{
    //TODO: Implementar los metodos de la clase Proveedores
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("actividades","id_actividad");
        $this->tabla->AgregarCampo("nombre");
        $this->tabla->AgregarCampo("descripcion");
        $this->tabla->AgregarCampo("id_tipoactividad");
    }

    public function todos() 
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }

    public function uno($id_actividad) 
    {
        $datos = $this->tabla->DevolverUno($id_actividad);
        return $datos;
    }

    public function insertar($nombre, $descripcion, $id_tipoactividad) 
    {
        $valores = array($nombre, $descripcion, $id_tipoactividad);
        return $this->tabla->InsertarRegistro($valores);
    }

    public function actualizar($id_actividad, $nombre, $descripcion, $id_tipoactividad) 
    {
        $valores = array($nombre, $descripcion, $id_tipoactividad);
        return $this->tabla->ActualizarRegistro($id_actividad, $valores);
    }

    public function eliminar($id_actividad) 
    {
       return $this->tabla->EliminarRegistro($id_actividad);   
    }

    public function todosJoin()
    {
        $con = new ClaseBaseDatos();
        $con = $con->Conectar();
        $cadena = "
           SELECT 
                a.id_actividad,
                t.id_tipoactividad,
                t.nombre as nombreTipo,
                a.nombre,
                a.descripcion
           FROM
                actividades a
           INNER JOIN 
                tipo_actividad t
           ON
                a.id_tipoactividad = t.id_tipoactividad
        ";

        $result = mysqli_query($con, $cadena);

        if (!$result) {
            return ["error" => mysqli_error($con)];
        }

        $datos = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $datos;
    }

    public function unoJoin($id_actividad)
    {
        $con = new ClaseBaseDatos();
        $con = $con->Conectar();
        $cadena = "SELECT a.id_actividad, t.id_tipoactividad, t.nombre as nombreTipo, a.nombre, a.descripcion FROM actividades a INNER JOIN tipo_actividad t ON a.id_tipoactividad = t.id_tipoactividad WHERE `id_actividad` = $id_actividad";

        $datos = mysqli_query($con, $cadena);

        // if (!$result) {
        //     return ["error" => mysqli_error($con)];
        // }

        // $datos = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $con->close();
        return $datos;
    }
}