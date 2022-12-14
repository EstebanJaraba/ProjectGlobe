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

   $pass_encrip = password_hash($password, PASSWORD_DEFAULT);

   if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $consulta = "SELECT document FROM users WHERE document='$document'";
      $consultaCorreo = "SELECT email FROM users WHERE email='$email'";

      $conect = mysqli_query($conexion, $consulta);
      $conect2 = mysqli_query($conexion, $consultaCorreo);

      $result = mysqli_num_rows($conect);
      $result2 = mysqli_num_rows($conect2);

      if ($result > 0) {
         echo json_encode('doc');
      } else if ($result2 > 0) {
         echo json_encode('emailError');
      } else {
         $query = "INSERT INTO users(userName,last_name,document,email,phone,passwordUser,id_rol,stateUser) VALUE ('$name','$last_name','$document','$email','$phone','$pass_encrip','$role','1')";

         $file =  mysqli_query($conexion, $query);

         if ($file) {
            echo json_encode('ok');
         } else {
            echo json_encode('error');
         }
      }
   } else {
      echo json_encode('email');
   }
}

if (trim($_POST['accion']) == 'select_ListUsers') {

   $respuesta = new stdClass();

   $cadena = "SELECT * FROM users AS u INNER JOIN role_management AS r ON u.id_rol = r.id_rol";




   $result = mysqli_query($conexion, $cadena);

   $elementos = [];
   $i = 1;
   while ($datos = mysqli_fetch_array($result)) {
      array_push($elementos, ['idUser' => $datos["idUser"], 'userName' => $datos["userName"], 'last_name' => $datos["last_name"], 'document' => $datos["document"], 'email' => $datos["email"], 'phone' => $datos["phone"], 'id_rol' => $datos["name_rol"], 'stateUser' => $datos["stateUser"]]);
      $i++;
   }
   $respuesta->registros = $elementos;

   echo json_encode($respuesta);
}

if (trim($_POST['accion']) == 'listup') {

   $id = $_POST['id'];

   $respuesta = new stdclass();

   $cadena = "SELECT * FROM users AS u INNER JOIN role_management AS r ON u.id_rol = r.id_rol WHERE idUser = '$id'";

   $result = mysqli_query($conexion, $cadena);


   while ($datos = mysqli_fetch_array($result)) {
      array_push(
         $elementos,
         [
            'idUser' => $datos["idUser"],
            'userName' => $datos["userName"],
            'last_name' => $datos["last_name"],
            'document' => $datos["document"],
            'email' => $datos["email"],
            'phone' => $datos["phone"]
         ]
      );
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

   $pass_encrip = password_hash($password, PASSWORD_DEFAULT);


   $query = "UPDATE users SET userName = '$name', last_name = '$last_name', document = '$document', email = '$email', phone = '$phone', passwordUser = '$pass_encrip', id_rol = '$role', stateUser = '1' WHERE idUser = '$id'";

   $file =  mysqli_query($conexion, $query);

   if ($file) {
      echo json_encode('ok');
   } else {
      echo json_encode('error');
   }
}


if ($_POST['accion'] == 'actualizarEstadoActivo') {
   $id = $_POST['id'];
   $estado = $_POST['estado'];
   if ($estado == 1) {
      $varEstado = 0;
   } elseif ($estado == 0) {
      $varEstado = 0;
   }

   $query = "DELETE FROM users WHERE `users`.`idUser` = $id";

   $file = mysqli_query($conexion, $query);

   if ($file) {
      echo json_encode('ok');
   } else {
      echo json_encode('error');
   }
}
// if ($_POST['accion'] == 'actualizarEstadoInactivo') {
//    $id = $_POST['id'];
//    $estado = $_POST['estado'];
//    if ($estado == 0) {
//       $varEstado = 1;
//    } else {
//    }

//    $query = "UPDATE users SET stateUser = '$varEstado' WHERE idUser = '$id'";



//    $file = mysqli_query($conexion, $query);

//    if ($file) {
//       echo json_encode('ok');
//    } else {
//       echo json_encode('error');
//    }
// }
