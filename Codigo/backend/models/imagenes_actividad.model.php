<?php
//TODO: Clase de Imagenes_Actividad
require_once('../config/comun.php');

class Imagenes_Actividad
{
    //TODO: Implementar los metodos de la clase Proveedores
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("imagenes_actividad","id_imagenes");
        $this->tabla->AgregarCampo("nombre");
        $this->tabla->AgregarCampo("path");
        $this->tabla->AgregarCampo("id_actividad");
    }

    public function todos() 
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }

    public function uno($id_imagenes_actividad) 
    {
        $datos = $this->tabla->DevolverUno($id_imagenes_actividad);
        return $datos;
    }

    public function insertar($nombre, $path, $id_actividad) 
    {
        $valores = array($nombre, $path, $id_actividad);
        return $this->tabla->InsertarRegistro($valores);
    }

    public function actualizar($id_imagenes_actividad, $nombre, $path, $id_actividad) 
    {
        $valores = array($nombre, $path, $id_actividad);
        return $this->tabla->ActualizarRegistro($id_imagenes_actividad, $valores);
    }

    public function eliminar($id_imagenes_actividad) 
    {
       return $this->tabla->EliminarRegistro($id_imagenes_actividad);   
    }

    //Devuelve las imagenes de una actividad en particular
    public function actividad($id_actividad) 
    {
        $campo = "id_actividad";
        $datos = $this->tabla->DevolverPorCampo($id_actividad, $campo);
        return $datos;
    }

    /*public function todosJoin()
    {
        $con = new ClaseBaseDatos();
        $con = $con->Conectar();
        $cadena = "
           SELECT 
                a.id_imagenes_actividad,
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

    public function unoJoin($id_imagenes_actividad)
    {
        $con = new ClaseBaseDatos();
        $con = $con->Conectar();
        $cadena = "SELECT a.id_imagenes_actividad, t.id_tipoactividad, t.nombre as nombreTipo, a.nombre, a.descripcion FROM actividades a INNER JOIN tipo_actividad t ON a.id_tipoactividad = t.id_tipoactividad WHERE `id_imagenes_actividad` = $id_imagenes_actividad";

        $datos = mysqli_query($con, $cadena);

        // if (!$result) {
        //     return ["error" => mysqli_error($con)];
        // }

        // $datos = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $con->close();
        return $datos;
    }*/
}