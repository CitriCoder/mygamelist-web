<?php
    session_start();
    include('conDB.php');

    $con= conectame();

    $query="SELECT * FROM `usuarios` WHERE 1";

    $respuesta= $con->query($query) or die($con->error." error en linea" );
  /*  $cant= $respuesta->num_rows;
    echo $cant;*/
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- Bootstrap Search icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    
    <!-- Slick para los carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel = "icon" type = "image/png" href = "img/MGL.png">

    <title>MyGameList</title>
  </head>
  <body>
  <link rel="stylesheet" href="style.css">
    <!-- Navbar -->
    <nav class="navbar navbar-expand navbar-light bg-light" style="box-shadow: 0px 2px 3px #aaaaaa;">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">MyGameList</a>
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link hide" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="browse.php">Browse</a>
            </li>
          </ul>
        <?php
        if(isset($_SESSION['Email_Login'])) {
          echo"
          <a class='btn my-2 my-sm-0 ml-4 mr-2' type='button' href='profile.php'><svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='currentColor' class='bi bi-person-circle' viewBox='0 0 16 16'>
          <path d='M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z'/>
          <path fill-rule='evenodd' d='M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z'/>
          </svg></a>";
        } else {
          echo"
          <a class='btn btn-outline-secdan my-2 ml-4 my-sm-0 mr-2' type='button' href='login.php'>Login</a>
          <a class='btn btn-outline-secdan my-2 my-sm-0 btl' type='button' href='register.php'>Register</a>";
        }
        ?>
      </div>
    </nav>
    <!-- /Nabvar -->

    <div class="container-xl p-0" style="background-color: #f1f2da;">
      <!-- Body -->
      <div class="container pb-2">
        <p class="h4 cat">Agregados Recientemente</p>
        <div class="my-4">
          <div class="container-fluid">
            <div class="responsive row mx-auto">
              <?php
                $query="SELECT * FROM `juegos` ORDER BY `udate` DESC LIMIT 8";
                $respuesta= $con->query($query) or die($con->error." error en linea" );
                $isFirst = false;
                while ($row = $respuesta->fetch_assoc()) {
                  echo'<div class="col">
                    <a href="juego.php?juego='.$row['name'].'">
                    <img src="img/'.$row['fname'].'" class="img-fluid d-block" alt="'.$row['name'].'">
                    <strong class="txtmod">'.$row['name'].'</strong>
                    </a>
                  </div>';
                }
                mysqli_data_seek($respuesta,0);
              ?>
            </div>
          </div>
        </div>

        <p class="h4 cat">Random</p>
        <div class="my-4">
          <div class="container-fluid">
            <div class="responsive row mx-auto">
              <?php
                $query="SELECT * FROM `juegos` ORDER BY RAND() LIMIT 8";
                $respuesta= $con->query($query) or die($con->error." error en linea" );
                $isFirst = false;
                while ($row = $respuesta->fetch_assoc()) {
                  echo'<div class="col">
                  <a href="juego.php?juego='.$row['name'].'">
                  <img src="img/'.$row['fname'].'" class="img-fluid d-block" alt="'.$row['name'].'">
                  <strong class="txtmod">'.$row['name'].'</strong>
                  </a>
                  </div>';
                }
                mysqli_data_seek($respuesta,0);
              ?>
            </div>
          </div>
        </div>
      </div>
      <!-- /Body -->
    </div>
    <!-- Footer -->
    <footer class="p-4">
      <div class="row">
        <div class="hidden-sm hidden-xs col-md-3 text-center">
          <img src="img/blancologo.png" width="90" height="90" alt="">
        </div>
        <div class="col-sm-4 col-md-3 col-xs-12">
          <!-- En resoluciones medianas/grandes. Lista de los elementos -->
          <div class="hidden-xs">
            <div style="width:95%; margin-left:5%; font-size:12px;">
            <strong>DATOS DE CONTACTO:</strong><br><br>
            <strong>Dirección:</strong> Calle 104 y 124. Santa teresita <br>
                <strong>Teléfono:</strong> (02246) 420535 <strong>Fax:</strong> 423529 <br>    
                <strong>E-mail:</strong> eest1lacosta@gmail.com
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- /Footer -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
      $('.responsive').slick({
        dots: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: true,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
              infinite: true,
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              infinite: true,
              arrows: false
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
      });

      /*$(document).on('click','.irjuego',function(){
        window.location = "juego.php?juego=" + $(this).html();
      });*/
    </script>
  </body>
</html>