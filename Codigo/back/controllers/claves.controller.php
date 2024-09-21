<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de CLAVES
require_once('../models/claves.model.php');
//error_reporting(0);
$claves = new Claves;

switch ($_GET["op"]) {
        //TODO: operaciones de claves

    case 'todos': //TODO: Procedimiento para cargar todos los datos del claves
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase claves.model.php
        
        $datos = $claves->todos(); // Llamo al metodo todos de la clase claves.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $id_clave = $_POST["id_clave"];
        $datos = array();
        $datos = $claves->uno($id_clave);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        
    case 'insertar':  //TODO: Procedimiento para insertar un claves en la base de datos
        $valor = $_POST["valor"];
        $id_estado = $_POST["id_estado"];
        $id_usuario = $_POST["id_usuario"];
        $fecha_vigente = $_POST["fecha_vigente"];
        $datos = array();
        $datos = $claves->insertar($valor,$id_estado,$id_usuario,$fecha_vigente);
        //echo json_encode($datos);
        break;
        
    case 'actualizar':  //TODO: Procedimiento para actualizar un Claves en la base de datos
        $id_clave = $_POST["id_clave"];
        $valor = $_POST["valor"];
        $id_estado = $_POST["id_estado"];
        $id_usuario = $_POST["id_usuario"];
        $fecha_vigente = $_POST["fecha_vigente"];
        $datos = array();
        $datos = $claves->actualizar($id_clave, $valor,$id_estado,$id_usuario,$fecha_vigente);
        echo json_encode($datos);
        break;
        
    case 'eliminar': //TODO: Procedimiento para eliminar un claves en la base de datos
        $id_clave = $_POST["id_clave"];
        $datos = array();
        $datos = $claves->eliminar($id_clave);
        echo json_encode($datos);
        break;
}