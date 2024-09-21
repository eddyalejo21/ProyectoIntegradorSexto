<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de ACTIVIDADESLUGAR
require_once('../models/actividadeslugar.model.php');
//error_reporting(0);
$actividadeslugar = new ActividadesLugar;

switch ($_GET["op"]) {
        //TODO: operaciones de actividadeslugar

    case 'todos': //TODO: Procedimiento para cargar todos los datos del actividadeslugar
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase actividadeslugar.model.php
        
        $datos = $actividadeslugar->todos(); // Llamo al metodo todos de la clase actividadeslugar.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $id_actividadlugar = $_POST["id_actividadlugar"];
        $datos = array();
        $datos = $actividadeslugar->uno($id_actividadlugar);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        
    case 'insertar':  //TODO: Procedimiento para insertar un actividadeslugar en la base de datos
        $id_actividadcomerciolugar = $_POST["id_actividadcomerciolugar"];
        $id_actividadcomercio = $_POST["id_actividadcomercio"];
        $id_lugar = $_POST["id_lugar"];
        $datos = array();
        $datos = $actividadeslugar->insertar($id_actividadcomerciolugar,$id_actividadcomercio,$id_lugar);
        //echo json_encode($datos);
        break;
        
    case 'actualizar':  //TODO: Procedimiento para actualizar un ActividadesLugar en la base de datos
        $id_actividadlugar = $_POST["id_actividadlugar"];
        $id_actividadcomerciolugar = $_POST["id_actividadcomerciolugar"];
        $id_actividadcomercio = $_POST["id_actividadcomercio"];
        $id_lugar = $_POST["id_lugar"];
        $datos = array();
        $datos = $actividadeslugar->actualizar($id_actividadlugar, $id_actividadcomerciolugar,$id_actividadcomercio,$id_lugar);
        echo json_encode($datos);
        break;
        
    case 'eliminar': //TODO: Procedimiento para eliminar un actividadeslugar en la base de datos
        $id_actividadlugar = $_POST["id_actividadlugar"];
        $datos = array();
        $datos = $actividadeslugar->eliminar($id_actividadlugar);
        echo json_encode($datos);
        break;
}