<?php

require_once 'db/conexion.php';

if ($_POST['accion'] == 'registrarCompra') {
    $factura = $_POST['factura'];
    $total = $_POST['total'];
    $proveedor = $_POST['proveedor'];
    $insumo = $_POST['insumo'];
    $description = $_POST['description'];
    $cantidad = $_POST['cantidad'];
    $arreglo = $_POST['arreglo'];

    $consulta = "SELECT * FROM purchases WHERE id_invoice='$factura' AND statePurchase = '1'";

    $conect = mysqli_query($conexion, $consulta);

    $result = mysqli_num_rows($conect);

    if ($result > 0) {
        echo json_encode("fac");
    } else {
        $query = "INSERT INTO purchases(id_invoice,amount_total,id_supplier,description,statePurchase) 
        VALUE ('$factura','$total','$proveedor','$description','1')";

        $file =  mysqli_query($conexion, $query);

        if ($file) {

            $newquery = '';
            $newfile = false;

            for ($i = 0; count($arreglo) > $i; $i++) {
                $newquery = "INSERT INTO purchases_detail(id_invoice,id_supply,amount_product,quantity_detail) VALUE ('$factura','" . $arreglo[$i]['productoId'] . "', '" . $arreglo[$i]['valorTotal'] . "','" . $arreglo[$i]['cantidad'] . "')";
                $newfile = mysqli_query($conexion, $newquery);

                $aumentar = "SELECT SUM(quantity_detail) AS quantity FROM purchases_detail WHERE id_supply = " . $arreglo[$i]['productoId'] . "";

                $filesSum = mysqli_query($conexion, $aumentar);


                while ($array = mysqli_fetch_array($filesSum)) {
                    $quantitySuma = $array["quantity"];

                    $queryUp = "UPDATE supplys SET quantity=$quantitySuma WHERE idSupply= " . $arreglo[$i]['productoId'] . "";
                    $fileUp = mysqli_query($conexion, $queryUp);
                }
            }
            if ($fileUp) {
                echo json_encode('ok');
            }
        } else {
            echo json_encode('error');
        }
    }
}

if (trim($_POST['accion']) == 'insumoPurchase') {

    $respuesta = new stdclass();

    $cadena = "SELECT * FROM supplys WHERE stateSupply='1'";

    $resultado = mysqli_query($conexion, $cadena);

    $elementos = [];
    $i = 1;

    while ($datos = mysqli_fetch_array($resultado)) {

        array_push(
            $elementos,
            [
                'id' => $datos["idSupply"],
                'nombre' => $datos["nameSupply"],
                'price' => $datos['price']
            ]
        );
        $i++;
    }
    $respuesta->registros = $elementos;
    echo json_encode($respuesta);
}
if (trim($_POST['accion']) == 'proveedorPurchase') {

    $respuesta = new stdclass();

    $cadena = "SELECT * FROM suppliers WHERE stateSupplier='1'";

    $resultado = mysqli_query($conexion, $cadena);

    $elementos = [];
    $i = 1;

    while ($datos = mysqli_fetch_array($resultado)) {

        array_push(
            $elementos,
            [
                'id' => $datos["idSupplier"],
                'nombre' => $datos["nameSupplier"],
            ]
        );
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
            ]
        );
        $i++;
    }
    $respuesta->registros = $elementos;
    echo json_encode($respuesta);
}

if (trim($_POST['accion']) == 'seleccionarListaProducto') {

    $respuesta = new stdclass();

    $cadena = "SELECT * FROM purchases_detail";

    $resultado = mysqli_query($conexion, $cadena);

    $elementos = [];
    $i = 1;

    while ($datos = mysqli_fetch_array($resultado)) {

        array_push(
            $elementos,
            [
                'iddetail' => $datos["id_detail"],
                'factura' => $datos["id_invoice"],
                'producto' => $datos["id_supply"],
                'valorProducto' => $datos["amount_product"],
                'cantidadProducto' => $datos["quantity_detail"],

            ]
        );
        $i++;
    }
    $respuesta->registros = $elementos;


    echo json_encode($respuesta);
}

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

