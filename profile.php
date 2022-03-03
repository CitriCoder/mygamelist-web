<?php 
  session_start();
  include('conDB.php');

    $con= conectame();
    $iduser;

    $query="SELECT * FROM `usuarios` WHERE 1";

    $respuesta= $con->query($query) or die($con->error." error en linea" );
  /*  $cant= $respuesta->num_rows;
    echo $cant;*/
  if(!isset($_SESSION['Email_Login'])) {
    header('location:index.php');
    die();
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap Search icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <link rel = "icon" type = "image/png" href = "img/MGL.png">

    <title>MyGameList</title>
  </head>
  <body>
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
          echo"<a class='btn btn-outline-secdan my-2 my-sm-0 ml-auto mr-2' type='button' href='logout.php'>Cerrar Sesion</a>";
        } else {
          echo"
          <a class='btn btn-outline-secdan my-2 my-sm-0 ml-auto mr-2' type='button' href='login.php'>Login</a>
          <a class='btn btn-outline-secdan my-2 my-sm-0 btl' type='button' href='register.php'>Register</a>";
        }
        ?>
      </div>
    </nav>
    <!-- /Nabvar -->
      <!-- Body -->
    <div class="container-xl p-0" style="background-color: #f1f2da;">
        <div class="container text-justify pb-4">
            <?php 
                $versession = $_SESSION['Email_Login'];

                $query="SELECT * FROM `usuarios` WHERE `email` = '$versession'";
                $respuesta= $con->query($query) or die($con->error." error en linea" );

                while ($item = $respuesta->fetch_assoc()) {
                  $iduser = $item['id'];
                  //echo"<label class='idUser' hidden>$iduser</label>"; //jQuery trucon't 4 xdd
                }

                $query="SELECT * FROM `usuarios` WHERE 1";
                $respuesta= $con->query($query) or die($con->error." error en linea" );

                while ($item = $respuesta->fetch_assoc()) {
                  if ($iduser == 1) {
                    echo 'Usuario: '.$item['username'].' Email: '.$item['email'].' Id: '.$item['id'].' Estado: '.$item['estado'].'<br>';
                  }
                }
                mysqli_data_seek($respuesta,0);
                if($iduser == 1) {
                echo"<br>";       
                $query="SELECT * FROM `usuarios` WHERE `email` = '$versession'";
                $respuesta= $con->query($query) or die($con->error." error en linea" );
                while ($item = $respuesta->fetch_assoc()) {
                    echo 'El usuario seleccionado es: '.$item['username'].'<br>';
                }
                mysqli_data_seek($respuesta,0);
              
            ?>
            <br>
            <form action="temp.php" method="post" enctype="multipart/form-data">
              Select Image File to Upload:
              <input type="file" name="file">
              <input type="text" name="namefile" placeholder="nombre de la img">
              <input type="text" name="descr" placeholder="descripcion">
              <input type="submit" name="submitsus" class="btn btn-secdan" value="Upload">
            </form>
            <?php
              $query="SELECT * FROM `usuarios` WHERE `estado` = 0";
              $respuesta= $con->query($query) or die($con->error." error en linea" );


              echo '
              <form method="post" action="ajax/estado.php">
              <div class="form-group d-inline">
              Desactivar usuarios: <select class="form-control d-inline mt-3 w-50" name="estado">';

              while ($row = $respuesta->fetch_assoc()) {
                echo '<option value="'.$row['id'].'">'.$row['username'].'</option>';
              }
              
              echo '</select></div>
              <button type="submit" class="btn btn-secdan estadoBoton">Desactivar</button>
              </form>
              <br>';
              mysqli_data_seek($respuesta,0);

              //--------------------------------------------------//

              $query="SELECT * FROM `usuarios` WHERE `estado` = 1";
              $respuesta= $con->query($query) or die($con->error." error en linea" );


              echo '
              <form method="post" action="ajax/estado.php">
              <div class="form-group d-inline">
              Activar usuarios: <select class="form-control d-inline mt-3 w-50" name="estado">';

              while ($row = $respuesta->fetch_assoc()) {
                echo '<option value="'.$row['id'].'">'.$row['username'].'</option>';
              }
              
              echo '</select></div>
              <button type="submit" class="btn btn-secdan estadoBoton">Activar</button>
              </form>
              ';
              mysqli_data_seek($respuesta,0);
            }
          ?>
          <!-- Usuario -->
          <?php
            $query="SELECT * FROM `usuarios` WHERE `estado` = 0 AND `id` = $iduser";
            $respuesta= $con->query($query) or die($con->error." error en linea" );
            
            while ($row = $respuesta->fetch_assoc()) {
              echo '<h1 class="pt-2 font-weight-bold" style="color:#ff6666;">'.$row['username'].'</h1>';
            }
            mysqli_data_seek($respuesta,0);
          ?>

          <hr class='d-block' style='height:2px;border-width:0;color:#00303b;background-color:#00303b'>
          <h3 class="pt-5">Mis comentarios:</h3>

          <div class="row">
            <div class="col-md-6 col-12">
              <!--<hr class='d-block' style='height:1px;border-width:0;color:#00303b;background-color:#00303b'>-->
              <?php
                $query="SELECT * FROM `resenia` `r` JOIN `usuarios` `u` ON r.`idusuario` = u.`id`  WHERE u.`id` = '$iduser' AND u.`estado` = 0 AND r.`estado` = 0";
                $respuesta= $con->query($query) or die($con->error." error en linea" );
                while ($row = $respuesta->fetch_assoc()) {

                  comentario($row['username'],$row['comentario'],$row['puntaje'],$row['idjuego'],$iduser);
                }
                mysqli_data_seek($respuesta,0); 


                function comentario($idusu,$comment,$points,$idgame,$iduser){
                  echo"<hr class='d-block' style='height:1px;border-width:0;color:#00303b;background-color:#00303b'>";

                  echo"<strong class='d-inline mr-2' style='color:#ff7777;'>$idusu</strong>";
                  for($index = 0; $index < $points; $index++ ) {
                    echo"<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='#ff7777' class='bi bi-star-fill' viewBox='0 2 18 16'> <path d='M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z'/> </svg>";
                  }
                  //echo"<label class='comentarioEstrella'>a</label>";
                  echo"<p class='text-justify' style='font-size:14px; padding:0px;'>$comment</p>
                  <form method='post' action='ajax/delComment.php'>
                  <input type='text' value='".$idgame."' name='idgame' hidden>
                  <button name='btnmod' class='btn btn-sm btn-secdan btnmod' type='button' data-toggle='modal' data-target='#modalmodificacion' value='$iduser|$idgame'>Modificar</button>
                  <button name='btndel' class='btn btn-sm btn-pinky' type='submit' value='$iduser'>Eliminar</button>
                  </form>
                  ";
                }
              ?>
            </div>
          </div>
          <!-- /Usuario -->
        </div>
        
      <!-- /Body -->
    </div>
    <!-- MODAL -->
    <div class="modal fade" id="modalmodificacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modificar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container w-sm-100 p-2 needs-validation" novalidate>
              <form>
              
              <div class="form-group">
                  <label for="modalcomentario">Comentario</label>
                  <textarea class="form-control w-100 d-inline" name="modalcomentario" id="modalcomentario" placeholder="Deja tu comentario..." maxlength="255" required></textarea>
              </div>

              <?php
                for ( $index = 0; $index < 5; $index++) {
                  echo "<svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='#ff7777' class='bi bi-star estrella$index' viewBox='0 0 16 16'> <path d='M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z'/> </svg>";
                  echo "<svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='#ff7777' class='bi bi-star-fill fullestrella$index' viewBox='0 0 16 16'> <path d='M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z'/> </svg>";
                }
              ?>

            </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-pinky" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-secdan modalSave">Modificar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <script type="text/javascript">
      var puntosPuestos = 0;
      var userGame = "";

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

  $(document).on('click','.modalSave',function(){
    if (puntosPuestos != 0) {
      let comentario = $("#modalcomentario").val();
      let puntuacion = puntosPuestos;
      
      $.ajax({
        //donde
        url:'ajax/modificar.php',
        //tipo peticion envia o recibe
        type:'POST',
        data:{
            comentario:comentario,
            puntuacion:puntuacion,
            userGame:userGame
        
          },
        //si pasa lago bueno
        success:function(response){
          /*let tarea = JSON.parse(response);
          console.log(tarea);*/
          alert("Cargado Exitosamente!");
          location.reload();
          console.log(response);
        }

      });
    } else {
      alert("Por favor, ingrese un puntaje valido");
    }

	});

  $(document).on('click','.btnmod',function(){
    userGame = $(this).val();
    //alert(userGame);
	});



    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
  </body>
</html>