

<?php

require_once 'db/conexion.php';

if ($_POST['accion'] == 'registrarVenta') {
    $factura = $_POST['factura'];
    $cliente = $_POST['cliente'];
    $servicio = $_POST['servicio'];
    $empleado = $_POST['empleado'];
    $insumo = $_POST['insumo'];
    $cantidad = $_POST['cantidad'];
    $total = $_POST['total'];
    $descriptionSale = $_POST['descriptionSale'];
    $arreglo = $_POST['arreglo'];
    

    $query = "INSERT INTO sales_management (id_invoice, idClient, idService, idEmployee, amount_total_sale, descriptionSale, stateSale) 
    VALUE ('$factura', '$cliente', '$servicio', '$empleado', '$total', '$descriptionSale', '1')";

    $file = mysqli_query($conexion, $query);
    if ($file) {

        $newquery = '';
        $newfile = false;

        for ($i = 0; count($arreglo) > $i; $i++) {
            $newquery = "INSERT INTO sales_detail(id_invoice, idSupply, amount_supply_detail, quantity_sales_detail) 
            VALUE ('$factura', '" . $arreglo[$i]['insumoId'] . "', '" . $arreglo[$i]['valorTotal'] . "','" . $arreglo[$i]['cantidad'] . "')";
            $newfile = mysqli_query($conexion, $newquery);

            $disminuir = "SELECT (-(quantity_sales_detail)) AS quantity FROM sales_detail WHERE idSupply = " . $arreglo[$i]['insumoId'] . "";

            $filesSum = mysqli_query($conexion, $disminuir);


            while ($array = mysqli_fetch_array($filesSum)){
                $quantitySuma = $array["quantity"];

                $queryUp = "UPDATE supplys SET quantity=$quantitySuma WHERE idSupply= ".$arreglo[$i]['insumoId']."";
                $fileUp = mysqli_query($conexion, $queryUp);
            }

            //while ($row = mysqli_fetch_assoc($consultaDetalle)) {
                //$idSupply = $row['insumoId'];
                //$quantity_sales_detail = $row['cantidad'];
                //$amount_supply_detail = $row['valorTotal'];
                //$insertarDet = mysqli_query($conexion, "INSERT INTO sales_detail(idSupply, quantity_sales_detail, amount_supply_detail) 
                //VALUES ($insumoId, $cantidad, '$valorTotal')");
                //$stockActual = mysqli_query($conexion, "SELECT * FROM supplys WHERE idSupply = $idSupply");
                //$stockNuevo = mysqli_fetch_assoc($stockActual);
                //$stockTotal = $stockNuevo['quantity'] - $cantidad;
                //$stock = mysqli_query($conexion, "UPDATE supplys SET quantity = $stockTotal WHERE idSupply = $idSupply");
            //}
        }
        if ($fileUp) {
            echo json_encode('ok');
        }
    }
    
}


if (trim($_POST['accion']) == 'select_listVentas'){
   $respuesta = new stdClass();

   $cadena = "SELECT * FROM  sales_management";

   $result = mysqli_query($conexion, $cadena);

   $elementos = [];
   $i= 1;

   while ($datos = mysqli_fetch_array($result)) {
       array_push($elementos,
       [
         'id' => $datos["id_sale"], 
         'total' => $datos["amount_total_sale"], 
         'stateSale' => $datos["stateSale"]]);
       $i++;

   }

   $respuesta->registros = $elementos;

   echo json_encode($respuesta);

}

//Listar clientes

if (trim($_POST['accion']) == 'listaCliente') {

   $respuesta = new stdclass();

   $cadena = "SELECT * FROM clients";

   $resultado = mysqli_query($conexion, $cadena);

   $elementos = [];
   $i = 1;

   while ($datos = mysqli_fetch_array($resultado)) {

       array_push(
           $elementos,
           [
               'id' => $datos["idClient"],
               'nombre' => $datos["nameClient"]         
           ]);
       $i++;
   }
   $respuesta->registros = $elementos;
   echo json_encode($respuesta);
}

//Listar servicios