// if ($_POST['accion'] == 'actualizarEstadoActivo') {
//     $id = $_POST['id'];
//     $estado = $_POST['estado'];
//     if ($estado == 1) {
//         $varEstado = 0;
//     } elseif ($estado == 0) {
//         $varEstado = 0;
//     }

//     $query = "UPDATE purchases SET statePurchase = '$varEstado' WHERE id_invoice = '$id'";



//     $file = mysqli_query($conexion, $query);

//     if ($file) {
//         echo json_encode('ok');
//     } else {
//         echo json_encode('error');
//     }
// }


if ($_POST['accion'] == 'actualizarEstadoActivo') {
    $id = $_POST['id'];
    $estado = $_POST['estado'];
    if ($estado == 1) {
        $varEstado = 0;
    } elseif ($estado == 0) {
        $varEstado = 0;
    };

    $query = "UPDATE purchases SET statePurchase = '$varEstado' WHERE id_invoice = '$id'";

    $file = mysqli_query($conexion, $query) or die(mysqli_errno($conexion));

    if ($file > 0) {
        $queryInsumos = "SELECT id_supply  FROM `purchases_detail` WHERE id_invoice = $id;";

        $fileInsumos = mysqli_query($conexion, $queryInsumos);

        if ($fileInsumos) {

            $queryEliminarDetalle = "DELETE FROM purchases_detail WHERE id_invoice = '$id'";

            $fileDetailEliminar = mysqli_query($conexion, $queryEliminarDetalle);

            while ($arregloInsumoss = mysqli_fetch_array($fileInsumos)) {

                $Insumos = $arregloInsumoss['id_supply'];

                $querySuma = "SELECT SUM(quantity_detail) AS quantity FROM `purchases_detail` WHERE id_supply = '$Insumos'";

                $fileDetailSuma = mysqli_query($conexion, $querySuma);

                while ($arraySuma = mysqli_fetch_array($fileDetailSuma)) {

                    $quantity_suma = $arraySuma["quantity"];

                    if (empty($quantity_suma)) {
                        $queryActualizarCantidad = "UPDATE supplys SET quantity = 0 WHERE idSupply = '$Insumos'";

                        $fileDetailActualiza = mysqli_query($conexion, $queryActualizarCantidad);
                    } else {

                        $queryActualizarCantidad = "UPDATE supplys SET quantity = $quantity_suma WHERE idSupply = '$Insumos'";

                        $fileDetailActualiza = mysqli_query($conexion, $queryActualizarCantidad);
                    }
                };
            };

            echo json_encode('ok');
        } else {
            echo json_encode('error al sumar');
        }
    } else {
        echo json_encode('error al entrar al eliminar');
    };
};


if ($_POST['accion'] == 'actualizarEstadoInactivo') {
    $id = $_POST['id'];
    $estado = $_POST['estado'];
    if ($estado == 0) {
        $varEstado = 1;
    } else {
    }

    $query = "UPDATE purchases SET statePurchase = '$varEstado' WHERE id_invoice = '$id'";



    $file = mysqli_query($conexion, $query);

    if ($file) {
        echo json_encode('ok');
    } else {
        echo json_encode('error');
    }
}

if (trim($_POST['accion']) == 'seleccionarListaInsumos') {
    $IdFactura = $_POST['id'];
    $respuesta = new stdclass();

    $cadena = "SELECT * FROM purchases_detail AS p INNER JOIN supplys AS pr
            ON p.id_supply = pr.idSupply WHERE id_invoice='$IdFactura'";

    $resultado = mysqli_query($conexion, $cadena);

    $elementos = [];
    $i = 1;

    while ($datos = mysqli_fetch_array($resultado)) {

        array_push(
            $elementos,
            [
                'insumo' => $datos["nameSupply"],
                'cantidad' => $datos["quantity_detail"],
                'total' => $datos["amount_product"],
            ]
        );
        $i++;
    }
    $respuesta->registros = $elementos;


    echo json_encode($respuesta);
}
