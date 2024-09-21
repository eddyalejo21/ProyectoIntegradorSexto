<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de PERSONAS
require_once('../models/personas.model.php');
//error_reporting(0);
$personas = new Personas;

switch ($_GET["op"]) {
        //TODO: operaciones de personas

    case 'todos': //TODO: Procedimiento para cargar todos los datos del personas
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase personas.model.php
        
        $datos = $personas->todos(); // Llamo al metodo todos de la clase personas.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $id_persona = $_POST["id_persona"];
        $datos = array();
        $datos = $personas->uno($id_persona);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        
    case 'insertar':  //TODO: Procedimiento para insertar un personas en la base de datos
        $nombres = $_POST["nombres"];
        $apellidos = $_POST["apellidos"];
        $id_nacionalidad = $_POST["id_nacionalidad"];
        $datos = array();
        $datos = $personas->insertar($nombres,$apellidos,$id_nacionalidad);
        //echo json_encode($datos);
        break;
        
    case 'actualizar':  //TODO: Procedimiento para actualizar un Personas en la base de datos
        $id_persona = $_POST["id_persona"];
        $nombres = $_POST["nombres"];
        $apellidos = $_POST["apellidos"];
        $id_nacionalidad = $_POST["id_nacionalidad"];
        $datos = array();
        $datos = $personas->actualizar($id_persona, $nombres,$apellidos,$id_nacionalidad);
        echo json_encode($datos);
        break;
        
    case 'eliminar': //TODO: Procedimiento para eliminar un personas en la base de datos
        $id_persona = $_POST["id_persona"];
        $datos = array();
        $datos = $personas->eliminar($id_persona);
        echo json_encode($datos);
        break;
}