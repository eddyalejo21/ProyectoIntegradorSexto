<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de COMERCIOS
require_once('../models/comercios.model.php');
//error_reporting(0);
$comercios = new Comercios;

switch ($_GET["op"]) {
        //TODO: operaciones de comercios

    case 'todos': //TODO: Procedimiento para cargar todos los datos del comercios
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase comercios.model.php
        
        $datos = $comercios->todos(); // Llamo al metodo todos de la clase comercios.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $id_comercio = $_POST["id_comercio"];
        $datos = array();
        $datos = $comercios->uno($id_comercio);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        
    case 'insertar':  //TODO: Procedimiento para insertar un comercios en la base de datos

        if(!isset($_POST["nombre"]) || !isset($_POST["direccion"]) || !isset($_POST["id_estado"]) || !isset($_POST["longitud"]) || !isset($_POST["latitud"])){
            $datos = array("error" => "Faltan datos requeridos");
            echo json_encode($datos);
            exit();  
        }


        $nombre = $_POST["nombre"];
        $direccion = $_POST["direccion"];
        $id_estado = $_POST["id_estado"];
        $longitud = $_POST["longitud"];
        $latitud = $_POST["latitud"];
        $datos = array();
        $datos = $comercios->insertar($nombre,$direccion,$id_estado,$longitud,$latitud);
        echo json_encode($datos);
        break;
        
    case 'actualizar':  //TODO: Procedimiento para actualizar un Comercios en la base de datos
        $id_comercio = $_POST["id_comercio"];
        $nombre = $_POST["nombre"];
        $direccion = $_POST["direccion"];
        $id_estado = $_POST["id_estado"];
        $longitud = $_POST["longitud"];
        $latitud = $_POST["latitud"];
        $datos = array();
        $datos = $comercios->actualizar($id_comercio, $nombre,$direccion,$id_estado,$longitud,$latitud);
        echo json_encode($datos);
        break;
        
    case 'eliminar': //TODO: Procedimiento para eliminar un comercios en la base de datos
        $id_comercio = $_POST["id_comercio"];
        $datos = array();
        $datos = $comercios->eliminar($id_comercio);
        echo json_encode($datos);
        break;
}