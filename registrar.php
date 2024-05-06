<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body>
<?php
    $host = "localhost";
    $puerto = "3306";
    $usuario = "root";
    $contrasena = "";
    $baseDatos = "sistemacafe";
    $tabla = "compra";

    function Conectarse(){
        global $host, $puerto, $usuario, $contrasena, $baseDatos, $tabla;

        if(!($link = mysqli_connect($host.":".$puerto,$usuario,$contrasena))){
            echo "Hubo un error conectando a la base de datos.<br>";
            exit();
        }
        if(!mysqli_select_db($link,$baseDatos)){
            echo "Error seleccionando la base de datos. <br>";
            exit();
        }
        return $link;
    }

    $link = Conectarse();

    if(isset($_POST['opciones'])){
        $a = $_POST['opciones'];
        $b = $_POST['NombreProducto'];
        $c = $_POST['Descripcion'];
        $d = $_POST['Receta'];
        $e = $_POST['Precio'];
 
        $directorio = "archivos";

        if (!file_exists($directorio)) {
            if (!mkdir($directorio, 0777, true)) {
                die('Error al crear el directorio');
            }
        }
            $archivo = $_FILES['Imagen'];
            $nombreArchivo = $_FILES['Imagen']['name'];
            $rutaTemp = $_FILES['Imagen']['tmp_name'];
            $rutaNueva = "archivos/" . $nombreArchivo;

            if(move_uploaded_file($rutaTemp, $rutaNueva))
            {
                echo "Se ha guardado correctamente<br>";
            }
            else
            {
                echo "No se ha podido subir el archivo<br>";
                exit();
            }

        $query = "INSERT INTO menus (CategoriaId, NombreProducto, Descripcion, Receta, Precio, Foto) VALUES ('$a', '$b', '$c', '$d', '$e', '$rutaNueva')";
        if(mysqli_query($link, $query)){
            header("Location: platillos.php");
            exit();
        } else {
            echo "Error al actualizar los datos: " . mysqli_error($link);
        }
    }
?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top" id="menu">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"><img src="imagenes/IMG_3778 (2).png" alt="" width="80px"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#producto">Menu</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contacto</a>
              </li>
              <li class="nav-item dropdown">
                <li class="nav-item">
                    <a class="nav-link" href="#conocenos">Conocenos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#mn">Favoritos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="registrar.html">Registrar</a>
                  </li>
              </li>
            </ul>
          </div>
        </div>
      </nav>
        <div class="card mx-auto" style="font-family: 'Sedan', sans-serif;margin-top:140px;margin-right: auto; margin-left: auto; max-width: 60%; margin-bottom: 30px;S box-shadow: 0 4px 6px rgba(0,0,0,0.1); border-radius: 10px;">
        <div class="container">
    <div class="card">
        <div class="card-header" style="background-color:#000; border-bottom: none; color: #deb600; font-weight: bold; border-radius: 10px 10px 0 0;">
            Datos del Menú
        </div>
        <div class="card-body">
            <form action="registrar.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <?php
                        $query = "SELECT * FROM categoria";
                        $result =  mysqli_query($link, $query);
                    ?>
                    <div class="mb-3">
                        <label for="opciones" class="form-label" style="color: rgb(97, 47, 0); font-weight: bold;">Seleccione una opción</label>
                        <select name="opciones" id="opciones" class="form-control form-control-lg">
                            <option require value="">Seleccione una opción</option>
                            <?php
                            while($row = mysqli_fetch_array($result)) {
                                echo "<option value='".$row[0]."'>".$row[1]."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <?php
                        mysqli_free_result($result);
                        mysqli_close($link);
                    ?>
                    <div class="mb-3">
                        <label for="NombreProducto" class="form-label" style="color: rgb(97, 47, 0); font-weight: bold;">Nombre del Producto</label>
                        <input require type="text" class="form-control form-control-lg" placeholder="Nombre del Producto" name="NombreProducto" id="NombreProducto">
                    </div>
                    <div class="mb-3">
                        <label for="Descripcion" class="form-label" style="color: rgb(97, 47, 0); font-weight: bold;">Descripción</label>
                        <input require type="text"x|x| class="form-control form-control-lg" placeholder="Descripción" name="Descripcion" id="Descripcion">
                    </div>
                    <div class="mb-3">
                        <label for="Receta" class="form-label" style="color: rgb(97, 47, 0); font-weight: bold;">Receta</label>
                        <input require type="text" class="form-control form-control-lg" placeholder="Receta" name="Receta" id="Receta">
                    </div>
                    <div class="mb-3">
                        <label for="Precio" class="form-label" style="color: rgb(97, 47, 0); font-weight: bold;">Precio</label>
                        <input require type="number" class="form-control form-control-lg" placeholder="Precio" name="Precio" id="Precio">
                    </div>
                    <div class="mb-3">
                        <label for="Precio" class="form-label" style="color: rgb(97, 47, 0); font-weight: bold;">Imagen</label>
                        <input require type="file" class="form-control form-control-lg" placeholder="Precio" name="Imagen" id="Imagen" value="Subir Foto" accept="image/*">
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <input type="submit" href="#" class="btn btn-primary" value="Grabar" style="background-color: #262626; border-color: #363636e6; font-weight: bold;color:#eee;width: auto;">
                    <input type="reset" class="btn btn-primary" value="Limpiar" style="background-color: rgb(79, 46, 9); border-color: rgb(79, 46, 9); font-weight: bold;color:#eee;width: auto;" >
                    <a href="platillos.php" class="btn btn-primary" style="background-color: rgb(79, 46, 9); border-color: rgb(79, 46, 9); font-weight: bold;">Volver</a>    
                </div>
            </form>
        </div>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript">
</body>
</html>
