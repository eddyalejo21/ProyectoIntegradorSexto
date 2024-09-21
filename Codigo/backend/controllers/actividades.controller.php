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
require_once('../models/actividades.model.php');
//error_reporting(0);
$actividades = new Actividades;

switch ($_GET["op"]) {
        //TODO: operaciones de actividades

    case 'todos': //TODO: Procedimiento para cargar todos los datos del proveedor
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase proveedores.model.php

        $datos = $actividades->todos(); // Llamo al metodo todos de la clase comercios.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $id_actividad = $_POST["id_actividad"];
        $datos = array();
        $datos = $actividades->uno($id_actividad);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar':  //TODO: Procedimiento para insertar un proveedor en la base de datos
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $id_tipoactividad = $_POST["id_tipoactividad"];
        $datos = array();
        $datos = $actividades->insertar($nombre, $descripcion, $id_tipoactividad);
        echo json_encode($datos);
        break;

    case 'actualizar':  //TODO: Procedimiento para actualizar un Comercios en la base de datos
        $id_actividad = $_POST["id_actividad"];
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $id_tipoactividad = $_POST["id_tipoactividad"];
        $datos = array();
        $datos = $actividades->actualizar($id_actividad, $nombre, $descripcion, $id_tipoactividad);
        echo json_encode($datos);
        break;

    case 'eliminar': //TODO: Procedimiento para eliminar un comercios en la base de datos
        $id_actividad = $_POST["id_actividad"];
        $datos = array();
        $datos = $actividades->eliminar($id_actividad);
        echo json_encode($datos);
        break;

    case 'todosJoin':
        $datos = array();
        $datos = $actividades->todosJoin();
        echo json_encode($datos);
        break;

    case 'unoJoin':
        $id_actividad = intval($_POST["id_actividad"]);
        $datos = array();
        $datos = $actividades->unoJoin($id_actividad);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
}
