<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de RESERVASACTIVIDADES
require_once('../models/reservasactividades.model.php');
//error_reporting(0);
$reservasactividades = new ReservasActividades;

switch ($_GET["op"]) {
        //TODO: operaciones de reservasactividades

    case 'todos': //TODO: Procedimiento para cargar todos los datos del reservasactividades
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase reservasactividades.model.php
        
        $datos = $reservasactividades->todos(); // Llamo al metodo todos de la clase reservasactividades.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $id_reservaactividad = $_POST["id_reservaactividad"];
        $datos = array();
        $datos = $reservasactividades->uno($id_reservaactividad);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        
    case 'insertar':  //TODO: Procedimiento para insertar un reservasactividades en la base de datos
        $id_reserva = $_POST["id_reserva"];
        $id_actividadeslugar = $_POST["id_actividadeslugar"];
        $fecha = $_POST["fecha"];
        $hora = $_POST["hora"];
        $cantidad = $_POST["cantidad"];
        $id_estado = $_POST["id_estado"];
        $datos = array();
        $datos = $reservasactividades->insertar($id_reserva,$id_actividadeslugar,$fecha,$hora,$cantidad,$id_estado);
        //echo json_encode($datos);
        break;
        
    case 'actualizar':  //TODO: Procedimiento para actualizar un ReservasActividades en la base de datos
        $id_reservaactividad = $_POST["id_reservaactividad"];
        $id_reserva = $_POST["id_reserva"];
        $id_actividadeslugar = $_POST["id_actividadeslugar"];
        $fecha = $_POST["fecha"];
        $hora = $_POST["hora"];
        $cantidad = $_POST["cantidad"];
        $id_estado = $_POST["id_estado"];
        $datos = array();
        $datos = $reservasactividades->actualizar($id_reservaactividad, $id_reserva,$id_actividadeslugar,$fecha,$hora,$cantidad,$id_estado);
        echo json_encode($datos);
        break;
        
    case 'eliminar': //TODO: Procedimiento para eliminar un reservasactividades en la base de datos
        $id_reservaactividad = $_POST["id_reservaactividad"];
        $datos = array();
        $datos = $reservasactividades->eliminar($id_reservaactividad);
        echo json_encode($datos);
        break;
}