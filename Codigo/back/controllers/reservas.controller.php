<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de RESERVAS
require_once('../models/reservas.model.php');
//error_reporting(0);
$reservas = new Reservas;

switch ($_GET["op"]) {
        //TODO: operaciones de reservas

    case 'todos': //TODO: Procedimiento para cargar todos los datos del reservas
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase reservas.model.php
        
        $datos = $reservas->todos(); // Llamo al metodo todos de la clase reservas.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $id_reserva = $_POST["id_reserva"];
        $datos = array();
        $datos = $reservas->uno($id_reserva);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        
    case 'insertar':  //TODO: Procedimiento para insertar un reservas en la base de datos
        $id_persona = $_POST["id_persona"];
        $fecha_inicio = $_POST["fecha_inicio"];
        $fecha_fin = $_POST["fecha_fin"];
        $id_estado = $_POST["id_estado"];
        $datos = array();
        $datos = $reservas->insertar($id_persona,$fecha_inicio,$fecha_fin,$id_estado);
        //echo json_encode($datos);
        break;
        
    case 'actualizar':  //TODO: Procedimiento para actualizar un Reservas en la base de datos
        $id_reserva = $_POST["id_reserva"];
        $id_persona = $_POST["id_persona"];
        $fecha_inicio = $_POST["fecha_inicio"];
        $fecha_fin = $_POST["fecha_fin"];
        $id_estado = $_POST["id_estado"];
        $datos = array();
        $datos = $reservas->actualizar($id_reserva, $id_persona,$fecha_inicio,$fecha_fin,$id_estado);
        echo json_encode($datos);
        break;
        
    case 'eliminar': //TODO: Procedimiento para eliminar un reservas en la base de datos
        $id_reserva = $_POST["id_reserva"];
        $datos = array();
        $datos = $reservas->eliminar($id_reserva);
        echo json_encode($datos);
        break;