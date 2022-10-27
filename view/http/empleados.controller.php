<?php

require_once 'db/conexion.php';

if ($_POST['accion'] == 'registroEmpleado') {
    $documentEmployee = $_POST['documentEmployee'];
    $nameEmployee = $_POST['nameEmployee'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $stateEmployee = $_POST['stateEmployee'];

    $query = "INSERT INTO employees (documentEmployee, nameEmployee, email, phone, stateEmployee) 
    VALUE ('$documentEmployee', '$nameEmployee', '$email', '$phone', '$stateEmployee')";

    $file = mysqli_query($conexion, $query);
     if ($file){
        echo json_encode('ok');
     }else{
        echo json_encode('error');
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
