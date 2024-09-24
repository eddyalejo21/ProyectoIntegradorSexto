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
require_once('../models/porcentajeganancia.model.php');
//error_reporting(0);
$porcentajeganancia = new PorcentajeGanancia;

switch ($_GET["op"]) {
        //TODO: operaciones de comercios

    case 'todos': //TODO: Procedimiento para cargar todos los datos del proveedor
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase proveedores.model.php
        
        $datos = $porcentajeganancia->todos(); // Llamo al metodo todos de la clase comercios.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $id_porcentajeganancia = $_POST["id_porcentajeganancia"];
        $datos = array();
        $datos = $porcentajeganancia->uno($id_porcentajeganancia);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        
    case 'insertar':  //TODO: Procedimiento para insertar un proveedor en la base de datos
        $descripcion = $_POST["descripcion"];
        $valor = $_POST["valor"];
        $estado = $_POST["estado"];
        $datos = array();
        $datos = $porcentajeganancia->insertar($descripcion, $valor, $estado);
        echo json_encode($datos);
        break;
        
    case 'actualizar':  //TODO: Procedimiento para actualizar un Comercios en la base de datos
        $id_porcentajeganancia = $_POST["id_porcentajeganancia"];
        $descripcion = $_POST["descripcion"];
        $valor = $_POST["valor"];
        $estado = $_POST["estado"];
        $datos = array();
        $datos = $porcentajeganancia->actualizar($id_porcentajeganancia, $descripcion, $valor, $estado);
        echo json_encode($datos);
        break;
        
    case 'eliminar': //TODO: Procedimiento para eliminar un comercios en la base de datos
        $id_porcentajeganancia = $_POST["id_porcentajeganancia"];
        $datos = array();
        $datos = $porcentajeganancia->eliminar($id_porcentajeganancia);
        echo json_encode($datos);
        break;
}