<?php

require_once 'db/conexion.php';

if ($_POST['accion'] == 'registerUsers') {
   $name = $_POST['name'];
   $last_name = $_POST['last_name'];
   $document = $_POST['document'];
   $email = $_POST['email'];
   $phone = $_POST['phone'];
   $password = $_POST['password'];

   $pass_encrip = password_hash($password, PASSWORD_DEFAULT);

   $query = "INSERT INTO users(userName,last_name,document,email,phone,passwordUser,id_rol,stateUser) VALUE ('$name','$last_name','$document','$email','$phone','$pass_encrip','0','1')";

   $file =  mysqli_query($conexion, $query);

   if ($file) {
      echo json_encode('ok');
   } else {
      echo json_encode('error');
   }
}