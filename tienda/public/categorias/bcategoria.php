<?php
if(!isset($_POST['id'])){
    header("Location:index.php");
    die();
}
session_start();
require dirname(__DIR__, 2)."/vendor/autoload.php";
use Tienda\Categoria;
(new Categoria)->delete($_POST['id']);
$_SESSION['mensaje']="Categoria Borrada.";
header("Location:index.php");