
<?php

require_once 'db/conexion.php';

if ($_POST['accion'] == 'registroVenta') {
    $nameSale = $_POST['nameSale'];
    $idClient = $_POST['idClient'];
    $idService = $_POST['idService'];
    $stateSale = $_POST['stateSale'];

    $query = "INSERT INTO sales (nameSale, idClient, idService, stateSale) VALUE ('$nameSale', '$idClient', '$idService', '$stateSale')";

    $file = mysqli_query($conexion, $query);
     if ($file){
        echo json_encode('ok');
     }else{
        echo json_encode('error');
     }
}


if (trim($_POST['accion']) == 'select_listVentas'){
   $respuesta = new stdClass();

   $cadena = "SELECT * FROM  sales";

   $result = mysqli_query($conexion, $cadena);

   $elementos = [];
   $i= 1;

   while ($datos = mysqli_fetch_array($result)) {
       array_push($elementos, ['idSale' => $datos["idSale"], 'nameSale' => $datos["nameSale"], 'idClient' => $datos
       ["idClient"], 'idService' => $datos["idService"], 'stateSale' => $datos["stateSale"]]);
       $i++;

   }

   $respuesta->registros = $elementos;

   echo json_encode($respuesta);

}



if ($_POST['accion'] == 'editarVenta') {
   $idSale = $_POST['idSale'];
   $nameSale = $_POST['nameSale'];
   $idClient = $_POST['idClient'];
   $idService = $_POST['idService'];
   $stateSale = $_POST['stateSale'];

    $query = "UPDATE sales SET nameSale = '$nameSale', idClient = '$idClient', idService = '$idService', stateSale = '$stateSale' WHERE idSale = '$idSale'";

    $file = mysqli_query($conexion, $query);
     if ($file){
        echo json_encode('ok');
     }else{
        echo json_encode('error');
     }
}



if ($_POST['accion'] == 'anularVenta') {

    $idSale = $_POST['idSale'];
    
    $query = "UPDATE sales SET stateSale = '0' WHERE idSale = '$idSale'";

    $file = mysqli_query($conexion, $query);
     if ($file){
        echo json_encode('ok');
     }else{
        echo json_encode('error');
     }
}