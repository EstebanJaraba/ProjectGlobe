<?php

require_once 'db/conexion.php';

if ($_POST['accion'] == 'registroEmpleado') {
    $documentEmployee = $_POST['documentEmployee'];
    $nameEmployee = $_POST['nameEmployee'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $stateEmployee = $_POST['stateEmployee'];


   if ($documentEmployee == "" || $nameEmployee == "" || $email == "" || $phone == "") {
      echo json_encode('fallo');
   }else if (strlen($documentEmployee) <= 9 || !is_numeric($documentEmployee)){
      echo json_encode('max');
   }else if(strlen($phone) <= 9 || strlen($phone) > 15 || !is_numeric($phone)){
      echo json_encode('max2');
   }else if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $consulta = "SELECT documentEmployee FROM employees WHERE documentEmployee='$documentEmployee'";
      $consultaCorreo = "SELECT email FROM employees WHERE email='$email'";

      $conect = mysqli_query($conexion, $consulta);
      $conect2 = mysqli_query($conexion, $consultaCorreo);

      $result = mysqli_num_rows($conect);
      $result2 = mysqli_num_rows($conect2);

      if ($result > 0) {
         echo json_encode('doc');
      } else if ($result2 > 0) {
         echo json_encode('emailError');
      } else {
         $query = "INSERT INTO employees (documentEmployee, nameEmployee, email, phone, stateEmployee) 
         VALUE ('$documentEmployee', '$nameEmployee', '$email', '$phone', '$stateEmployee')";

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

if (trim($_POST['accion']) == 'select_listEmpleados'){
    $respuesta = new stdClass();

    $cadena = "SELECT * FROM  employees";

    $result = mysqli_query($conexion, $cadena);

    $elementos = [];
    $i= 1;

    while ($datos = mysqli_fetch_array($result)) {
        array_push($elementos, ['idEmployee' => $datos["idEmployee"], 'documentEmployee' => $datos["documentEmployee"], 
        'nameEmployee' => $datos["nameEmployee"], 'email' => $datos["email"], 'phone' => $datos["phone"], 'stateEmployee' => $datos["stateEmployee"]]);
        $i++;

    }

    $respuesta->registros = $elementos;

    echo json_encode($respuesta);

}

if ($_POST['accion'] == 'editarEmpleado') {
    $idEmployee = $_POST['idEmployee'];
    $documentEmployee = $_POST['documentEmployee'];
    $nameEmployee = $_POST['nameEmployee'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $stateEmployee = $_POST['stateEmployee'];

    $query = "UPDATE employees SET documentEmployee = '$documentEmployee', nameEmployee = '$nameEmployee', email = '$email', phone = '$phone', stateEmployee = '$stateEmployee' WHERE idEmployee = '$idEmployee'";

    $file = mysqli_query($conexion, $query);
     if ($file){
        echo json_encode('ok');
     }else{
        echo json_encode('error');
     }
}

if ($_POST['accion'] == 'anularEmpleado') {

    $idEmployee = $_POST['idEmployee'];
    
    $query = "UPDATE employees SET stateEmployee = '0' WHERE idEmployee = '$idEmployee'";

    $file = mysqli_query($conexion, $query);
     if ($file){
        echo json_encode('ok');
     }else{
        echo json_encode('error');
     }
}
