<?php

require_once 'db/conexion.php';

if ($_POST['accion'] == 'registerPurchase') {
    $name = $_POST['name'];
    $dateEntrega = $_POST['dateEntrega'];
    $datePedido = $_POST['datePedido'];
    $idProveedor = $_POST['idProveedor'];
    $idInsumo = $_POST['idInsumo'];
    $dateExpiracion = $_POST['dateExpiracion'];
    $state = $_POST['state'];

    $query = "INSERT INTO purchases(name,billingAddress,mailingAddress,idSupplier,idSupply,espirationDate,statePurchase) VALUE ('$name','$dateEntrega','$datePedido','$idProveedor','$idInsumo','$dateExpiracion','$state')";

    $file =  mysqli_query($conexion, $query);

    if ($file) {
        echo json_encode('ok');
    } else {
        echo json_encode('error');
    }
}

if (trim($_POST['accion']) == 'select_ListPurchases') {

    $respuesta = new stdClass();
    $cadena = "SELECT * FROM purchases";
    // $cadena = "SELECT comp.idPurchase,
    //                     comp.name,
    //                     comp.billingAddress,
    //                     comp.milingAddress,
    //                     sup.idSupplier,
    //                     supl.idSupply,
    //                     comp.espirationDate,
    //                     comp.statePurchase
    //                 FROM purchases as comp
    //                 inner join suppliers as sup
    //                 on comp.idSupplier = sup.idSupplier
    //                 inner join supplys as supl
    //                 on comp.idSupply = supl.idSupply";

    $result = mysqli_query($conexion, $cadena);

    $elementos = [];
    $i = 1;
    while ($datos = mysqli_fetch_array($result)) {
        array_push($elementos, ['idPurchase' => $datos["idPurchase"], 'idSupplier' => $datos["idSupplier"],'idSupply' => $datos["idSupply"], 'description' => $datos["description"], 'price' => $datos["price"], 'statePurchase' => $datos["statePurchase"]]);
        $i++;
    }
    $respuesta->registros = $elementos;

    echo json_encode($respuesta);
}


if ($_POST['accion'] == 'updatePurchase') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $dateEntrega = $_POST['dateEntrega'];
    $datePedido = $_POST['datePedido'];
    $idProveedor = $_POST['idProveedor'];
    $idInsumo = $_POST['idInsumo'];
    $dateExpiracion = $_POST['dateEspiration'];
    $state = $_POST['state'];
    

    $query = "UPDATE purchases SET name='$name', billingAddress='$dateEntrega', mailingAddress='$datePedido',idSupplier='$idProveedor',idSupply='$idInsumo',espirationDate = '$dateExpiracion',statePurchase='$state' WHERE idPurchase = '$id'";
    

    $file =  mysqli_query($conexion, $query);

    if ($file) {
        echo json_encode('ok');
    } else {
        echo json_encode('error');
    }
}

if ($_POST['accion'] == 'anularPurchase') {
    $id = $_POST['id'];

    $query = "UPDATE purchases SET statePurchase = '3' WHERE idPurchase = '$id'";

    $file =  mysqli_query($conexion, $query);

    if ($file) {
        echo json_encode('ok');
    } else {
        echo json_encode('error');
    }
}