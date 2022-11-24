<?php

require_once 'db/conexion.php';

if ($_POST['accion'] == 'registerSupplys') {
    $name = $_POST['name'];
    $partNumber = $_POST['partNumber'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];


    if ($name == ""  || $partNumber == "" || $quantity == "" || $price == "") {
        echo json_encode('fallo');
    } else if(strlen($name)<= 4){
        echo json_encode('min');
    } else if(!is_numeric($partNumber) || !is_numeric($quantity) || !is_numeric($price)){
        echo json_encode('num');
    }
    else {

        $consulta = "SELECT * FROM supplys WHERE partNumber='$partNumber'";

        $conect = mysqli_query($conexion, $consulta);

        $result = mysqli_num_rows($conect);

        if($result > 0){
            echo json_encode("pa");
        }else{
            $query = "INSERT INTO supplys(nameSupply,partNumber,quantity,price,stateSupply) VALUE ('$name','$partNumber','$quantity','$price','1')";

            $file =  mysqli_query($conexion, $query);
    
            if ($file) {
                echo json_encode('ok');
            } else {
                echo json_encode('error');
            }
        }

        
    }

}

if (trim($_POST['accion']) == 'select_ListSupplys') {

    $respuesta = new stdClass();
    $cadena = "SELECT * FROM supplys";

    $result = mysqli_query($conexion, $cadena);

    $elementos = [];
    $i = 1;
    while ($datos = mysqli_fetch_array($result)) {
        array_push($elementos, ['idSupply' => $datos["idSupply"], 'nameSupply' => $datos["nameSupply"], 'partNumber' => $datos["partNumber"], 'quantity' => $datos["quantity"], 'price' => $datos["price"], 'stateSupply' => $datos["stateSupply"]]);
        $i++;
    }
    $respuesta->registros = $elementos;

    echo json_encode($respuesta);
}


if ($_POST['accion'] == 'updateSupply') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $partNumber = $_POST['partNumber'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $state = $_POST['state'];

    $query = "UPDATE supplys SET nameSupply = '$name', partNumber = '$partNumber',quantity = '$quantity',price = '$price', stateSupply = '$state' WHERE idSupply = '$id'";

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

if ($_POST['accion'] == 'actualizarEstadoActivo') {
    $id = $_POST['id'];
    $estado = $_POST['estado'];
    if ($estado == 1) {
        $varEstado = 0;
    } elseif ($estado == 0) {
        $varEstado = 0;
    }

    $query = "UPDATE supplys SET stateSupply = '0' WHERE idSupply = '$id'";


    $file = mysqli_query($conexion, $query);

    if ($file) {
        echo json_encode('ok');
    } else {
        echo json_encode('error');
    }
}

if ($_POST['accion'] == 'actualizarEstadoInactivo') {
    $id = $_POST['id'];
    $estado = $_POST['estado'];
    if ($estado == 0) {
        $varEstado = 1;
    } else {
    }

    $query = "UPDATE supplys SET stateSupply = '$varEstado' WHERE idSupply = '$id'";



    $file = mysqli_query($conexion, $query);

    if ($file) {
        echo json_encode('ok');
    } else {
        echo json_encode('error');
    }
}

