<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de PREFERENCIAS
require_once('../models/preferencias.model.php');
//error_reporting(0);
$preferencias = new Preferencias;

switch ($_GET["op"]) {
        //TODO: operaciones de preferencias

    case 'todos': //TODO: Procedimiento para cargar todos los datos del preferencias
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase preferencias.model.php
        
        $datos = $preferencias->todos(); // Llamo al metodo todos de la clase preferencias.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $id_preferencia = $_POST["id_preferencia"];
        $datos = array();
        $datos = $preferencias->uno($id_preferencia);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        
    case 'insertar':  //TODO: Procedimiento para insertar un preferencias en la base de datos
        $descripcion = $_POST["descripcion"];
        $id_tipo_actividad = $_POST["id_tipo_actividad"];
        $datos = array();
        $datos = $preferencias->insertar($descripcion,$id_tipo_actividad);
        //echo json_encode($datos);
        break;
        
    case 'actualizar':  //TODO: Procedimiento para actualizar un Preferencias en la base de datos
        $id_preferencia = $_POST["id_preferencia"];
        $descripcion = $_POST["descripcion"];
        $id_tipo_actividad = $_POST["id_tipo_actividad"];
        $datos = array();
        $datos = $preferencias->actualizar($id_preferencia, $descripcion,$id_tipo_actividad);
        echo json_encode($datos);
        break;
        
    case 'eliminar': //TODO: Procedimiento para eliminar un preferencias en la base de datos
        $id_preferencia = $_POST["id_preferencia"];
        $datos = array();
        $datos = $preferencias->eliminar($id_preferencia);
        echo json_encode($datos);
        break;
}