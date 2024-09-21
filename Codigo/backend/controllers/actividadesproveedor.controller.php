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
require_once('../models/actividadesproveedor.model.php');
//error_reporting(0);
$actividadesproveedor = new ActividadesProveedor;

switch ($_GET["op"]) {
        //TODO: operaciones de actividades

    case 'todos': //TODO: Procedimiento para cargar todos los datos del proveedor
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase proveedores.model.php

        $datos = $actividadesproveedor->todos(); // Llamo al metodo todos de la clase comercios.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $idactividades_proveedor = $_POST["idactividades_proveedor"];
        $datos = array();
        $datos = $actividadesproveedor->uno($idactividades_proveedor);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar':  //TODO: Procedimiento para insertar un proveedor en la base de datos
        $tarifa_adultos = $_POST["tarifa_adultos"];
        $tarifa_ninos = $_POST["tarifa_ninos"];
        $tarifa_extranjero = $_POST["tarifa_extranjero"];
        $id_proveedor = $_POST["id_proveedor"];
        $id_actividad = $_POST["id_actividad"];
        $datos = array();
        $datos = $actividadesproveedor->insertar($tarifa_adultos, $tarifa_ninos, $tarifa_extranjero, $id_proveedor, $id_actividad);
        echo json_encode($datos);
        break;

    case 'actualizar':  //TODO: Procedimiento para actualizar un Comercios en la base de datos
        $idactividades_proveedor = $_POST["idactividades_proveedor"];
        $tarifa_adultos = $_POST["tarifa_adultos"];
        $tarifa_ninos = $_POST["tarifa_ninos"];
        $tarifa_extranjero = $_POST["tarifa_extranjero"];
        $id_proveedor = $_POST["id_proveedor"];
        $id_actividad = $_POST["id_actividad"];
        $datos = array();
        $datos = $actividadesproveedor->actualizar($idactividades_proveedor, $tarifa_adultos, $tarifa_ninos, $tarifa_extranjero, $id_proveedor, $id_actividad);
        echo json_encode($datos);
        break;

    case 'eliminar': //TODO: Procedimiento para eliminar un comercios en la base de datos
        $idactividades_proveedor = $_POST["idactividades_proveedor"];
        $datos = array();
        $datos = $actividadesproveedor->eliminar($idactividades_proveedor);
        echo json_encode($datos);
        break;

    case 'todosJoin':
        $datos = array();
        $datos = $actividadesproveedor->todosJoin();
        echo json_encode($datos);
        break;
}
