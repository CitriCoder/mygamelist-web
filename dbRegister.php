<?php
include('conDB.php');
$connection = conectame();
if  (isset($_POST['register'])) {

    $email = $_POST['Email_Register'];
    $usuario = $_POST['Usuario_Register'];
    $contraseña = MD5($_POST['Contraseña_Register']);
    $confContraseña = MD5($_POST['Conf_Contraseña']);

    
    if($usuario == "" || $_POST['Contraseña_Register'] == null || $_POST['Conf_Contraseña'] == null || $email == "") {
        echo "<script>alert('Por favor, llenar todos los campos')</script>";
    } else if($_POST['Contraseña_Register'] != $_POST['Conf_Contraseña']) {
        echo"<script>alert('Las contraseñas no coinciden')</script>";
    } else {
        $query = "SELECT * FROM `usuarios` WHERE email = '$email' OR username = '$usuario'";
        
        if(!$consulta = $connection->query($query)){
            echo "ERROR: no se pudo ejecutar la consulta!";
        } else {

            $rows = mysqli_num_rows($consulta);

            if($rows == 0){
                $query = "INSERT INTO `usuarios` (`id`, `username`, `email`, `password`) VALUES (NULL, '$usuario', '$email', '$contraseña')";
                mysqli_query($connection,$query);
                session_start();
                $_SESSION['Email_Login'] = $email;
                echo "<script>alert('Registrado exitosamente');</script>";
                header('location:index.php');
            }else{
                echo "<script>alert('Error: usuario y/o email ya utilizados');</script>";
            }
        }
        
    }
}
?>