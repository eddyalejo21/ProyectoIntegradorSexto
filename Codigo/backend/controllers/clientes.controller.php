<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de Actividades
require_once('../models/clientes.model.php');
//error_reporting(0);
$clientes = new Clientes;

switch ($_GET["op"]) {
        //TODO: operaciones de actividades

    case 'todos': //TODO: Procedimiento para cargar todos los datos del proveedor
        $datos = array(); // Defino un arreglo para almacenar los valores que vienen de la clase proveedores.model.php

        $datos = $clientes->todos(); // Llamo al metodo todos de la clase comercios.model.php
        while ($row = mysqli_fetch_assoc($datos)) //Ciclo de repeticion para asociar los valor almancenados en la variable $datos
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno': //TODO: procedimiento para obtener un registro de la base de datos
        $id_cliente = $_POST["id_cliente"];
        $datos = array();
        $datos = $clientes->uno($id_cliente);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar':  //TODO: Procedimiento para insertar un proveedor en la base de datos
        $identificacion = $_POST["identificacion"];
        $nombre = $_POST["nombre"];
        $fecha_nacimiento = $_POST["fecha_nacimiento"];
        $genero = $_POST["genero"];
        $correo = $_POST["correo"];
        $telefono = $_POST["telefono"];
        $clave = $_POST["clave"];
        $token = $_POST["token"];
        $id_tipocliente = $_POST["id_tipocliente"];
        $estado = $_POST["estado"];
        $id_pais = $_POST["id_pais"];
        $datos = array();
        $datos = $clientes->insertar($identificacion, $nombre, $fecha_nacimiento, $genero, $correo, $telefono, $clave, $token, $id_tipocliente, $estado, $id_pais);
        echo json_encode($datos);
        break;

    case 'actualizar':  //TODO: Procedimiento para actualizar un Comercios en la base de datos
        $id_cliente = $_POST["id_cliente"];
        $identificacion = $_POST["identificacion"];
        $nombre = $_POST["nombre"];
        $fecha_nacimiento = $_POST["fecha_nacimiento"];
        $genero = $_POST["genero"];
        $correo = $_POST["correo"];
        $telefono = $_POST["telefono"];
        $clave = $_POST["clave"];
        $token = $_POST["token"];
        $id_tipocliente = $_POST["id_tipocliente"];
        $estado = $_POST["estado"];
        $id_pais = $_POST["id_pais"];
        $datos = array();
        $datos = $clientes->actualizar($id_cliente, $identificacion, $nombre, $fecha_nacimiento, $genero, $correo, $telefono, $clave, $token, $id_tipocliente, $estado, $id_pais);
        echo json_encode($datos);
        break;

    case 'eliminar': //TODO: Procedimiento para eliminar un comercios en la base de datos
        $id_cliente = $_POST["id_cliente"];
        $datos = array();
        $datos = $clientes->eliminar($id_cliente);
        echo json_encode($datos);
        break;


}
