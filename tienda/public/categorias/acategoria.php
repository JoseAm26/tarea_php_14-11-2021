<?php
if (!isset($_GET['id'])) {
    header("Location:index.php");
}
session_start();
require dirname(__DIR__, 2) . "/vendor/autoload.php";

use Tienda\Categoria;

$id = $_GET['id'];
$datosAutor = (new Categoria)->read($id);
function hayError($n, $d)
{
    $error = false;
    if (strlen($n) == 0) {
        $_SESSION['error_nombre'] = "Rellene el campo nombre";
        $error = true;
    }
    if (strlen($d) == 0) {
        $_SESSION['error_descripcion'] = "Rellene el campo descripcion";
        $error = true;
    }
    
    return $error;
}
if (isset($_POST['btnUpdate'])) {
    //procesamos el Formulario
    $nombre = trim(ucwords($_POST['nombre']));
    $descripcion = trim(ucwords($_POST['descripcion']));
    
    if (!hayError($nombre, $descripcion)) {
        (new Autores)->setNombre($nombre)
            ->setApellidos($descripcion)
            ->setId($id)
            ->update();
        $_SESSION['mensaje'] = "Categoria actualizado con exito";
        header("Location:index.php");
        die();
    }
    //
    header("Location:{$_SERVER['PHP_SELF']}?id=$id");
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

        <title>Actualizar Categoria</title>





    </head>

    <body style="background-color:blue">
        <h3 class="text-center">Actualizar Categoria</h3>
        <div class="container mt-2">
            <form name="ccategoria" action="<?php echo $_SERVER['PHP_SELF'] . "?id=$id"; ?>" method='POST'>
                <div class="bg-success" style="width:40rem">
                    <div class="mb-3">
                        <label for="n" class="form-label">Nombre Categoria</label>
                        <input type="text" class="form-control" id="n" placeholder="Nombre" name="nombre" value="<?php echo $datosAutor->nombre ?>" required>
                        <?php
                        if (isset($_SESSION['error_nombre'])) {
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
                        <label for="a" class="form-label">Descripcion</label>
                        <input type="text" class="form-control" id="d" placeholder="Descripcion" name="descripcion" value="<?php echo $datosAutor->apellidos ?>" required>
                        <?php
                        if (isset($_SESSION['error_descripcion'])) {
                            echo <<<TXT
                            <div class="mt-2 text-danger fw-bold" style="font-size:small">
                                {$_SESSION['error_descripcion']}
                            </div>
                            TXT;
                            unset($_SESSION['error_descripcion']);
                        }
                        ?>
                    </div>
                    
                    <div>
                        <button type='submit' name="btnUpdate" class="btn btn-info"><i class="fas fa-user-edit"></i> Actualizar</button>
                        <a href="index.php" class="btn btn-primary"><i class="fas fa-backward"></i> Volver</a>
                    </div>
                </div>
            </form>
        </div>
    </body>

    </html>
<?php } ?>
