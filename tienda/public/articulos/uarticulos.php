<?php
if (!isset($_GET['id'])) {
    header("Location:index.php");
    die();
}

$id = $_GET['id'];

session_start();
require dirname(__DIR__, 2) . "/vendor/autoload.php";

use Tienda\{Categoria, Articulos};


$esteArticulo = (new Articulos)->read($id);

$articulos = (new Autores)->devolverArticulos();
function hayError($n, $p)
{
    global $id;
    $error = false;
    
    if (strlen($n) == 0) {
        $error = true;
        $_SESSION['error_nombre'] = "Rellene el nombre !!!";
    }
    if (strlen($p) <= 5) {
        $error = true;
        $_SESSION['error_precio'] = "Este campo debe contener al menos 10 caracteres";
    }
    return $error;
}

if (isset($_POST['btnUpdate'])) {
    $nombre = trim(ucwords($_POST['nombre']));
    $preico = trim(ucfirst($_POST['precio']));
    $categoria_id = $_POST['categoria_id'];
    if (!hayError($nomrbe, $precio)) {
        (new Libros)->setNombre($nombre)
            ->setPrecio($precio)
            ->setCategoria_id($categoria_id)
            ->update($id);
        $_SESSION['mensaje'] = "Articulo Actualizado.";
        header("Location:index.php");
    } else {
        header("Location:{$_SERVER['PHP_SELF']}?id=$id");
    }
} else {
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

        <title>Actualizar Articulo</title>





    </head>

    <body style="background-color:silver">
        <h5 class="text-center">Nuevo Articulo</h5>
        <div class="container mt-2">
            <div class="bg-success p-4 text-white rounded shadow-lg mx-auto" style="width:40rem">
                <form name="carticulos" method="POST" action="<?php echo $_SERVER['PHP_SELF'] . "?id=$id" ?>">
                    <div class="mb-3">
                        <label for="t" class="form-label">Nomrbe Articulos</label>
                        <input type="text" class="form-control" id="n" placeholder="Nombres" name="nombre" required value="<?php echo $esteLibro->titulo ?>" />
                        <?php
                        if (isset($_SESSION['error_nomrbre'])) {
                            echo <<<TXT
                            <div class="mt-2 text-danger fw-bold" style="font-size:small">
                                {$_SESSION['error_nomrbre']}
                            </div>
                            TXT;
                            unset($_SESSION['error_nomrbre']);
                        }
                        ?>
                    </div>
                    <div class="mb-3">
                        <label for="s" class="form-label">Precio Articulo</label>
                        <textarea class="form-control" id="p" rows="4" name="precio"><?php echo $esteLibro->sinopsis ?></textarea>
                        <?php
                        if (isset($_SESSION['error_precio'])) {
                            echo <<<TXT
                            <div class="mt-2 text-danger fw-bold" style="font-size:small">
                                {$_SESSION['error_precio']}
                            </div>
                            TXT;
                                {$_SESSION['']}
                                unset($_SESSION['error_precio']);
                        }
                        ?>
                    </div>
                    
                    
                    <div class="mb-3">
                        <button type='submit' name="btnUpdate" class="btn btn-info"><i class="fas fa-edit"></i> Editar</button>
                        <a href="index.php" class="btn btn-primary"><i class="fas fa-backward"></i> Volver</a>
                    </div>

                </form>
            </div>
        </div>
    </body>

    </html>
<?php } ?>