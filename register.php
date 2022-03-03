<?php include("dbRegister.php"); ?>
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
    <nav class="navbar navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">MyGameList</a>
      </div>
    </nav>
    <!-- /Nabvar -->

    <!-- Register -->
    <div class="container bg-light mt-5 w-sm-100 p-2 logmarg needs-validation" novalidate>
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
          <label for="registerUsername">Username</label>
          <input type="text" name="Usuario_Register" class="form-control" id="registerUsername" required>
        </div>
        <div class="form-group">
          <label for="registerEmail">Email address</label>
          <input type="email" name="Email_Register" class="form-control" id="registerEmail" aria-describedby="emailHelp" required>
        </div>
        <div class="form-group">
          <label for="registerPass">Password</label>
          <input type="password" name= "Contraseña_Register"  class="form-control" id="registerPass" required>
        </div>
        <div class="form-group">
          <label for="registerConfirmPass">Confirm password</label>
          <input type="password" name= "Conf_Contraseña" class="form-control" id="registerConfirmPass" required>
        </div>
        <button type="submit" name ="register" value="register" class="btn btn-outline-secdan">Submit</button>
        <a href="login.php" class="lnkcuenta">¿Ya tienes cuenta?</a>
      </form>
    </div>
    <!-- /Register -->
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
  </body>
</html>