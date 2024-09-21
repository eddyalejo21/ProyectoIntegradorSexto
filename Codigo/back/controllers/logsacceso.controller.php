<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de LOGSACCESO
require_once('../models/logsacceso.model.php');
//error_reporting(0);
$logsacceso = new LogsAcceso;

switch ($_GET["op"]) {
        //TODO: operaciones de logsacceso

    case 'todos': //TODO: Procedimiento para cargar todos los datos del logsacceso
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase logsacceso.model.php
        
        $datos = $logsacceso->todos(); // Llamo al metodo todos de la clase logsacceso.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $id_logacceso = $_POST["id_logacceso"];
        $datos = array();
        $datos = $logsacceso->uno($id_logacceso);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        
    case 'insertar':  //TODO: Procedimiento para insertar un logsacceso en la base de datos
        $id_usuario = $_POST["id_usuario"];
        $fecha_acceso = $_POST["fecha_acceso"];
        $hora_accceso = $_POST["hora_accceso"];
        $datos = array();
        $datos = $logsacceso->insertar($id_usuario,$fecha_acceso,$hora_accceso);
        //echo json_encode($datos);
        break;
        
    case 'actualizar':  //TODO: Procedimiento para actualizar un LogsAcceso en la base de datos
        $id_logacceso = $_POST["id_logacceso"];
        $id_usuario = $_POST["id_usuario"];
        $fecha_acceso = $_POST["fecha_acceso"];
        $hora_accceso = $_POST["hora_accceso"];
        $datos = array();
        $datos = $logsacceso->actualizar($id_logacceso, $id_usuario,$fecha_acceso,$hora_accceso);
        echo json_encode($datos);
        break;
        
    case 'eliminar': //TODO: Procedimiento para eliminar un logsacceso en la base de datos
        $id_logacceso = $_POST["id_logacceso"];
        $datos = array();
        $datos = $logsacceso->eliminar($id_logacceso);
        echo json_encode($datos);
        break;
}