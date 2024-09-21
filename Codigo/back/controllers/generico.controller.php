<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de NOMBRETABLA
require_once('../models/nombretabla.model.php');
//error_reporting(0);
$nombretabla = new NombreTabla;

switch ($_GET["op"]) {
        //TODO: operaciones de nombretabla

    case 'todos': //TODO: Procedimiento para cargar todos los datos del nombretabla
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase nombretabla.model.php
        
        $datos = $nombretabla->todos(); // Llamo al metodo todos de la clase nombretabla.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $id_nombreid = $_POST["id_nombreid"];
        $datos = array();
        $datos = $nombretabla->uno($id_nombreid);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        
    case 'insertar':  //TODO: Procedimiento para insertar un nombretabla en la base de datos
        $campo1 = $_POST["campo1"];
        $campo2 = $_POST["campo2"];
        $campo3 = $_POST["campo3"];
        $campo4 = $_POST["campo4"];
        $campo5 = $_POST["campo5"];
        $campo6 = $_POST["campo6"];
        $datos = array();
        $datos = $nombretabla->insertar($parametros);
        //echo json_encode($datos);
        break;
        
    case 'actualizar':  //TODO: Procedimiento para actualizar un NombreTabla en la base de datos
        $id_nombreid = $_POST["id_nombreid"];
        $campo1 = $_POST["campo1"];
        $campo2 = $_POST["campo2"];
        $campo3 = $_POST["campo3"];
        $campo4 = $_POST["campo4"];
        $campo5 = $_POST["campo5"];
        $campo6 = $_POST["campo6"];
        $datos = array();
        $datos = $nombretabla->actualizar($id_nombreid, $parametros);
        echo json_encode($datos);
        break;
        
    case 'eliminar': //TODO: Procedimiento para eliminar un nombretabla en la base de datos
        $id_nombreid = $_POST["id_nombreid"];
        $datos = array();
        $datos = $nombretabla->eliminar($id_nombreid);
        echo json_encode($datos);
        break;
}