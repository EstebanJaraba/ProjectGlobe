
<?php

require_once 'db/conexion.php';

if ($_POST['accion'] == 'registroServicio') {
    $nameService = $_POST['nameService'];
    $price = $_POST['price'];
    $stateService = $_POST['stateService'];

    $query = "INSERT INTO services (nameService, price, stateService) VALUE ('$nameService', '$price', '$stateService')";

    $file = mysqli_query($conexion, $query);
     if ($file){
        echo json_encode('ok');
     }else{
        echo json_encode('error');
     }
}



if (trim($_POST['accion']) == 'select_listServicios'){
    $respuesta = new stdClass();

    $cadena = "SELECT * FROM  services";

    $result = mysqli_query($conexion, $cadena);

    $elementos = [];
    $i= 1;

    while ($datos = mysqli_fetch_array($result)) {
        array_push($elementos, ['idService' => $datos["idService"], 'nameService' => $datos["nameService"], 'price' => $datos
        ["price"], 'stateService' => $datos["stateService"]]);
        $i++;

    }

    $respuesta->registros = $elementos;

    echo json_encode($respuesta);

}



if ($_POST['accion'] == 'editarServicio') {
    $idService = $_POST['idService'];
    $nameService = $_POST['nameService'];
    $price = $_POST['price'];
    $stateService = $_POST['stateService'];

    $query = "UPDATE services SET nameService = '$nameService', price = '$price',  stateService = '$stateService' WHERE idService = '$idService'";

    $file = mysqli_query($conexion, $query);
     if ($file){
        echo json_encode('ok');
     }else{
        echo json_encode('error');
     }
}



if ($_POST['accion'] == 'anularServicio') {

    $idService = $_POST['idService'];
    
    $query = "UPDATE services SET stateService = '0' WHERE idService = '$idService'";

    $file = mysqli_query($conexion, $query);
     if ($file){
        echo json_encode('ok');
     }else{
        echo json_encode('error');
     }
}