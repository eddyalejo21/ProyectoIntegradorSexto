<?php
//TODO: Clase de Comercios
require_once('../config/comun.php');

class Clientes
{
    //TODO: Implementar los metodos de la clase clientes
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("clientes", "id_cliente");
        $this->tabla->AgregarCampo("identificacion");
        $this->tabla->AgregarCampo("nombre");
        $this->tabla->AgregarCampo("fecha_nacimiento");
        $this->tabla->AgregarCampo("genero");
        $this->tabla->AgregarCampo("correo");
        $this->tabla->AgregarCampo("telefono");
        $this->tabla->AgregarCampo("clave");
        $this->tabla->AgregarCampo("token");
        $this->tabla->AgregarCampo("id_tipocliente");
        $this->tabla->AgregarCampo("estado");
        $this->tabla->AgregarCampo("id_pais");
    }
    public function todos()
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }
    public function uno($id_cliente)
    {
        $datos = $this->tabla->DevolverUno($id_cliente);
        return $datos;
    }
    public function insertar($identificacion, $nombre, $fecha_nacimiento, $genero, $correo, $telefono, $clave, $token, $id_tipocliente, $estado, $id_pais)
    {
        $valores = array($identificacion, $nombre, $fecha_nacimiento, $genero, $correo, $telefono, $clave, $token, $id_tipocliente, $estado, $id_pais);
        return $this->tabla->InsertarRegistro($valores);
    }
    public function actualizar($id_cliente, $identificacion, $nombre, $fecha_nacimiento, $genero, $correo, $telefono, $clave, $token, $id_tipocliente, $estado, $id_pais)
    {
        $valores = array($identificacion, $nombre, $fecha_nacimiento, $genero, $correo, $telefono, $clave, $token, $id_tipocliente, $estado, $id_pais);
        return $this->tabla->ActualizarRegistro($id_cliente, $valores);
    }
    public function eliminar($id_cliente)
    {
        return $this->tabla->EliminarRegistro($id_cliente);
    }

    public function ultimo()
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
}
