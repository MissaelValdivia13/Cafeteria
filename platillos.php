<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body>
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
    <?php
        $host = "localhost";
        $puerto = "3306";
        $usuario = "root";
        $contrasena = "";
        $baseDatos = "sistemacafe";
        $tabla = "compra";

        function Conectarse(){
            global $host, $puerto, $usuario, $contrasena, $baseDatos;

            if(!($link = mysqli_connect($host,$usuario,$contrasena,$baseDatos))){
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

        $query = "SELECT m.IdProducto as id, c.Descripcion AS CategoriaDescripcion, m.NombreProducto, m.Descripcion, m.Receta, m.Precio, m.Foto FROM menus as m inner JOIN categoria as c on c.IdCategoria = m.CategoriaId"; 

        $result =  mysqli_query($link, $query);
    ?>  
<div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5" style="color:#eee;background-color:#363636e5;font-family: 'Sedan', sans-serif; serif; margin-top: 140px; margin-left: auto; margin-right: auto; max-width: 80%; padding: 10px;">
    <a href="registrar.php" class="btn btn-primary" style="margin-bottom: 20px; background-color: #000; border-color: #000; color: #deb600;"><strong>Agregar</strong></a>    
    <div class="row">
        <div class="col-sm-12">
            <table id="example" class="table table-striped dataTable" style="width: 100%; color: #eee;" aria-describedby="example_info">
                <thead>
                    <tr>
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 109px;">IdProducto</th>
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 109px;">Descripción</th>
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 109px;">NombreProducto</th>
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 109px;">Descripción</th>
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 109px;">Receta</th>
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 109px;">Precio</th>
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 109px;">Foto</th>          
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 109px;"></th>          
                    </tr>
                </thead>
                <tbody>   
                    <?php
                        $current_page = basename($_SERVER['PHP_SELF']);

                        while($row = mysqli_fetch_array($result)){
                            echo "<tr class='odd'>";
                            echo "<td style = 'color:#eee; font-size: large;' class='sorting_1'>".$row['id']."</td>";
                            echo "<td style = 'color:#eee;font-size: large;'>".$row['CategoriaDescripcion']."</td>";
                            echo "<td style = 'color:#eee;font-size: large;'>".utf8_encode($row['NombreProducto'])."</td>"; 
                            echo "<td style = 'color:#eee;font-size: large;'>".utf8_encode($row['Descripcion'])."</td>"; 
                            echo "<td style = 'color:#eee;font-size: large;'>".utf8_encode($row['Receta'])."</td>";
                            echo "<td style = 'color:#eee;font-size: large;'>".$row['Precio']."</td>";
                            echo '<td><img src="' . $row['Foto'] . '" /></td>';
                            // Verificar si la página actual es platillos.php
                            if ($current_page === 'platillos.php') {
                                echo '<td><a class="btn btn-primary" href="editar.php?id=' . $row['id'] . '&categoriaDescripcion=' . $row['CategoriaDescripcion'] . '&nombreProducto=' . $row['NombreProducto'] . '&Descripcion=' . $row['Descripcion'] . '&receta=' . $row['Receta'] . '&precio=' . $row['Precio'] . '" style="background-color: #000; border-color: #000; margin-top: 20px; color: #deb600;"><strong>Editar</strong></a></td>';
                            } else {
                                echo '<td><a class="btn btn-primary" href="editar.php?id=' . $row['id'] . '&categoriaDescripcion=' . $row['CategoriaDescripcion'] . '&nombreProducto=' . $row['NombreProducto'] . '&Descripcion=' . $row['Descripcion'] . '&receta=' . $row['Receta'] . '&precio=' . $row['Precio'] . '&nombreArchivo=platillos.php" style="background-color: rgb(79, 46, 9); border-color: rgb(79, 46, 9); margin-top: 20px; color: #deb600;"><strong>Editar</strong></a></td>';
                            }
                            
                            echo "</tr>";
                        }

                        mysqli_free_result($result);
                        mysqli_Close($link);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="container">
      <div class="row">
        <div>
        <a  href= "generarcsv.php" type="button" class="btn btn-secondary">Generar csv</a>
        <a  href= "generarxml.php" type="button" class="btn btn-secondary" style ="margin-left:30px">Generar XML</a>
        </div>
      </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>
</html>