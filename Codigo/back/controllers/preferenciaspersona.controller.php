<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de PREFERENCIASPERSONA
require_once('../models/preferenciaspersona.model.php');
//error_reporting(0);
$preferenciaspersona = new PreferenciasPersona;

switch ($_GET["op"]) {
        //TODO: operaciones de preferenciaspersona

    case 'todos': //TODO: Procedimiento para cargar todos los datos del preferenciaspersona
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase preferenciaspersona.model.php
        
        $datos = $preferenciaspersona->todos(); // Llamo al metodo todos de la clase preferenciaspersona.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $id_preferenciapersona = $_POST["id_preferenciapersona"];
        $datos = array();
        $datos = $preferenciaspersona->uno($id_preferenciapersona);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        
    case 'insertar':  //TODO: Procedimiento para insertar un preferenciaspersona en la base de datos
        $id_preferencia = $_POST["id_preferencia"];
        $id_persona = $_POST["id_persona"];
        $grado = $_POST["grado"];
        $datos = array();
        $datos = $preferenciaspersona->insertar($id_preferencia,$id_persona,$grado);
        //echo json_encode($datos);
        break;
        
    case 'actualizar':  //TODO: Procedimiento para actualizar un PreferenciasPersona en la base de datos
        $id_preferenciapersona = $_POST["id_preferenciapersona"];
        $id_preferencia = $_POST["id_preferencia"];
        $id_persona = $_POST["id_persona"];
        $grado = $_POST["grado"];
        $datos = array();
        $datos = $preferenciaspersona->actualizar($id_preferenciapersona, $id_preferencia,$id_persona,$grado);
        echo json_encode($datos);
        break;
        
    case 'eliminar': //TODO: Procedimiento para eliminar un preferenciaspersona en la base de datos
        $id_preferenciapersona = $_POST["id_preferenciapersona"];
        $datos = array();
        $datos = $preferenciaspersona->eliminar($id_preferenciapersona);
        echo json_encode($datos);
        break;
}