<?php
namespace Tienda;

use PDOException;
use PDO;
use Faker;

class Articulos extends Conexion{
    private $id;
    private $nombre;
    private $precio;
    private $categotia_id;
    
    public function __construct(){
        parent::__construct();
    }
    // -----------------CRUD------------------------
    public function create(){
        $q = "insert into articulos(nombre, precio, categoria_id) values(:n, :p, :ci)";
        $stmt = parent::$conexion->prepare($q);
        try {
            $stmt->execute([
                ':n' => $this->nombre,
                ':p' => $this->precio,
                ':ci' => $this->categoria_id
            ]);
        } catch (PDOException $ex) {
            die("Error al insertar libro: " . $ex->getMessage());
        };
        parent::$conexion = null;
    }
    public function read($id){
        $q = "select articulos.*, nombre, precio from articulos, categorias where 
        categoria_id=categoria.id AND articulos.id=:i";
        $stmt = parent::$conexion->prepare($q);
        try {
            $stmt->execute([
                ':i' => $id
            ]);
        } catch (PDOException $ex) {
            die("Error al recuperar articulo " . $ex->getMessage());
        }
        parent::$conexion = null;
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    
    public function update($id){
        $q = "update articulos set nombre=:n, precio=:p, categoria_id=:ci where id=:id";
        $stmt = parent::$conexion->prepare($q);
        try {
            $stmt->execute([
                ':n' => $this->nombre,
                ':pp' => $this->precio,
                ':ci' => $this->categoria_id,
                ':id' => $id
            ]);
        } catch (PDOException $ex) {
            die("Error al actualizar el Articulos: " . $ex->getMessage());
        }
    }
    public function delete($id){
        $q = "delete from articulos where id=:i";
        $stmt = parent::$conexion->prepare($q);
        try {
            $stmt->execute([
                ':i' => $id
            ]);
        } catch (PDOException $ex) {
            die("Error al borrar articulos: " . $ex->getMessage());
        }
        parent::$conexion = null;
    }
    public function readAll()
    {
        $q = "select * from libros order by titulo, autor_id";
        $stmt = parent::$conexion->prepare($q);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            die("Error al devolver todos los libros: " . $ex->getMessage());
        }
        parent::$conexion = null;
        return $stmt;
    }
    public function generarArticulos($cant)
    {
        if (!$this->hayArticulos()) {
            $faker = Faker\Factory::create('es_ES');
            $autores = (new Autores)->devolverId(); 

            for ($i = 0; $i < $cant; $i++) {
                $nombre = $faker->text(10);
                $precio = $faker->randonNumber();
                $categoria_id = $autores[array_rand($autores, 1)];

                (new Libros)->setNombre($nombre)
                    ->setPrecio($precio)
                    ->setCategoria_id($categoria_id)
                    ->create();
            }
        }
    }
    public function hayLibros()
    {
        $q = "select * from articulos";
        $stmt = parent::$conexion->prepare($q);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            die("Error al comprobar si hay : " . $ex->getMessage());
        }
        $totalLibros = $stmt->rowCount();
        parent::$conexion = null;
        return ($totalLibros > 0);
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
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of categotia_id
     */ 
    public function getCategotia_id()
    {
        return $this->categotia_id;
    }

    /**
     * Set the value of categotia_id
     *
     * @return  self
     */ 
    public function setCategotia_id($categotia_id)
    {
        $this->categotia_id = $categotia_id;

        return $this;
    }
}