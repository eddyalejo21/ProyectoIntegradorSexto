<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de DETALLESACTIVIDAD
require_once('../models/detallesactividad.model.php');
//error_reporting(0);
$detallesactividad = new DetallesActividad;

switch ($_GET["op"]) {
        //TODO: operaciones de detallesactividad

    case 'todos': //TODO: Procedimiento para cargar todos los datos del detallesactividad
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase detallesactividad.model.php
        
        $datos = $detallesactividad->todos(); // Llamo al metodo todos de la clase detallesactividad.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $id_detalleactividad = $_POST["id_detalleactividad"];
        $datos = array();
        $datos = $detallesactividad->uno($id_detalleactividad);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        
    case 'insertar':  //TODO: Procedimiento para insertar un detallesactividad en la base de datos
        $id_actividad = $_POST["id_actividad"];
        $detalle = $_POST["detalle"];
        $datos = array();
        $datos = $detallesactividad->insertar($id_actividad,$detalle);
        //echo json_encode($datos);
        break;
        
    case 'actualizar':  //TODO: Procedimiento para actualizar un DetallesActividad en la base de datos
        $id_detalleactividad = $_POST["id_detalleactividad"];
        $id_actividad = $_POST["id_actividad"];
        $detalle = $_POST["detalle"];
        $datos = array();
        $datos = $detallesactividad->actualizar($id_detalleactividad, $id_actividad,$detalle);
        echo json_encode($datos);
        break;
        
    case 'eliminar': //TODO: Procedimiento para eliminar un detallesactividad en la base de datos
        $id_detalleactividad = $_POST["id_detalleactividad"];
        $datos = array();
        $datos = $detallesactividad->eliminar($id_detalleactividad);
        echo json_encode($datos);
        break;
}