<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de TIPOCATALOGOS
require_once('../models/tipocatalogo.model.php');
//error_reporting(0);
$tipocatalogos = new TipoCatalogo;

switch ($_GET["op"]) {
        //TODO: operaciones de tipocatalogos

    case 'todos': //TODO: Procedimiento para cargar todos los datos del tipocatalogo
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase tipocatalogos.model.php
        
        $datos = $tipocatalogos->todos(); // Llamo al metodo todos de la clase tipocatalogos.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $idtipocatalogo = $_POST["idtipocatalogo"];
        $datos = array();
        $datos = $tipocatalogos->uno($idtipocatalogo);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        
    case 'insertar':  //TODO: Procedimiento para insertar un tipocatalogo en la base de datos
        $tipo = $_POST["tipo"];
        $datos = array();
        $datos = $tipocatalogos->insertar($tipo);
        //echo json_encode($datos);
        break;
        
    case 'actualizar':  //TODO: Procedimiento para actualizar un TipoCatalogo en la base de datos
        $idtipocatalogo = $_POST["idtipocatalogo"];
        $tipo = $_POST["tipo"];
        $datos = array();

        $datos = $tipocatalogos->actualizar($idtipocatalogo, $tipo);
        echo json_encode($datos);
        break;
        
    case 'eliminar': //TODO: Procedimiento para eliminar un tipocatalogo en la base de datos
        $idtipocatalogo = $_POST["idtipocatalogo"];
        $datos = array();
        $datos = $tipocatalogos->eliminar($idtipocatalogo);
        echo json_encode($datos);
        break;
}