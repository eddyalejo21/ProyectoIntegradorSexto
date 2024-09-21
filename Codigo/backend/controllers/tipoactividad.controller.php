<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de Tipos de Actividad
require_once('../models/tipoactividad.model.php');
//error_reporting(0);
$tipoactividad = new TipoActividad;

switch ($_GET["op"]) {
        //TODO: operaciones de tipo de actividad

    case 'todos': //TODO: Procedimiento para cargar todos los datos del tipo de actividad
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase tipoactividad.model.php
        
        $datos = $tipoactividad->todos(); // Llamo al metodo todos de la clase tipoactividad.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $id_tipoactividad = $_POST["id_tipoactividad"];
        $datos = array();
        $datos = $tipoactividad->uno($id_tipoactividad);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        
    case 'insertar':  //TODO: Procedimiento para insertar un tipo de actividad en la base de datos
        $nombre = $_POST["nombre"];
        $datos = array();
        $datos = $tipoactividad->insertar($nombre);
        echo json_encode($datos);
        break;
        
    case 'actualizar':  //TODO: Procedimiento para actualizar un tipo de actividad en la base de datos
        $id_tipoactividad = $_POST["id_tipoactividad"];
        $nombre = $_POST["nombre"];
        $datos = array();
        $datos = $tipoactividad->actualizar($id_tipoactividad, $nombre);
        echo json_encode($datos);
        break;
        
    case 'eliminar': //TODO: Procedimiento para eliminar un comercios en la base de datos
        $id_tipoactividad = $_POST["id_tipoactividad"];
        $datos = array();
        $datos = $tipoactividad->eliminar($id_tipoactividad);
        echo json_encode($datos);
        break;
}