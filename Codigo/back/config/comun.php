<?php
require_once('config.php');

//TODO: Clase para modelar la base de datos
class ClaseBaseDatos
{
    

    protected $db;
    private $host = "localhost";
    private $usuario = "root";
    private $pass = "";
    private $base = "touristtrekbd";
    private $puerto = "3306";
    

    public function Conectar()
    {
        try {
            $conexion = new ClaseConectar;
            $this->db = $conexion->ProcedimientoParaConectar($this->host, $this->usuario, $this->pass, $this->base, $this->puerto);
        } catch (Exception $ex) {
            die("Error al conectar con el servidor: " . $conexion->connect_error);
        }   
        return $this->db;
    }
}

//TODO: Clase para modelar las tablas de base de datos
class ClaseTabla
{
    private $nombre = "";
    private $id = "";
    private $campos= array();
    
    public function __construct($nombreTabla, $idTabla)
    {
        $this->nombre = $nombreTabla;
        $this->id = $idTabla;
        $this->campos = array();
    }

    public function AgregarCampo($nombreCampo)
    {
        $this->campos[] = $nombreCampo;
    }

    public function DevolverTodos() 
    {     
        $con = new ClaseBaseDatos();
        $con = $con->Conectar();
        $cadena = "SELECT * FROM `$this->nombre`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function DevolverUno($id_registro) 
    {
        $con = new ClaseBaseDatos();
        $con = $con->Conectar();
        $cadena = "SELECT * FROM `$this->nombre` WHERE `$this->id`= $id_registro";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function InsertarRegistro($valores) 
    { 
        try {
             
            $con = new ClaseBaseDatos();
            $con = $con->Conectar();
            
            $cadena = "INSERT INTO `$this->nombre`(";
            $pos = 1;  //control de posiciones
            //agregar los campos de la taba
            foreach ($this->campos as $valor) 
            {
                if (count($this->campos) > $pos)
                    $cadena .= "`$valor`, "; 
                else
                    $cadena .= "`$valor`)";
                $pos++;
            }   
            $cadena .= " VALUES (";
            $pos = 1; //reserteamos el control de posisciones
            //agregar los valores a insertar
            foreach ($valores as $valor) 
            {
                if (count($valores) > $pos)
                    $cadena .= "'$valor', "; 
                else
                    $cadena .= "'$valor')";
                $pos++;
            }
            if (mysqli_query($con, $cadena)) {
                return $con->insert_id;
            } else {
                return $con->error;
            }               
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
            
    }
    public function ActualizarRegistro($id_registro, $valores) 
    {
        try {
            $con = new ClaseBaseDatos();
            $con = $con->Conectar();
            $cadena = "UPDATE `$this->nombre` SET ";
            $pos = 0;
            foreach ($valores as $valor) 
            {
                $campoTmp = $this->campos[$pos];
                if ((count($valores) -1) > $pos)
                    $cadena .="`$campoTmp`='$valor', ";
                else
                    $cadena .="`$campoTmp`='$valor' ";
                $pos++;
            }  
            $cadena .= "WHERE `$this->id` = $id_registro";
            if (mysqli_query($con, $cadena)) {
                return $id_registro;
            } else {
                return $con->error;
            }
       
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
    public function EliminarRegistro($idregistro) 
    {
        try {
            $con = new ClaseBaseDatos();
            $con = $con->Conectar();
            $cadena = "DELETE FROM `$this->nombre` WHERE `$this->id`= $idregistro";
            if (mysqli_query($con, $cadena)) {
                return 1;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    
}