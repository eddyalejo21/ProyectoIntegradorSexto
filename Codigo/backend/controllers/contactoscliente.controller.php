<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}

require_once('../models/contactoscliente.model.php');
//error_reporting(0);
$contactoscliente = new ContactosCliente;

switch ($_GET["op"]) {
    

    case 'todos':
        $datos = array();

        $datos = $contactoscliente->todos();
        while ($row = mysqli_fetch_assoc($datos))
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno':
        $id_contactoscliente = $_POST["id_contactoscliente"];
        $datos = array();
        $datos = $contactoscliente->uno($id_contactoscliente);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar':
        $id_mediocontacto = $_POST["id_mediocontacto"];
        $id_cliente = $_POST["id_cliente"];
        $datos = array();
        $datos = $contactoscliente->insertar($id_mediocontacto, $id_cliente);
        echo json_encode($datos);
        break;

    case 'actualizar':
        $id_contactoscliente = $_POST["id_contactoscliente"];
        $id_mediocontacto = $_POST["id_mediocontacto"];
        $id_cliente = $_POST["id_cliente"];
        $datos = array();
        $datos = $contactoscliente->actualizar($id_contactoscliente, $id_mediocontacto, $id_cliente);
        echo json_encode($datos);
        break;

    case 'eliminar':
        $id_contactoscliente = $_POST["id_contactoscliente"];
        $datos = array();
        $datos = $contactoscliente->eliminar($id_contactoscliente);
        echo json_encode($datos);
        break;
}
