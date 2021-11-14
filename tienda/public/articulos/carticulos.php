<?php
session_start();
require dirname(__DIR__, 2) . "/vendor/autoload.php";

use Tienda\{Categoria, Articulos};


$categoria = (new Categoria)->devolverCategoria();
function hayError($n, $p){
    $error=false;

    
    if(strlen($n)==0){
        $error=true;
        $_SESSION['error_nomrbe']="Rellene el nombre !!!";
    }
    if(strlen($s)<=5){
        $error=true;
        $_SESSION['error_precio']="Este campo debe contener al menos 10 caracteres";
    }
    return $error;
    

}

if(isset($_POST['btnCrear'])){
    $nombre=trim(ucwords($_POST['nombre']));
    $precio=trim(ucfirst($_POST['precio']));
    $categoria_id=$_POST['categoria_id'];
    if(!hayError($nombre, $precio)){
        (new Libros)->setTitulo($nombre)
        ->setSinopsis($precio)
        ->setAutor_id($autor_id)
        ->create();
        $_SESSION['mensaje']="Articulo Creado.";
        header("Location:index.php");
        

    }
    else{
        header("Location:{$_SERVER['PHP_SELF']}");
    }

}

else{
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BootStrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Crear Articulo</title>





</head>

<body style="background-color:blue">
    <h5 class="text-center">Nuevo Articulo</h5>
    <div class="container mt-2">
        <div class="" style="width:40rem">
            <form name="carticulo" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <div class="mb-3">
                    <label for="t" class="form-label">nombre articulo</label>
                    <input type="text" class="form-control" id="n" placeholder="Nombre" name="nombre" required>
                    <?php
                        if(isset($_SESSION['error_nombre'])){
                            echo <<<TXT
                            <div class="mt-2 text-danger fw-bold" style="font-size:small">
                                {$_SESSION['error_nombre']}
                            </div>
                            TXT;
                            unset($_SESSION['error_nombre']);
                        }
                    ?>       
                </div>
                <div class="mb-3">
                    <label for="s" class="form-label">Precio Articulos</label>
                    <textarea class="form-control" id="p" rows="4" name="precio"></textarea>
                    <?php
                        if(isset($_SESSION['error_precio'])){
                            echo <<<TXT
                            <div class="" style="font-size:small">
                                {$_SESSION['error_precio']}
                            </div>
                            TXT;
                            unset($_SESSION['error_precio']);
                        }
                    ?>       
                </div>
               
                <div class="mb-3">
                    <button type='submit' name="btnCrear" class="btn btn-info"><i class="fas fa-save"></i> Crear</button>
                    <button type="reset" class="btn btn-warning"><i class="fas fa-broom"></i> Limpiar</button>
                </div>

            </form>
        </div>
    </div>
</body>

</html>
<?php } ?>