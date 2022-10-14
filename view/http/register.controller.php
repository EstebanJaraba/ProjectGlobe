<?php
if (isset($_POST['Enviar'])) {

    require_once 'db/conexion.php ';

    $name = $_POST['nameUser'];
    $last_name = $_POST['last_nameUser'];
    $document = $_POST['documentUser'];
    $email = $_POST['emailUser'];
    $phone = $_POST['phoneUser'];
    $password = $_POST['passwordUser'];


    $query = "INSERT INTO users(userName,last_name,document,email,phone,passwordUser,id_rol,stateUser) VALUE ('$name','$last_name','$document','$email','$phone','$password','0','1')";

    $file =  mysqli_query($conexion, $query);

    if ($file) {
        echo "<script>alert('Se Insertaron Correctamente')</script>";
    } else {
        echo "<script>alert('Error')</script>";
    }
}
