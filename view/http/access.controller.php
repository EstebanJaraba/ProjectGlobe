
<?php

require_once 'db/conexion.php';

    if(isset($_POST['access'])){

        $username =  $_POST['user'];
        $password =  $_POST['pass'];

        if($username == ""){

            header('location: ../../indexLogin.php?id=0');
        
        }else if($password == ""){
            header('location: ../../indexLogin.php?id=1');
        }
        
        $query = "SELECT * FROM users  WHERE  userName = '$username' AND passwordUser = '$password'";

        $file = mysqli_query($conexion,$query);

            if(mysqli_num_rows($file) > 0){
                session_start();
                while($datos = mysqli_fetch_assoc($file)){
                    $_SESSION['nombreCompleto']= $datos['userName']." ".$datos['last_name'];
                    $_SESSION['userName']= $datos['userName'];
                    $_SESSION['idRole']= $datos['idRole'];
                    $_SESSION['last_name']= $datos['last_name'];
                    $_SESSION['document']= $datos['document'];
                    $_SESSION['email']= $datos['email'];
                    
                }
                header('location: ../index.php');
            }
    }



