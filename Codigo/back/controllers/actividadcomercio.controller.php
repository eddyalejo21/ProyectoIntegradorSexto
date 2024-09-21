<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}

//TODO: controlador de ACTIVIDADCOMERCIO
require_once('../models/actividadcomercio.model.php');
//error_reporting(0);
$actividadcomercio = new ActividadComercio;

switch ($_GET["op"]) {
        //TODO: operaciones de actividadcomercio

    case 'todos': //TODO: Procedimiento para cargar todos los datos del actividadcomercio
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase actividadcomercio.model.php

        $datos = $actividadcomercio->todos(); // Llamo al metodo todos de la clase actividadcomercio.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $id_actividadcomercio = $_POST["id_actividadcomercio"];
        $datos = array();
        $datos = $actividadcomercio->uno($id_actividadcomercio);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar':  //TODO: Procedimiento para insertar un actividadcomercio en la base de datos
        $id_actividad = $_POST["id_actividad"];
        $id_comercio = $_POST["id_comercio"];
        $costo = $_POST["costo"];
        $datos = array();
        $datos = $actividadcomercio->insertar($id_actividad, $id_comercio, $costo);
        echo json_encode($datos);
        break;

    case 'actualizar':  //TODO: Procedimiento para actualizar un ActividadComercio en la base de datos
        $id_actividadcomercio = $_POST["id_actividadcomercio"];
        $id_actividad = $_POST["id_actividad"];
        $id_comercio = $_POST["id_comercio"];
        $costo = $_POST["costo"];
        $datos = array();
        $datos = $actividadcomercio->actualizar($id_actividadcomercio, $id_actividad, $id_comercio, $costo);
        echo json_encode($datos);
        break;

    case 'eliminar': //TODO: Procedimiento para eliminar un actividadcomercio en la base de datos
        $id_actividadcomercio = $_POST["id_actividadcomercio"];
        $datos = array();
        $datos = $actividadcomercio->eliminar($id_actividadcomercio);
        echo json_encode($datos);
        break;

    case 'todosJoin': //TODO: Procedimiento para cargar todos los datos del actividadcomercio
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase actividadcomercio.model.php

        $datos = $actividadcomercio->todosJoin(); // Llamo al metodo todos de la clase actividadcomercio.model.php
       
        echo json_encode($datos);
        break;
}
