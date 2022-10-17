<?php

require_once 'db/conexion.php';

if ($_POST['accion'] == 'registerSupplys') {
    $name = $_POST['name'];
    $partNumber = $_POST['partNumber'];
    $quantity = $_POST['quantity'];
    $state = $_POST['state'];

    $query = "INSERT INTO supplys(nameSupply,partNumber,quantity,stateSupply) VALUE ('$name','$partNumber','$quantity','$state')";

    $file =  mysqli_query($conexion, $query);

    if ($file) {
        echo json_encode('ok');
    } else {
        echo json_encode('error');
    }
}

if (trim($_POST['accion']) == 'select_ListSupplys') {

    $respuesta = new stdClass();
    $cadena = "SELECT * FROM supplys";

    $result = mysqli_query($conexion, $cadena);

    $elementos = [];
    $i = 1;
    while ($datos = mysqli_fetch_array($result)) {
        array_push($elementos, ['idSupply' => $datos["idSupply"], 'nameSupply' => $datos["nameSupply"], 'partNumber' => $datos["partNumber"], 'quantity' => $datos["quantity"],'stateSupply' => $datos["stateSupply"]]);
        $i++;
    }
    $respuesta->registros = $elementos;

    echo json_encode($respuesta);
}


if ($_POST['accion'] == 'updateSupply') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $partNumber = $_POST['partNumber'];
    $state = $_POST['state'];

    $query = "UPDATE supplys SET nameSupply = '$name', partNumber = '$partNumber', stateSupply = '$state' WHERE idSupply = '$id'";

    $file =  mysqli_query($conexion, $query);

    if ($file) {
        echo json_encode('ok');
    } else {
        echo json_encode('error');
    }
}

if ($_POST['accion'] == 'anularSupply') {
    $id = $_POST['id'];

    $query = "UPDATE supplys SET stateSupply = '0' WHERE idSupply = '$id'";

    $file =  mysqli_query($conexion, $query);

    if ($file) {
        echo json_encode('ok');
    } else {
        echo json_encode('error');
    }
}