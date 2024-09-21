<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de CATALOGO
require_once('../models/catalogo.model.php');
//error_reporting(0);
$catalogo = new Catalogo;

switch ($_GET["op"]) {
        //TODO: operaciones de catalogo

    case 'todos': //TODO: Procedimiento para cargar todos los datos del catalogo
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase catalogo.model.php
        
        $datos = $catalogo->todos(); // Llamo al metodo todos de la clase catalogo.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $idcatalogo = $_POST["idcatalogo"];
        $datos = array();
        $datos = $catalogo->uno($idcatalogo);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        
    case 'insertar':  //TODO: Procedimiento para insertar un catalogo en la base de datos
        $detalle = $_POST["detalle"];
        $idtipo = $_POST["idtipo"];
        $valor = $_POST["valor"];
        $datos = array();
        $datos = $catalogo->insertar($detalle, $idtipo, $valor);
        //echo json_encode($datos);
        break;
        
    case 'actualizar':  //TODO: Procedimiento para actualizar un Catalogo en la base de datos
        $idcatalogo = $_POST["idcatalogo"];
        $detalle = $_POST["detalle"];
        $idtipo = $_POST["idtipo"];
        $valor = $_POST["valor"];
        $datos = array();
        $datos = $catalogo->actualizar($idcatalogo, $detalle, $idtipo, $valor);
        echo json_encode($datos);
        break;
        
    case 'eliminar': //TODO: Procedimiento para eliminar un catalogo en la base de datos
        $idcatalogo = $_POST["idcatalogo"];
        $datos = array();
        $datos = $catalogo->eliminar($idcatalogo);
        echo json_encode($datos);
        break;
}