
<?php

require_once 'db/conexion.php';

if (isset($_POST['access'])) {

    $username =  $_POST['user'];
    $password =  $_POST['pass'];

    if ($username == "") {

        header('location: ../../indexLogin.php?id=0');
    } else if ($password == "") {
        header('location: ../../indexLogin.php?id=1');
    } else {
        $consulta = mysqli_query($conexion, "SELECT * FROM users WHERE userName='$username'");
        $filas = mysqli_num_rows($consulta);
        $buscarpass = mysqli_fetch_array($consulta);

        if (($filas > 0) && (password_verify($password, $buscarpass['passwordUser']))) {
            $query = "SELECT * FROM users AS u INNER JOIN role_management AS r ON u.id_rol = r.id_rol WHERE  userName = '$username'";

            $file = mysqli_query($conexion, $query);

            if (mysqli_num_rows($file) > 0) {
                session_start();
                while ($datos = mysqli_fetch_assoc($file)) {
                    $_SESSION['nombreCompleto'] = $datos['userName'] . " " . $datos['last_name'];
                    $_SESSION['idUser'] = $datos['idUser'];
                    $_SESSION['userName'] = $datos['userName'];
                    $_SESSION['last_name'] = $datos['last_name'];
                    $_SESSION['id_rol'] = $datos['name_rol'];
                    $_SESSION['email'] = $datos['email'];
                    $_SESSION['phone'] = $datos['phone'];
 
                }
                header('location: ../index.php');
            } else if (mysqli_num_rows($file) == 0) {
                header('location: ../../indexLogin.php?id=3');
            }
        } else {
            header('location: ../../indexLogin.php?id=1');
        }
    }
}