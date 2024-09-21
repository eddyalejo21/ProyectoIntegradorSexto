<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de LUGARES
require_once('../models/lugares.model.php');
//error_reporting(0);
$lugares = new Lugares;

switch ($_GET["op"]) {
        //TODO: operaciones de lugares

    case 'todos': //TODO: Procedimiento para cargar todos los datos del lugares
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase lugares.model.php
        
        $datos = $lugares->todos(); // Llamo al metodo todos de la clase lugares.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $id_lugar = $_POST["id_lugar"];
        $datos = array();
        $datos = $lugares->uno($id_lugar);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        
    case 'insertar':  //TODO: Procedimiento para insertar un lugares en la base de datos
        $nombre = $_POST["nombre"];
        $longitud = $_POST["longitud"];
        $latitud = $_POST["latitud"];
        $datos = array();
        $datos = $lugares->insertar($nombre,$longitud,$latitud);
        echo json_encode($datos);
        break;
        
    case 'actualizar':  //TODO: Procedimiento para actualizar un Lugares en la base de datos
        $id_lugar = $_POST["id_lugar"];
        $nombre = $_POST["nombre"];
        $longitud = $_POST["longitud"];
        $latitud = $_POST["latitud"];
        $datos = array();
        $datos = $lugares->actualizar($id_lugar, $nombre,$longitud,$latitud);
        echo json_encode($datos);
        break;
        
    case 'eliminar': //TODO: Procedimiento para eliminar un lugares en la base de datos
        $id_lugar = $_POST["id_lugar"];
        $datos = array();
        $datos = $lugares->eliminar($id_lugar);
        echo json_encode($datos);
        break;
}