
<?php

require_once 'db/conexion.php';

if ($_POST['accion'] == 'registroCliente') {
    $nameClient = $_POST['nameClient'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $stateClient = $_POST['stateClient'];

    $query = "INSERT INTO clients (nameClient, last_name, email, phone, stateClient) 
    VALUE ('$nameClient', '$last_name', '$email', '$phone', '$stateClient')";

    $file = mysqli_query($conexion, $query);
     if ($file){
        echo json_encode('ok');
     }else{
        echo json_encode('error');
     }
}




if (trim($_POST['accion']) == 'select_listClientes'){
    $respuesta = new stdClass();

    $cadena = "SELECT * FROM  clients";

    $result = mysqli_query($conexion, $cadena);

    $elementos = [];
    $i= 1;

    while ($datos = mysqli_fetch_array($result)) {
        array_push($elementos, ['idClient' => $datos["idClient"], 'nameClient' => $datos["nameClient"], 'last_name' => $datos
        ["last_name"], 'email' => $datos["email"], 'phone' => $datos["phone"], 'stateClient' => $datos["stateClient"]]);
        $i++;

    }

    $respuesta->registros = $elementos;

    echo json_encode($respuesta);

}



if ($_POST['accion'] == 'editarCliente') {
    $idClient = $_POST['idClient'];
    $nameClient = $_POST['nameClient'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $stateClient = $_POST['stateClient'];

    $query = "UPDATE clients SET nameClient = '$nameClient', last_name = '$last_name', email = '$email', phone = '$phone', stateClient = '$stateClient' WHERE idClient = '$idClient'";

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