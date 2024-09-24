<?php
//TODO: Clase de Comercios
require_once('../config/comun.php');

class Empleados
{
    //TODO: Implementar los metodos de la clase empleados
    public $tabla;

    public function __construct()
    {
        $this->tabla = new ClaseTabla("empleados", "id_empleado");
        $this->tabla->AgregarCampo("cedula");
        $this->tabla->AgregarCampo("nombre");
        $this->tabla->AgregarCampo("correo");
        $this->tabla->AgregarCampo("clave");
        $this->tabla->AgregarCampo("id_rol");
    }
    public function todos()
    {
        $datos = $this->tabla->DevolverTodos();
        return $datos;
    }
    public function uno($id_empleado)
    {
        $datos = $this->tabla->DevolverUno($id_empleado);
        return $datos;
    }
    public function insertar($cedula, $nombre, $correo, $clave, $id_rol)
    {
        $valores = array($cedula, $nombre, $correo, $clave, $id_rol);
        return $this->tabla->InsertarRegistro($valores);
    }
    public function actualizar($id_empleado, $cedula, $nombre, $correo, $clave, $id_rol)
    {
        $valores = array($cedula, $nombre, $correo, $clave, $id_rol);
        return $this->tabla->ActualizarRegistro($id_empleado, $valores);
    }
    public function eliminar($id_empleado)
    {
        return $this->tabla->EliminarRegistro($id_empleado);
    }
    public function login($cedula, $clave)
    {
        $con = new ClaseBaseDatos();
        $con = $con->Conectar();
        $cadena = "SELECT * FROM empleados WHERE cedula = '$cedula'";
        $datos = mysqli_query($con, $cadena);
        if ($datos && mysqli_num_rows($datos) > 0) {
            $usuario = mysqli_fetch_assoc($datos);
            if (password_verify($clave, $usuario['clave'])) {
                return $usuario;
            } else {
                return false;
            }
        }
    }

}