if (trim($_POST['accion']) == 'listaServicio') {

    $respuesta = new stdclass();
 
    $cadena = "SELECT * FROM services";
 
    $resultado = mysqli_query($conexion, $cadena);
 
    $elementos = [];
    $i = 1;
 
    while ($datos = mysqli_fetch_array($resultado)) {
 
        array_push(
            $elementos,
            [
                'id' => $datos["idService"],
                'nombre' => $datos["nameService"]         
            ]);
        $i++;
    }
    $respuesta->registros = $elementos;
    echo json_encode($respuesta);
}

//Listar empleados

if (trim($_POST['accion']) == 'listaEmpleado') {

    $respuesta = new stdclass();
 
    $cadena = "SELECT * FROM employees";
 
    $resultado = mysqli_query($conexion, $cadena);
 
    $elementos = [];
    $i = 1;
 
    while ($datos = mysqli_fetch_array($resultado)) {
 
        array_push(
            $elementos,
            [
                'id' => $datos["idEmployee"],
                'nombre' => $datos["nameEmployee"]         
            ]);
        $i++;
    }
    $respuesta->registros = $elementos;
    echo json_encode($respuesta);
 }

//Listar insumos

if (trim($_POST['accion']) == 'listaInsumo') {

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




if (trim($_POST['accion']) == 'select_ListSupplys') {

   $respuesta = new stdclass();

   $cadena = "SELECT * FROM sales_detail";

   $resultado = mysqli_query($conexion, $cadena);

   $elementos = [];
   $i = 1;

   while ($datos = mysqli_fetch_array($resultado)) {

       array_push(
           $elementos,
           [
            'id_detail' => $datos["id_sale_detail"],
            'factura' => $datos["id_invoice"],
            'insumo' => $datos["idSupply"],
            'valorInsumo' => $datos["amount_supply_detail"] ,
            'cantidad' => $datos["quantity_sales_detail"],             
           ]
       );
       $i++;
   }
   $respuesta->registros = $elementos;
   

   echo json_encode($respuesta);
}


if (trim($_POST['accion']) == 'seleccionarLista') {

   $respuesta = new stdclass();

   $cadena = "SELECT * FROM sales_management AS p INNER JOIN clients AS pr
           ON p.idClient = pr.idClient INNER JOIN services AS sr ON p.idService = sr.idService
           INNER JOIN employees AS em ON p.idEmployee = em.idEmployee";

   $resultado = mysqli_query($conexion, $cadena);

   $elementos = [];
   $i = 1;

   while ($datos = mysqli_fetch_array($resultado)) {

       array_push(
           $elementos,
           [
               'idFactura' => $datos["id_invoice"],
               'cliente' => $datos["nameClient"],
               'servicio' => $datos["nameService"],
               'empleado' => $datos["nameEmployee"],
               'total' => $datos["amount_total_sale"],
               'descriptionSale' => $datos["descriptionSale"],
               'stateSale' => $datos["stateSale"],        
           ]
       );
       $i++;
   }
   $respuesta->registros = $elementos;
   

   echo json_encode($respuesta);
}


if ($_POST['accion'] == 'actualizarEstadoActivo') {

    $id = $_POST['id'];
    
    $query = "UPDATE sales_management SET stateSale = '0' WHERE id_invoice = '$id'";

    $file = mysqli_query($conexion, $query);
     if ($file){
        echo json_encode('ok');
     }else{
        echo json_encode('error');
     }
}

if (trim($_POST['accion']) == 'seleccionarListaInsumos') {
    $idFactura = $_POST['id'];
    $respuesta = new stdclass();

    $cadena = "SELECT * FROM sales_detail AS p INNER JOIN supplys AS pr
            ON p.idSupply = pr.idSupply WHERE id_invoice ='$idFactura'";

    $resultado = mysqli_query($conexion, $cadena);

    $elementos = [];
    $i = 1;

    while ($datos = mysqli_fetch_array($resultado)) {

        array_push(
            $elementos,
            [
                'insumo' => $datos["nameSupply"],
                'cantidad' => $datos["quantity_sales_detail"],
                'total' => $datos["amount_supply_detail"],
            ]
        );
        $i++;
    }
    $respuesta->registros = $elementos;


    echo json_encode($respuesta);
}