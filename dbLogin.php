<?php
include('conDB.php');
$connection = conectame();
if  (isset($_POST['login'])) {

    $email = $_POST['Email_login'];
    $contraseña = MD5($_POST['Contraseña_login']);


    if($email == "" || $_POST['Contraseña_login'] == null) {
        echo "<script>alert('Por favor, llenar todos los campos')</script>";
    } else {
        $query = "SELECT * FROM `usuarios` WHERE email = '$email' AND `password` = '$contraseña' AND `estado` = 0";
        
        if(!$consulta = $connection->query($query)){
            echo "ERROR: no se pudo ejecutar la consulta!";
        } else {

            $rows = mysqli_num_rows($consulta);

            if($rows == 0){
                echo "<script>alert('Error: los datos no coinciden');</script>";
            }else{
                session_start();
                $_SESSION['Email_Login'] = $email;
                header('location:index.php');
            }
        }
        
    }
}
?>