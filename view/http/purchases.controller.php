<?php

require_once 'db/conexion.php';

if ($_POST['accion'] == 'registrarCompra') {
    $factura = $_POST['factura'];
    $total = $_POST['total'];
    $proveedor = $_POST['proveedor'];
    $insumo = $_POST['insumo'];
    $description = $_POST['description'];
    $cantidad = $_POST['cantidad'];


    $query = "INSERT INTO purchases(id_invoice,amount_total,id_supplier,description,statePurchase) 
    VALUE ('$factura','$total','$proveedor','$description','1')";

    $file =  mysqli_query($conexion, $query);

    if ($file) {

        $newquery = "INSERT INTO purchases_detail(id_invoice,id_supply,amount_product,quantity_detail) 
        VALUE ('$factura','$insumo','$total','$cantidad')";

        $newfile = mysqli_query($conexion,$newquery);

        if($newfile){
            echo json_encode('ok');
        }else{
            echo json_encode('error');
        }
        
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


if (trim($_POST['accion']) == 'seleccionarListaCompra') {

    $respuesta = new stdclass();

    $cadena = "SELECT * FROM purchasing_management";

    $resultado = mysqli_query($conexion, $cadena);

    $elementos = [];
    $i = 1;

    while ($datos = mysqli_fetch_array($resultado)) {

        array_push(
            $elementos,
            [
                'id' => $datos["id_purchasing"],
                'descripcion' => $datos["description_purchasing"],
                'cantidad' => $datos["quantity_purchasing"],
                'valor' => $datos["amount_purchasing"],
                'estado' => $datos["state_purchasing"]               
            ]
        );
        $i++;
    }
    $respuesta->registros = $elementos;
    

    echo json_encode($respuesta);
}

//Listar Proveedores

if (trim($_POST['accion']) == 'listaProveedor') {

    $respuesta = new stdclass();

    $cadena = "SELECT * FROM suppliers";

    $resultado = mysqli_query($conexion, $cadena);

    $elementos = [];
    $i = 1;

    while ($datos = mysqli_fetch_array($resultado)) {

        array_push(
            $elementos,
            [
                'id' => $datos["id_provider"],
                'nombre' => $datos["name_provider"]         
            ]);
        $i++;
    }
    $respuesta->registros = $elementos;
    echo json_encode($respuesta);
}

//Listar Productos

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
                'id' => $datos["id_product"],
                'nombre' => $datos["description_product"]         
            ]);
        $i++;
    }
    $respuesta->registros = $elementos;
    echo json_encode($respuesta);
}

if($_POST['accion'] == 'agregarProducto'){
    $factura = $_POST['factura'];
    $producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    $valorProducto = $_POST['valorProducto'];

    $query = "INSERT INTO purchasing_detail(id_invoice_detail, id_product, amount_product_detail, quantity_purchasing_detail ) VALUE('$factura','$producto','$valorProducto','$cantidad')";

    $file = mysqli_query($conexion,$query);

    if($file){
        echo json_encode('ok');
    }else{
        echo json_encode('error');
    }

}

if (trim($_POST['accion']) == 'seleccionarListaProducto') {

    $respuesta = new stdclass();

    $cadena = "SELECT * FROM purchasing_detail";

    $resultado = mysqli_query($conexion, $cadena);

    $elementos = [];
    $i = 1;

    while ($datos = mysqli_fetch_array($resultado)) {

        array_push(
            $elementos,
            [
                'factura' => $datos["id_invoice_detail"],
                'producto' => $datos["id_product"],
                'valorProducto' => $datos["amount_product_detail"] ,
                'cantidadProducto' => $datos["quantity_purchasing_detail"],
                              
            ]
        );
        $i++;
    }
    $respuesta->registros = $elementos;
    

    echo json_encode($respuesta);
}

//LISTA

if (trim($_POST['accion']) == 'seleccionarLista') {

    $respuesta = new stdclass();

    $cadena = "SELECT * FROM purchases AS p INNER JOIN suppliers AS pr
            ON p.id_supplier = pr.idSupplier";

    $resultado = mysqli_query($conexion, $cadena);

    $elementos = [];
    $i = 1;

    while ($datos = mysqli_fetch_array($resultado)) {

        array_push(
            $elementos,
            [
                'IdFactura' => $datos["id_invoice"],
                'proveedor' => $datos["nameSupplier"],
                'description' => $datos["description"],
                'total' => $datos["amount_total"],
                'estado' => $datos["statePurchase"]               
            ]
        );
        $i++;
    }
    $respuesta->registros = $elementos;
    

    echo json_encode($respuesta);
}

//Cambiar Estado

if($_POST['accion'] == 'actualizarEstadoActivo') {
    $id = $_POST['id'];
    $estado = $_POST['estado'];
    if($estado == 1){
        $varEstado = 0;
    }elseif($estado == 0){
        $varEstado = 0;
    }

    $query = "UPDATE purchasing_management SET state_purchasing = '$varEstado' WHERE id_invoice_purchasing = '$id'";

    $file = mysqli_query($conexion,$query) or die(mysqli_errno($conexion));

    if($file > 0){
        echo json_encode('ok');
    }else{
        echo json_encode('error');
    }
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