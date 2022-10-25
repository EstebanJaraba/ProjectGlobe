<?php

require_once 'db/conexion.php';

if ($_POST['accion'] == 'registrarCompra') {
    $factura = $_POST['factura'];
    $total = $_POST['total'];
    $proveedor = $_POST['proveedor'];
    $description = $_POST['description'];


    $query = "INSERT INTO purchases(id_invoice,amount_total,id_supplier,description_supplier) VALUE ('$factura','$total','$proveedor','$description','1')";

    $file =  mysqli_query($conexion, $query);

    if ($file) {
        echo json_encode('ok');
    } else {
        echo json_encode('error');
    }
}

if (trim($_POST['accion']) == 'listaProducto') {

    $respuesta = new stdclass();

    $cadena = "SELECT * FROM supplys";

    $resultado = mysqli_query($conexion, $cadena);

    $elementos = [];
    $i = 1;

    while ($datos = mysqli_fetch_array($resultado)) {

        array_push(
            $elementos,
            [
                'id' => $datos["idSupply"],
                'nombre' => $datos["nameSupply"]         
            ]);
        $i++;
    }
    $respuesta->registros = $elementos;
    echo json_encode($respuesta);
}
// if (trim($_POST['accion']) == 'select_ListPurchases') {

//     $respuesta = new stdClass();
//     $cadena = "SELECT * FROM purchases";

//     $result = mysqli_query($conexion, $cadena);

//     $elementos = [];
//     $i = 1;
//     while ($datos = mysqli_fetch_array($result)) {
//         array_push($elementos, ['idPurchase' => $datos["idPurchase"], 'idSupplier' => $datos["idSupplier"],'idSupply' => $datos["idSupply"], 'description' => $datos["description"], 'price' => $datos["price"], 'statePurchase' => $datos["statePurchase"]]);
//         $i++;
//     }
//     $respuesta->registros = $elementos;

//     echo json_encode($respuesta);
// }


// if ($_POST['accion'] == 'updatePurchase') {
//     $id = $_POST['id'];
//     $name = $_POST['name'];
//     $dateEntrega = $_POST['dateEntrega'];
//     $datePedido = $_POST['datePedido'];
//     $idProveedor = $_POST['idProveedor'];
//     $idInsumo = $_POST['idInsumo'];
//     $dateExpiracion = $_POST['dateEspiration'];
//     $state = $_POST['state'];
    

//     $query = "UPDATE purchases SET name='$name', billingAddress='$dateEntrega', mailingAddress='$datePedido',idSupplier='$idProveedor',idSupply='$idInsumo',espirationDate = '$dateExpiracion',statePurchase='$state' WHERE idPurchase = '$id'";
    

//     $file =  mysqli_query($conexion, $query);

//     if ($file) {
//         echo json_encode('ok');
//     } else {
//         echo json_encode('error');
//     }
// }

// if ($_POST['accion'] == 'anularPurchase') {
//     $id = $_POST['id'];

//     $query = "UPDATE purchases SET statePurchase = '3' WHERE idPurchase = '$id'";

//     $file =  mysqli_query($conexion, $query);

//     if ($file) {
//         echo json_encode('ok');
//     } else {
//         echo json_encode('error');
//     }
// }