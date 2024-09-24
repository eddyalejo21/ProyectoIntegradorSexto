<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de Actividades
require_once('../models/empleados.model.php');
//error_reporting(0);
$empleados = new Empleados;

switch ($_GET["op"]) {
        //TODO: operaciones

    case 'todos': //TODO: Procedimiento para cargar todos los datos del proveedor
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase proveedores.model.php

        $datos = $empleados->todos(); // Llamo al metodo todos de la clase comercios.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $id_empleado = $_POST["id_empleado"];
        $datos = array();
        $datos = $empleados->uno($id_empleado);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar':  //TODO: Procedimiento para insertar un proveedor en la base de datos
        $cedula = $_POST["cedula"];
        $nombre = $_POST["nombre"];
        $correo = $_POST["correo"];
        $clave = $_POST["clave"];
        $id_rol = $_POST["id_rol"];
        $datos = array();
        $datos = $empleados->insertar($cedula, $nombre, $correo, $clave, $id_rol);
        echo json_encode($datos);
        break;

    case 'actualizar':  //TODO: Procedimiento para actualizar un empleado en la base de datos
        $id_empleado = $_POST["id_empleado"];
        $cedula = $_POST["cedula"];
        $nombre = $_POST["nombre"];
        $correo = $_POST["correo"];
        $clave = $_POST["clave"];
        $id_rol = $_POST["id_rol"];
        $datos = array();
        $datos = $empleados->actualizar($id_empleado, $cedula, $nombre, $correo, $clave, $id_rol);
        echo json_encode($datos);
        break;

    case 'eliminar': //TODO: Procedimiento para eliminar un empleado en la base de datos
        $id_empleado = $_POST["id_empleado"];
        $datos = array();
        $datos = $empleados->eliminar($id_empleado);
        echo json_encode($datos);
        break;

    case 'login':
        if (!isset($_POST["cedula"]) || !isset($_POST["clave"])) {
            echo json_encode(["error" => "Missing required parameters."]);
            exit();
        }
        $cedula = $_POST["cedula"];
        $clave = $_POST["clave"];
        $result = $empleados->login($cedula, $clave);
        if ($result) {
            echo json_encode($result);
        } else {
            echo json_encode(["success" => false, "error" => "Invalid credentials."]);
        }
        break;
}
