<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de DATOSRESERVA
require_once('../models/datosreserva.model.php');
//error_reporting(0);
$datosreserva = new DatosReserva;

switch ($_GET["op"]) {
        //TODO: operaciones de datosreserva

    case 'todos': //TODO: Procedimiento para cargar todos los datos del datosreserva
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase datosreserva.model.php
        
        $datos = $datosreserva->todos(); // Llamo al metodo todos de la clase datosreserva.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $id_datoreserva = $_POST["id_datoreserva"];
        $datos = array();
        $datos = $datosreserva->uno($id_datoreserva);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
        
    case 'insertar':  //TODO: Procedimiento para insertar un datosreserva en la base de datos
        $id_reserva = $_POST["id_reserva"];
        $id_tipodato = $_POST["id_tipodato"];
        $valor = $_POST["valor"];
        $datos = array();
        $datos = $datosreserva->insertar($id_reserva,$id_tipodato,$valor);
        //echo json_encode($datos);
        break;
        
    case 'actualizar':  //TODO: Procedimiento para actualizar un DatosReserva en la base de datos
        $id_datoreserva = $_POST["id_datoreserva"];
        $id_reserva = $_POST["id_reserva"];
        $id_tipodato = $_POST["id_tipodato"];
        $valor = $_POST["valor"];
        $datos = array();
        $datos = $datosreserva->actualizar($id_datoreserva, $id_reserva,$id_tipodato,$valor);
        echo json_encode($datos);
        break;
        
    case 'eliminar': //TODO: Procedimiento para eliminar un datosreserva en la base de datos
        $id_datoreserva = $_POST["id_datoreserva"];
        $datos = array();
        $datos = $datosreserva->eliminar($id_datoreserva);
        echo json_encode($datos);
        break;
}