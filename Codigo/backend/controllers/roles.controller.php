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
require_once('../models/roles.model.php');
//error_reporting(0);
$roles = new Roles;

switch ($_GET["op"]) {
        //TODO: operaciones

    case 'todos': //TODO: Procedimiento para cargar todos los datos del proveedor
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase proveedores.model.php

        $datos = $roles->todos(); // Llamo al metodo todos de la clase comercios.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $id_rol = $_POST["id_rol"];
        $datos = array();
        $datos = $roles->uno($id_rol);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar':  //TODO: Procedimiento para insertar un proveedor en la base de datos
        $nombre = $_POST["nombre"];
        $datos = array();
        $datos = $roles->insertar($nombre);
        echo json_encode($datos);
        break;

    case 'actualizar':  //TODO: Procedimiento para actualizar un empleado en la base de datos
        $id_rol = $_POST["id_rol"];
        $nombre = $_POST["nombre"];
        $datos = array();
        $datos = $roles->actualizar($id_rol, $nombre);
        echo json_encode($datos);
        break;

    case 'eliminar': //TODO: Procedimiento para eliminar un empleado en la base de datos
        $id_rol = $_POST["id_rol"];
        $datos = array();
        $datos = $roles->eliminar($id_rol);
        echo json_encode($datos);
        break;


}
