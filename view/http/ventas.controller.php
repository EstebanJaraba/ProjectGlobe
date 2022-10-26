
<?php

require_once 'db/conexion.php';

if ($_POST['accion'] == 'registrarVenta') {
    $cliente = $_POST['cliente'];
    $servicio = $_POST['servicio'];
    $total = $_POST['total'];
    $descriptionSale = $_POST['descriptionSale'];


    $query = "INSERT INTO sales_management (idClient, idService, amount_total_sale, descriptionSale, stateSale, dateRegistration) 
    VALUE ('$cliente', '$servicio', '$total', '1', '$descriptionSale', '$dateRegistration')";

    $file = mysqli_query($conexion, $query);
     if ($file){
        echo json_encode('ok');
     }else{
        echo json_encode('error');
     }
}


if($_POST['accion'] == 'registrarVenta'){
   $insumo = $_POST['insumo'];
   $total = $_POST['total'];
   $cantidad = $_POST['cantidad'];

   echo $cantidad;

   $query = "INSERT INTO sales_detail(idSupply, amount_supply_detail, quantity_sales_detail) 
   VALUE('$insumo', '$total','$cantidad')";
   
   $file = mysqli_query($conexion,$query);

   if($file){
       echo json_encode('ok');
   }else{
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
         'id' => $datos["idSale"], 
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

if($_POST['accion'] == 'agregarInsumo'){
   $insumo = $_POST['insumo'];
   $valorInsumo = $_POST['valorInsumo'];
   $cantidad = $_POST['cantidad'];

   $query = "INSERT INTO sales_detail(idSupply, amount_supply_detail, quantity_sales_detail ) VALUE('$insumo','$valorInsumo','$cantidad')";

   $file = mysqli_query($conexion,$query);

   if($file){
       echo json_encode('ok');
   }else{
       echo json_encode('error');
   }

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
               'insumo' => $datos["idSupply"],
               'valorInsumo' => $datos["amount_supply_detail"] ,
               'cantidadInsumo' => $datos["quantity_sales_detail"],
                             
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
           ON p.idClient = pr.idClient";

   $resultado = mysqli_query($conexion, $cadena);

   $elementos = [];
   $i = 1;

   while ($datos = mysqli_fetch_array($resultado)) {

       array_push(
           $elementos,
           [
               'id' => $datos["idSale"],
               'cliente' => $datos["idClient"],
               'servicio' => $datos["idService"],
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


if ($_POST['accion'] == 'actualizarEstadoActivo') {

    $idSale = $_POST['idSale'];
    
    $query = "UPDATE sales_management SET stateSale = '0' WHERE idSale = '$idSale'";

    $file = mysqli_query($conexion, $query);
     if ($file){
        echo json_encode('ok');
     }else{
        echo json_encode('error');
     }
}