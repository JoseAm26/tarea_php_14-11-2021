<?php
namespace Tienda;
use PDO;
use PDOException;

class Conexion{
    protected static $conexion;

    public function __construct(){
        if(self::$conexion==null){
            self::crearConexion();
        }
    }
    public static function crearConexion(){
        //Leer el fichero .config
        $fichero = dirname(__DIR__, 1)."/.config";
        $opciones=parse_ini_file($fichero);
        $dbname=$opciones['dbname'];
        $host=$opciones['host'];
        $usuario=$opciones['user'];
        $pass=$opciones['pass'];
        //Crear dns
        $dns="mysql:host$host;dbname:$dbname;charset=utf8mb4";
        //Creamos la conexion
        try{
            self::$conexion=new PDO($dns, $usuario, $pass);
        }catch(PDOException $ex){
            die("Error en la conexion con la DB!!!: ".$ex->getMessage());
        }
    }
}

$conexion=new Conexion();
