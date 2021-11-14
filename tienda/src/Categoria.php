<?php
namespace Tienda;
use PDOException;
use PDO;
use Faker;

class Categoria extends Conexion{

    private $id;
    private $nombre;
    private $descripcion;

    public function __construct(){
        parent::__construct();
    }
    //------------------CRUD-----------------
    public function create(){
        $q="insert into categoria(nombre, descripcion) values(:n, :d)";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute([
                ':n'=>$this->nombre,
                ':d'=>$this->descripcion
            ]);
        }catch(PDOException $ex){
            die("Error al insertar: ".$ex->getMessage());
        }
        parent::$conexion=null;
    }
    public function read($id){
        $q = "select * from autores where id=:i";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute([
                ':i'=>$id
            ]);
        }catch(PDOException $ex){
            die("Error al borrar: ".$ex->setMessage());
        }
        parent::$conexion=null;
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function update(){
        $q="select categorias set nombre=:n, descripcion=:d where id=:i";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute([
                ':n'=>$this->nombre,
                ':d'=>$this->descripcion,
                ':i'=>$this->id
            ]);
        }catch(PDOException $ex){
            die("Error al actualizar: ".$ex->getMessage());
        }
        parent::$conexion=null;
    }
    public function delete(){
        $q="delete from categorias where id=:i";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute([
                ':i'=>$id
            ]);
        }catch(PDOException $ex){
            die("Error al borrar: ".$ex->getMessage());
        }
        parent::$conexion=null;
    }

    public function readAll(){
        $q ="select * from categorias";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute();
        }catch(PDOException $ex){
            die("Error al recuperar todos las categorias: ".$ex->getMessage());
        }
        parent::$conexion=null;
    }
    public function generarCategoria($cantidad){
        if ($this->hayCategoria() == 0) {
        $faker = Faker\Factory::create('es_ES');
            for($i = 0; $i<$cantidad; $i++){
                $nombre = $faker->firstName();
                $descripcion = $faker->text();
                (new Categoria)->set($nombre)
                ->setDescripcion($descripcion)
                ->create();
            }
        }
    }
    public function hayCategoria()
    {
        $q = "select * from categoria";
        $stmt = parent::$conexion->prepare($q);
        try {
            $stmt->execute();
            parent::$conexion = null;
        } catch (PDOException $ex) {
            die("Error");
        }
        return $stmt->rowCount(); //devuelve el numero de filas 

    }
    public function devolverId(){
        $q="select id from categorias";
        $stmt = parent::$conexion->prepare($q);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            die("Error en el metodo devolver id: " . $ex->getMessage());
        }
        $id=[];
        while ($fila = $stmt->fetch(PDO::FETCH_OBJ)) {
            $id[] = $fila->id;
        }
        parent::$conexion = null;
        return $id;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }
}