<?php
//TODO: Clase de Comercios
require_once('../config/comun.php');

class ContactosCliente
{
    //TODO: Implementar los metodos de la clase Proveedores
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("contactos_cliente","id_contactoscliente");
        $this->tabla->AgregarCampo("id_mediocontacto");
        $this->tabla->AgregarCampo("id_cliente");
    }

    public function todos() 
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }

    public function uno($id_contactoscliente) 
    {
        $datos = $this->tabla->DevolverUno($id_contactoscliente);
        return $datos;
    }

    public function insertar($id_mediocontacto, $id_cliente) 
    {
        $valores = array($id_mediocontacto, $id_cliente);
        return $this->tabla->InsertarRegistro($valores);
    }

    public function actualizar($id_contactoscliente, $id_mediocontacto, $id_cliente) 
    {
        $valores = array($id_mediocontacto, $id_cliente);
        return $this->tabla->ActualizarRegistro($id_contactoscliente, $valores);
    }

    public function eliminar($id_contactoscliente) 
    {
       return $this->tabla->EliminarRegistro($id_contactoscliente);   
    }

    /*public function todosJoin()
    {
        $con = new ClaseBaseDatos();
        $con = $con->Conectar();
        $cadena = "
           SELECT 
                a.id_contactoscliente,
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

    public function unoJoin($id_contactoscliente)
    {
        $con = new ClaseBaseDatos();
        $con = $con->Conectar();
        $cadena = "SELECT a.id_contactoscliente, t.id_tipoactividad, t.nombre as nombreTipo, a.nombre, a.descripcion FROM actividades a INNER JOIN tipo_actividad t ON a.id_tipoactividad = t.id_tipoactividad WHERE `id_contactoscliente` = $id_contactoscliente";

        $datos = mysqli_query($con, $cadena);

        // if (!$result) {
        //     return ["error" => mysqli_error($con)];
        // }

        // $datos = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $con->close();
        return $datos;
    }*/
}