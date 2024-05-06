<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top" id="menu">
        <div class="container-fluid">
          <a class="navbar-brand" href="#" style = "margin-left:-70px"><img src="imagenes/IMG_3778 (2).png" alt="" width="80px"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#principal">Inicio</a>
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
                  <li class="nav-item">
                    <a class="nav-link" href="registrar.html">Actualizacion UwU</a>
                  </li>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <article id="principal" class="transition-style" transition-style="in:circle:top-left">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="text-start" style="margin-top: 190px; font-size: 35px; color: #ffffff; background-color: #3f3c3393; max-width: 370px;">Cafeteria <span style="color: #ffee00;">"El Cartero"</span></h2>
                    <h3 class="text-start" style="font-size: 23px; max-width: 550px;margin-top: 10px;color: #ffffff; background-color: #3f3c3393;">"Descubre un lugar donde cada grano de café es tratado con amor y pasión desde su origen hasta tu taza. Sumérgete en una experiencia única donde cada sorbo te transporta a los orígenes del café, donde la dedicación al proceso es una verdadera obra de arte. ¡Bienvenido al lugar donde el amor por el café se convierte en una experiencia inolvidable!"</h3>
                </div>
            </div>
        </div>
    </article>   
        <div class="container" style="padding-top: 100px;padding-bottom:100px" id = "conocenos">
            <div class="row">
                <div class="col-lg-6">
                    <img src="imagenes/IMG_0406.jpeg" class="img-fluid mx-auto " style="max-height: 450px; margin-left: 0;" alt="">
                </div>
                <div class="col-lg-6 text-center">
                    <h2 style="font-size: 45px; margin-top: 40px;"><strong>Conocenos</strong></h2>
                    <h3 style="font-size: 22px; margin-top: 20px;">En cafeteria <strong>El Cartero</strong>, te invitamos a sumergirte en una experiencia gastronómica única que trasciende más allá de la simple degustación de platos. Nuestro equipo comprometido, integrado por apasionados chefs y atentos camareros, trabaja en perfecta armonía para ofrecerte no solo exquisitos platillos, sino también un ambiente cordial y hospitalario que te hará sentir como en casa.</h3>
                    <a class="btn btn-primary" href="#" role="button" style = "font-size:20px;font-family: 'Sedan', sans-serif;background-color:#deb600; border-color:#deb600">Conocer más</a>
                </div>
            </div>
        </div>
        <div class="text-center" id="producto">
            <a class="btn btn-primary" href="#" role="button" style = "font-size:40px;font-family: 'Sedan', sans-serif;background-color:#deb600; border-color:#deb600; margin-top: 350px;padding-right:40px;padding-left:40px"><strong>Menú</strong></a>
        </div>
            <?php
            $host = "localhost";
            $puerto = "3306";
            $usuario = "id21955525_sistemacafe";
            $contrasena = "";
            $baseDatos = "id21955525_sistemacafe";
            $tabla = "compra";

            function Conectarse(){
                global $host, $usuario, $contrasena, $baseDatos, $tabla;

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

            $sql = "SELECT m.NombreProducto, m.Descripcion, m.Precio, m.Foto, SUM(c.Cantidad) AS total_vendido 
                    FROM menus m 
                    INNER JOIN detallecomanda c ON m.IdProducto = c.ProductoId 
                    GROUP BY m.IdProducto 
                    ORDER BY total_vendido DESC 
                    LIMIT 3";

            $link = Conectarse();
            $result =  mysqli_query($link, $sql);
            ?>
            <div class='container-fluid' id = "mn" style = 'background-color:#333;padding:50px'>
            <div class='row align-content-center'>
            <h2 class = "text-aling" style = "color:#deb600; font-size:40px">Selección destacada</h2>
            <?php
            if ($result) {
                $aux = 1;
                while($row = mysqli_fetch_array($result)) {
                    echo "<div class='col-lg-4 col-md-6 col-sm-12 mb-4'>";
                    echo "<div class='card' style = 'height:480px;background-color:#494646cb; color:#fff;font-family: 'Playfair Display', serif;'>";
                    echo "<h2 class='text-center' style = 'color:#deb600;font-size:24px'>Top #".$aux."</h2>";
                    echo "<img src='" . $row["Foto"] . "' class='card-img-top' style='height: 18rem; object-fit: cover;' />";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . $row["NombreProducto"] . "</h5>";
                    echo "<p class='card-text'>" . $row["Descripcion"] . "</p>";
                    echo "<p class='card-text'>Precio: $" . $row["Precio"] . "</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    $aux++;
                }
            }
            echo "</div>";
            echo "</div>";
            mysqli_free_result($result);
            mysqli_close($link);
        ?>
    <footer style = "padding:10px;     font-family: 'Playfair Display', serif;">
        <div class="container aling-content-center">
            <div class="row" id="contactanos">
                <div class="seccion redesSociales" id="sociales">
                    <h2 class="contactar" style ="color : #deb600;"><strong>Redes Sociales</strong></h2><br>
                    <a target="_blank" href="https://www.facebook.com/profile.php?id=100004175324839" target="_blank" class="text-white">
                        <i class="fab fa-facebook fa-2x"></i>
                        <p>Facebook</p>
                    </a>
                    <a href="https://www.instagram.com/elcarteromx/?igsh=NTc4MTIwNjQ2YQ%3D%3D&fbclid=IwAR1FX6zW-n-swLDL8691mshZLwaBa4SlvOmMAn76rQoGGVvacMzSlE9rilI" target="_blank" class="text-white">
                        <i class="fab fa-instagram fa-2x"></i>
                        <p>Instagram</p>
                    </a>
                    <br><h2 class="contactar" style ="color : #deb600;"><strong>Tours:</strong></h2>
                    <a href="https://www.instagram.com/elcarterotours/?igsh=NTc4MTIwNjQ2YQ%3D%3D&fbclid=IwAR2AGDTIMr4PGjwMAzmK7RezWNYxWuDYSIYITPT8JUn0yfcTQEdBYKQq0nY" target="_blank" class="text-white">
                      <i class="fab fa-instagram fa-2x"></i>
                      <p>Instagram</p>
                  </a>
                    <br><h2 class="contactar" style ="color : #deb600;"><strong>LLAMANOS AL:</strong></h2>
                    <p>372-424-0104</p><br>
                    <p>+52-342-105-2935</p><br>
                    <p>+52-342-103-4286</p><br>
                </div>
                <div class="seccion formulario">
                    <form action="">
                        <div class="formulario">
                            <label for="Nombre">Nombre</label>
                            <input required type="text" name="" id="Nombre"><br>
                            <label for="Correo">Correo</label>
                            <input required type="email" id="Correo"><br>
                            <label for="mensaje">Mensaje</label>
                            <input required type="text" id="mensaje"><br>
                            <input type="submit">
                            <input type="reset">
                        </div>
                    </form>
                </div>
                <div class="seccion ubicacion" id="ubicacion" style = "margin-top:50px">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d937.236682121671!2d-103.60163355058141!3d20.010750401055518!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x842588920a87040b%3A0xa70036c900f00d41!2sCAFETERIA%20EL%20CAR TERO!5e0!3m2!1ses!2smx!4v1708447437766!5m2!1ses!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <span class="text-center">Cafeteria el Cartero ft. Missael Valdivia de la Cruz&copy;2024</span>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>