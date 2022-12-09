

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
    $dateRegistration = $_POST['dateRegistration'];
    $arreglo = $_POST['arreglo'];

    $query = "INSERT INTO sales_management (id_invoice, idClient, idService, idEmployee, amount_total_sale, descriptionSale, dateRegistration, stateSale) 
    VALUE ('$factura', '$cliente', '$servicio', '$empleado', '$total', '$descriptionSale', '$dateRegistration', '1')";

    $file = mysqli_query($conexion, $query);
    if ($file) {

        $newquery = '';
        $newfile = false;
        for ($i = 0; count($arreglo) > $i; $i++) {
            $newquery = "INSERT INTO sales_detail(id_invoice, idSupply, amount_supply_detail, quantity_sales_detail) 
            VALUE ('$factura', '" . $arreglo[$i]['insumoId'] . "', '" . $arreglo[$i]['valorTotal'] . "','" . $arreglo[$i]['cantidad'] . "')";
            $newfile = mysqli_query($conexion, $newquery);

            $disminuir = "SELECT quantity AS quantity FROM supplys WHERE idSupply = " . $arreglo[$i]['insumoId'] . "";

            $filesSum = mysqli_query($conexion, $disminuir);

            while ($array = mysqli_fetch_assoc($filesSum)){
                $quantitySuma = $array["quantity"] - $arreglo[$i]['cantidad'];
                $queryUp = "UPDATE supplys SET quantity = $quantitySuma WHERE idSupply = ".$arreglo[$i]['insumoId']."";
                $fileUp = mysqli_query($conexion, $queryUp);
            }
        }
        if ($fileUp) {
            echo json_encode('ok');
        }
    }else {
        echo json_encode('error');
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
                'dateRegistration' => $datos["dateRegistration"],
               'stateSale' => $datos["stateSale"],        
           ]
       );
       $i++;
   }
   $respuesta->registros = $elementos;
   

   echo json_encode($respuesta);
}

//Cambiar estado

if($_POST['accion'] == 'actualizarEstadoActivo') {
    $id = $_POST['id'];
    $estado = $_POST['estado'];
    if($estado == 1){
        $mostrarStateSale = 0;
    }elseif($estado == 0){
        $mostrarStateSale = 0;
    };
    $newquery = mysqli_query($conexion,"SELECT idSupply, amount_supply_detail, quantity_sales_detail FROM sales_detail WHERE
    id_sale_detail = $id");
    while($dataSaleDetail = mysqli_fetch_assoc($newquery)){
        // consultar stock
        $queryProducto = mysqli_query($conexion,"SELECT quantity_sales_detail from supplys where idSupply = '".$dataSaleDetail['idSupply']."'");
        $quantitySuma = mysqli_fetch_assoc($queryProducto);
        //actualizar stock
        mysqli_query($conexion,"UPDATE supplys set quantity_sales_detail = ".$quantitySuma['quantity_sales_detail'] + 
        $dataSaleDetail['quantity_sales_detail']." WHERE idSupply = ".$dataSaleDetail['idSupply']."");
    }
    $query = "UPDATE sales_management SET stateSale = '$mostrarStateSale' WHERE id_invoice = '$id'";

    $file = mysqli_query($conexion,$query) or die(mysqli_errno($conexion));

    if($file > 0){
        echo json_encode('ok');
    }else{
        echo json_encode('error');
    };
};

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

if($_POST['accion'] == "validar_stock"){
    $idInsumo = $_POST['id_insumo'];
    $cantidad = $_POST['cantidad'];

    $queryCantidad = mysqli_query($conexion,"SELECT quantity from supplys sp where idSupply = $idInsumo and $cantidad <= sp.quantity");
    if(mysqli_num_rows($queryCantidad) > 0){
        echo json_encode("disponible"); 
    }else{
        echo json_encode("sin_stock"); 
    }
}