<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de USUARIOS
require_once('../models/usuarios.model.php');
//error_reporting(0);
$usuarios = new Usuarios;

switch ($_GET["op"]) {
        //TODO: operaciones de usuarios

    case 'todos': //TODO: Procedimiento para cargar todos los datos del usuarios
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase usuarios.model.php
        
        $datos = $usuarios->todos(); // Llamo al metodo todos de la clase usuarios.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $id_usuario = $_POST["id_usuario"];
        $datos = array();
        $datos = $usuarios->uno($id_usuario);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        
    case 'insertar':  //TODO: Procedimiento para insertar un usuarios en la base de datos
        $id_persona = $_POST["id_persona"];
        $nick = $_POST["nick"];
        $id_estado = $_POST["id_estado"];
        $id_rol = $_POST["id_rol"];
        $datos = array();
        $datos = $usuarios->insertar($id_persona,$nick,$id_estado,$id_rol);
        //echo json_encode($datos);
        break;
        
    case 'actualizar':  //TODO: Procedimiento para actualizar un Usuarios en la base de datos
        $id_usuario = $_POST["id_usuario"];
        $id_persona = $_POST["id_persona"];
        $nick = $_POST["nick"];
        $id_estado = $_POST["id_estado"];
        $id_rol = $_POST["id_rol"];
        $datos = array();
        $datos = $usuarios->actualizar($id_usuario, $id_persona,$nick,$id_estado,$id_rol);
        echo json_encode($datos);
        break;
        
    case 'eliminar': //TODO: Procedimiento para eliminar un usuarios en la base de datos
        $id_usuario = $_POST["id_usuario"];
        $datos = array();
        $datos = $usuarios->eliminar($id_usuario);
        echo json_encode($datos);
        break;
}