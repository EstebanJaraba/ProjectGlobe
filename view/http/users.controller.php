<?php

require_once 'db/conexion.php';

if ($_POST['accion'] == 'registerUsers') {
   $name = $_POST['name'];
   $last_name = $_POST['last_name'];
   $document = $_POST['document'];
   $email = $_POST['email'];
   $phone = $_POST['phone'];
   $password = $_POST['password'];
   $role = $_POST['role'];
   $state = $_POST['state'];

   $query = "INSERT INTO users(userName,last_name,document,email,phone,passwordUser,idRole,stateUser) VALUE ('$name','$last_name','$document','$email','$phone','$password','$role','$state')";

   $file =  mysqli_query($conexion, $query);

   if ($file) {
      echo json_encode('ok');
   } else {
      echo json_encode('error');
   }
}

if (trim($_POST['accion']) == 'select_ListUsers') {

   $respuesta = new stdClass();

   $cadena = "SELECT * FROM users";


   $result = mysqli_query($conexion, $cadena);

   $elementos = [];
   $i = 1;
   while ($datos = mysqli_fetch_array($result)) {
      array_push($elementos, ['idUser' => $datos["idUser"], 'userName' => $datos["userName"], 'last_name' => $datos["last_name"], 'document' => $datos["document"], 'email' => $datos["email"], 'phone' => $datos["phone"], 'passwordUser' => $datos["passwordUser"], 'idRole' => $datos["idRole"], 'stateUser' => $datos["stateUser"]]);
      $i++;
   }
   $respuesta->registros = $elementos;

   echo json_encode($respuesta);
}



if ($_POST['accion'] == 'updateUser') {

   $id = $_POST['id'];
   $name = $_POST['name'];
   $last_name = $_POST['last_name'];
   $document = $_POST['document'];
   $email = $_POST['email'];
   $phone = $_POST['phone'];
   $password = $_POST['password'];
   $role = $_POST['role'];
   $state = $_POST['state'];



   $query = "UPDATE users SET userName = '$name', last_name = '$last_name', document = '$document', email = '$email', phone = '$phone', passwordUser = '$password', idRole = '$role', stateUser = '$state' WHERE idUser = '$id'";

   $file =  mysqli_query($conexion, $query);

   if ($file) {
      echo json_encode('ok');
   } else {
      echo json_encode('error');
   }
}

if ($_POST['accion'] == 'anularUser') {
   $id = $_POST['id'];

   $query = "UPDATE users SET stateUser = '0' WHERE idUser = '$id'";

   $file =  mysqli_query($conexion, $query);

   if ($file) {
      echo json_encode('ok');
   } else {
      echo json_encode('error');
   }
}
