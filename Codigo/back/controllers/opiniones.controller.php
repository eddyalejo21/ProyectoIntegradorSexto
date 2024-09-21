<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de OPINIONES
require_once('../models/opiniones.model.php');
//error_reporting(0);
$opiniones = new Opiniones;

switch ($_GET["op"]) {
        //TODO: operaciones de opiniones

    case 'todos': //TODO: Procedimiento para cargar todos los datos del opiniones
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase opiniones.model.php
        
        $datos = $opiniones->todos(); // Llamo al metodo todos de la clase opiniones.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $id_opinion = $_POST["id_opinion"];
        $datos = array();
        $datos = $opiniones->uno($id_opinion);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        
    case 'insertar':  //TODO: Procedimiento para insertar un opiniones en la base de datos
        $id_reservaactividad = $_POST["id_reservaactividad"];
        $detalle = $_POST["detalle"];
        $valor = $_POST["valor"];
        $datos = array();
        $datos = $opiniones->insertar($id_reservaactividad,$detalle,$valor);
        //echo json_encode($datos);
        break;
        
    case 'actualizar':  //TODO: Procedimiento para actualizar un Opiniones en la base de datos
        $id_opinion = $_POST["id_opinion"];
        $id_reservaactividad = $_POST["id_reservaactividad"];
        $detalle = $_POST["detalle"];
        $valor = $_POST["valor"];
        $datos = array();
        $datos = $opiniones->actualizar($id_opinion, $id_reservaactividad,$detalle,$valor);
        echo json_encode($datos);
        break;
        
    case 'eliminar': //TODO: Procedimiento para eliminar un opiniones en la base de datos
        $id_opinion = $_POST["id_opinion"];
        $datos = array();
        $datos = $opiniones->eliminar($id_opinion);
        echo json_encode($datos);
        break;
}