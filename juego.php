<?php
    session_start();
    include('conDB.php');

    $con= conectame();
    $juego = $_GET['juego'];
    $puntaje = 0;
    $yaComentado = "";
    $trucoUsuario;

    $query="SELECT * FROM `juegos` WHERE `name` = '".$juego."'";

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
            <li class="nav-item">
              <a class="nav-link hide" href="index.php">Home</a>
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
      <div class="container pb-2 pt-4 ml-lg-3">
      <h1 class="d-block mb-3 d-inline tituloPuntaje"><?php echo "$juego"; ?> 
      <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#ff7777" class="bi bi-star-fill" viewBox="0 2 18 16">
        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
      </svg> </h1>
        <div class="row">
            <div class="col-md-4 col-12">
                <?php
                    while ($row = $respuesta->fetch_assoc()) {
                      $idJuego = $row['id'];
                      echo'<label class="trucoJuego" hidden>'.$row['id'].'</label>'; //jQuery Truco xdd

                        echo'<img src="img/'.$row['fname'].'" class="img-fluid card-img-top" style="width: 250px; height: 333px;" alt="'.$row['name'].'"> </div>';
                        echo'
                            <div class="col-md-8 col-12 mt-5">
                              <label class="text-justify mt-5 mr-lg-5">'.$row['descr'].'</label>
                        ';
                    }
                    mysqli_data_seek($respuesta,0);     
                ?>
            </div>
            <div class="col-12">
              <h4 class="mt-5">Comentarios:</h4>
            </div>
            <div class="col-md-6 col-12">
              <!--<textarea type="text" class="w-100 d-inline" name="comentarios" id="comentarios" placeholder="Deja tu comentario..."></textarea>-->
              <?php
                if(isset($_SESSION['Email_Login'])) {
                  $mail = $_SESSION['Email_Login'];

                  $query="SELECT * FROM `usuarios` WHERE `email` = '$mail'";
                  $respuesta= $con->query($query) or die($con->error." error en linea" );
                  while ($row = $respuesta->fetch_assoc()) {
                    $trucoUsuario = $row['id'];
                    echo'<label class="trucoUsuario" hidden>'.$row['id'].'</label>'; //jQuery Truco 2 xdd
                  }
                  mysqli_data_seek($respuesta,0);   
                   
                  $query="SELECT * FROM `resenia` `r` JOIN `usuarios` `u` ON r.`idusuario` = u.`id`  WHERE `idjuego` = '$idJuego' AND u.`estado` = 0 AND r.`estado` = 0";
                  $respuesta= $con->query($query) or die($con->error." error en linea" );
                  while ($row = $respuesta->fetch_assoc()) {

                    if($row['email'] == $mail) {
                      $yaComentado = $row['email'];
                      echo'
                      <form>
                        <div class="form-group">
                          <textarea class="form-control w-100 d-inline" name="comentarios" id="exampleFormControlTextarea2 comentariosDisabled" placeholder="Ya has comentado este juego" maxlength="255" disabled></textarea>
                        </div>
                      </form>';
                    }
                  }
                  mysqli_data_seek($respuesta,0); 

                  if($yaComentado != $mail){
                    echo'
                      <form class="needs-validation" novalidate>
                        <div class="form-group">
                          <textarea class="form-control w-100 d-inline" name="comentarios" id="comentarios" placeholder="Deja tu comentario..." maxlength="255" required></textarea>
                        </div>
                      </form>';
                  }

                  $query="SELECT r.`estado` AS `estador` FROM `resenia` `r` JOIN `usuarios` `u` ON r.`idusuario` = u.`id`  WHERE `idjuego` = '$idJuego' AND u.`estado` = 0 AND r.`idusuario` = $trucoUsuario";
                  $respuesta= $con->query($query) or die($con->error." error en linea" );
                  while ($row = $respuesta->fetch_assoc()) {
                    if ($row['estador'] == 1) {
                      $estadoTemp = $row['estador'];
                      echo"<label class='estadoTruco' hidden>$estadoTemp</label>";
                    }
                    
                  }
                  mysqli_data_seek($respuesta,0); 


                } else {
                  echo'
                  <form>
                    <div class="form-group">
                      <textarea class="form-control w-100 d-inline" name="comentarios" id="exampleFormControlTextarea2 comentariosDisabled" placeholder="Inicia sesión para comentar" maxlength="255" disabled></textarea>
                    </div>
                  </form>';
                }

                $query="SELECT * FROM `resenia` `r` JOIN `usuarios` `u` ON r.`idusuario` = u.`id`  WHERE `idjuego` = '$idJuego' AND u.`estado` = 0 AND r.`estado` = 0";
                $respuesta= $con->query($query) or die($con->error." error en linea" );
                while ($row = $respuesta->fetch_assoc()) {

                  comentario($row['username'],$row['comentario'],$row['puntaje']);
                }
                mysqli_data_seek($respuesta,0); 


                function comentario($iduser,$comment,$points){
                  echo"<hr class='d-block' style='height:1px;border-width:0;color:#00303b;background-color:#00303b'>";

                  echo"<strong class='d-inline mr-2' style='color:#ff7777;'>$iduser</strong>";
                  for($index = 0; $index < $points; $index++ ) {
                    echo"<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='#ff7777' class='bi bi-star-fill' viewBox='0 2 18 16'> <path d='M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z'/> </svg>";
                  }
                  //echo"<label class='comentarioEstrella'>a</label>";
                  echo"<p class='text-justify' style='font-size:14px; padding:0px;'>$comment</p>";
                }

              ?>
            </div>
            <div class="col-md-6 col-12">
              <div class="estrellas d-inline mx-3">
                <?php
                  if(isset($_SESSION['Email_Login']) && $yaComentado != $mail) {
                    for ( $index = 0; $index < 5; $index++) {
                      echo "<svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='#ff7777' class='bi bi-star estrella$index' viewBox='0 0 16 16'> <path d='M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z'/> </svg>";
                      echo "<svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='#ff7777' class='bi bi-star-fill fullestrella$index' viewBox='0 0 16 16'> <path d='M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z'/> </svg>";
                    }
                  }
                ?>
              </div>
              <?php 
                if(isset($_SESSION['Email_Login']) && $yaComentado != $mail) {
                  echo'<button type="button" class="btn btn-secdan comentar">Comentar</button>';
                }
              ?>
              <?php
                $query="SELECT `puntaje` FROM `resenia` WHERE `idjuego` = '$idJuego' AND `estado` = 0";
                $respuesta= $con->query($query) or die($con->error." error en linea" );
                $rowcount=mysqli_num_rows($respuesta);
                //echo"$rowcount";
                //echo"$idJuego";

                while ($row = $respuesta->fetch_assoc()) {
                  $puntaje += $row['puntaje'];
                }

                mysqli_data_seek($respuesta,0); 

                if ($rowcount != 0) {
                  $puntaje = $puntaje / $rowcount;
                  $puntaje = round($puntaje, 2);
                  echo'<label class="trucoPuntaje" hidden>'.$puntaje.'</label>'; //jQuery Truco 3 xdd
                } else {
                  echo'<label class="trucoPuntaje" hidden>n/a</label>';
                }

              ?>
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
      var puntosPuestos = 0;

      $(document).ready(function(){
          //console.log($(".trucoJuego").html());
          //console.log($(".trucoUsuario").html());
          //alert(puntosPuestos);
          $(".tituloPuntaje").append($(".trucoPuntaje").html());
        });

      /*$(document).ready(function(){
        for (let index = 0; index < 5; index++) {
          $(".estrellas").append(
          "<svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='#ff7777' class='bi bi-star estrella0' viewBox='0 0 16 16'> <path d='M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z'/> </svg>"
          );
        }
      });*/

      for (let index = 0; index < 5; index++) {
        $(".fullestrella"+index).hide();
        let gindex = index;
        $(document).on('click', '.estrella'+index+',.fullestrella'+index, function(){
          puntosPuestos = gindex+1;
          //alert((puntosPuestos)+" estrellas");
          while(gindex!=-1){
            //$(".estrella"+gindex).css('background-color','#ff7777');
            $(".estrella"+gindex).hide();
            $(".fullestrella"+gindex).show();
            gindex--;
          }
          gindex = index;
          while(gindex!=4){
            gindex++;
            $(".estrella"+gindex).show();
            $(".fullestrella"+gindex).hide();
            //$(".estrella"+gindex).css('background-color','transparent');
          }

        });
      }

        $(".comentar").click(function(){
          if ($("#comentarios").val() != "" && puntosPuestos != 0) {
            let comentarioTxtarea = $("#comentarios").val();
            let juegoId = $(".trucoJuego").html();
            let usuarioId = $(".trucoUsuario").html();
            if ($(".estadoTruco").html() != "") {
              var estado = $(".estadoTruco").html();
            } else {
              var estado = 0;
            }

            //alert(comentarioTxtarea);

            $.ajax({
              //donde
              url:'ajax/comentar.php',
              //tipo peticion envia o recibe
              type:'POST',
              data:{
                puntosPuestos:puntosPuestos,
                comentarioTxtarea:comentarioTxtarea,
                juegoId:juegoId,
                usuarioId:usuarioId,
                estado:estado
              
              },
              //si pasa lago bueno
              success:function(/*response*/){
                /*let tarea = JSON.parse(response);
                console.log(tarea);*/
                alert("Agregado exitosamente!");
                location.reload();
              }	
            });
          } else {
            alert("Por favor, complete todos los campos para comentar");
          }
        });
        
        /*$(".estrella"+index).click(function(){
          alert((gindex+1)+" estrellas");
          while(gindex!=-1){
            //$(".estrella"+gindex).css('background-color','#ff7777');
            $(".estrella"+gindex).hide();
            $(".fullestrella"+gindex).show();
            gindex--;
          }
          gindex = index;
          while(gindex!=4){
            gindex++;
            $(".estrella"+gindex).show();
            $(".fullestrella"+gindex).hide();
            //$(".estrella"+gindex).css('background-color','transparent');
          }
        });*/
        
      


    </script>
  </body>
</html>