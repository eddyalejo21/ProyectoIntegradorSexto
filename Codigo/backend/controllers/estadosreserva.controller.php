<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}
//TODO: controlador
require_once('../models/estadosreserva.model.php');
//error_reporting(0);
$estadosreserva = new EstadosReserva;

switch ($_GET["op"]) {

    case 'todos':
        $datos = array();
        
        $datos = $estadosreserva->todos();
        while ($row = mysqli_fetch_assoc($datos))
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
       

}