<?php

require_once 'db/conexion.php';

// if ($_POST['accion'] == 'upAccount') {
//     $id = $_POST['id'];
//     $name = $_POST['name'];
//     $last_name = $_POST['last_name'];
//     $document = $_POST['document'];
//     $email = $_POST['email'];
//     $phone = $_POST['phone'];
//     $role = $_POST['role'];

//     $query = "UPDATE users SET userName = '$name', last_name = '$last_name', document = '$document', email = '$email', phone = '$phone',id_rol = '$role', stateUser = '1' WHERE idUser = '$id'";

//     $file =  mysqli_query($conexion, $query);

//     if ($file) {
//         echo json_encode('ok');
//     } else {
//         echo json_encode('error');
//     }
// }

if ($_POST['accion'] = 'updatePass') {

    $id = $_POST['id'];
    $contraseña = $_POST['pass'];

    $encriptar = password_hash($contraseña, PASSWORD_DEFAULT);

    $query = "UPDATE users SET passwordUser = '$encriptar' WHERE idUser = '$id'";

    $file = mysqli_query($conexion, $query);

    if ($file) {
        echo json_encode('ok');
    } else {
        echo json_encode('error');
    }
}
