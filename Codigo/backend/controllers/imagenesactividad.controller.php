<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}

require_once('../models/imagenes_actividad.model.php');
//error_reporting(0);
$imagenes_actividad = new Imagenes_Actividad;

switch ($_GET["op"]) {
    

    case 'todos':
        $datos = array();

        $datos = $imagenes_actividad->todos();
        while ($row = mysqli_fetch_assoc($datos))
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno':
        $id_imagenesactividad = $_POST["id_imagenesactividad"];
        $datos = array();
        $datos = $imagenes_actividad->uno($id_imagenesactividad);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar':
        $nombre = $_POST["nombre"];
        $path = $_POST["path"];
        $id_actividad = $_POST["id_actividad"];
        $datos = array();
        $datos = $imagenes_actividad->insertar($nombre, $path, $id_actividad);
        echo json_encode($datos);
        break;

    case 'actualizar':
        $id_imagenesactividad = $_POST["id_imagenesactividad"];
        $nombre = $_POST["nombre"];
        $path = $_POST["path"];
        $id_actividad = $_POST["id_actividad"];
        $datos = array();
        $datos = $imagenes_actividad->actualizar($id_imagenesactividad, $nombre, $path, $id_actividad);
        echo json_encode($datos);
        break;

    case 'eliminar':
        $id_imagenesactividad = $_POST["id_imagenesactividad"];
        $datos = array();
        $datos = $imagenes_actividad->eliminar($id_imagenesactividad);
        echo json_encode($datos);
        break;
}
