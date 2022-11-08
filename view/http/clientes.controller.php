
<?php

require_once 'db/conexion.php';

if ($_POST['accion'] == 'registroCliente') {
    $documentClient = $_POST['documentClient'];
    $nameClient = $_POST['nameClient'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $stateClient = $_POST['stateClient'];


   if ($documentClient == "" || $nameClient == "" || $last_name == "" || $email == "" || $address == "" || $phone == "") {
      echo json_encode('fallo');
   }else if (strlen($documentClient) <= 9 || !is_numeric($documentClient)){
      echo json_encode('max');
   }else if(strlen($phone) <= 9 || strlen($phone) > 15 || !is_numeric($phone)){
      echo json_encode('max2');
   }else if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $consulta = "SELECT documentClient FROM clients WHERE documentClient='$documentClient'";
      $consultaCorreo = "SELECT email FROM clients WHERE email='$email'";

      $conect = mysqli_query($conexion, $consulta);
      $conect2 = mysqli_query($conexion, $consultaCorreo);

      $result = mysqli_num_rows($conect);
      $result2 = mysqli_num_rows($conect2);

      if ($result > 0) {
         echo json_encode('doc');
      } else if ($result2 > 0) {
         echo json_encode('emailError');
      } else {
         $query = "INSERT INTO clients (documentClient, nameClient, last_name, email, address, phone, stateClient) 
         VALUE ('$documentClient', '$nameClient', '$last_name', '$email', '$address', '$phone', '$stateClient')";

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




if (trim($_POST['accion']) == 'select_listClientes'){
    $respuesta = new stdClass();

    $cadena = "SELECT * FROM  clients";

    $result = mysqli_query($conexion, $cadena);

    $elementos = [];
    $i= 1;

    while ($datos = mysqli_fetch_array($result)) {
        array_push($elementos, ['idClient' => $datos["idClient"], 'documentClient' => $datos["documentClient"], 'nameClient' => $datos["nameClient"], 'last_name' => $datos
        ["last_name"], 'email' => $datos["email"], 'address' => $datos["address"], 'phone' => $datos["phone"], 'stateClient' => $datos["stateClient"]]);
        $i++;

    }

    $respuesta->registros = $elementos;

    echo json_encode($respuesta);

}



if ($_POST['accion'] == 'editarCliente') {
    $idClient = $_POST['idClient'];
    $documentClient = $_POST['documentClient'];
    $nameClient = $_POST['nameClient'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $stateClient = $_POST['stateClient'];

    $query = "UPDATE clients SET documentClient = '$documentClient', nameClient = '$nameClient', last_name = '$last_name', email = '$email', address = '$address', phone = '$phone', stateClient = '$stateClient' WHERE idClient = '$idClient'";

    $file = mysqli_query($conexion, $query);
     if ($file){
        echo json_encode('ok');
     }else{
        echo json_encode('error');
     }
}



if ($_POST['accion'] == 'anularCliente') {

    $idClient = $_POST['idClient'];
    
    $query = "UPDATE clients SET stateClient = '0' WHERE idClient = '$idClient'";

    $file = mysqli_query($conexion, $query);
     if ($file){
        echo json_encode('ok');
     }else{
        echo json_encode('error');
     }
}