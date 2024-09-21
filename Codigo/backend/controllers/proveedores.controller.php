<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de COMERCIOS
require_once('../models/proveedores.model.php');
//error_reporting(0);
$proveedores = new Proveedores;

switch ($_GET["op"]) {
        //TODO: operaciones de comercios

    case 'todos': //TODO: Procedimiento para cargar todos los datos del proveedor
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase proveedores.model.php
        
        $datos = $proveedores->todos(); // Llamo al metodo todos de la clase comercios.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $id_proveedor = $_POST["id_proveedor"];
        $datos = array();
        $datos = $proveedores->uno($id_proveedor);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        
    case 'insertar':  //TODO: Procedimiento para insertar un proveedor en la base de datos
        $nombre_empresa = $_POST["nombre_empresa"];
        $nombre_representante = $_POST["nombre_representante"];
        $direccion = $_POST["direccion"];
        $telefono_principal = $_POST["telefono_principal"];
        $telefono_secundario = $_POST["telefono_secundario"];
        $correo = $_POST["correo"];
        $datos = array();
        $datos = $proveedores->insertar($nombre_empresa, $nombre_representante, $direccion, $telefono_principal, $telefono_secundario, $correo);
        echo json_encode($datos);
        break;
        
    case 'actualizar':  //TODO: Procedimiento para actualizar un Comercios en la base de datos
        $id_proveedor = $_POST["id_proveedor"];
        $nombre_empresa = $_POST["nombre_empresa"];
        $nombre_representante = $_POST["nombre_representante"];
        $direccion = $_POST["direccion"];
        $telefono_principal = $_POST["telefono_principal"];
        $telefono_secundario = $_POST["telefono_secundario"];
        $correo = $_POST["correo"];
        $datos = array();
        $datos = $proveedores->actualizar($id_proveedor, $nombre_empresa, $nombre_representante, $direccion, $telefono_principal, $telefono_secundario, $correo);
        echo json_encode($datos);
        break;
        
    case 'eliminar': //TODO: Procedimiento para eliminar un comercios en la base de datos
        $id_proveedor = $_POST["id_proveedor"];
        $datos = array();
        $datos = $proveedores->eliminar($id_proveedor);
        echo json_encode($datos);
        break;
}