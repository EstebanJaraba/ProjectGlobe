<?php

require_once 'db/conexion.php';

if ($_POST['accion'] == 'registerSuppliers') {
    $name = $_POST['nombre'];
    $direction = $_POST['direction'];
    $email = $_POST['correo'];
    $phone = $_POST['celular'];
    $categoria = $_POST['categoria'];

    if ($name == "" || $direction == "" || $email == "" || $phone == "" || $categoria == "") {
        echo json_encode('fallo');
    }else if (strlen($phone) <= 9 || strlen($phone) > 15 || !is_numeric($phone)) {
        echo json_encode('max2');
    } else if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $consultaCorreo = "SELECT email FROM suppliers WHERE email='$email'";

        $conect2 = mysqli_query($conexion, $consultaCorreo);

        $result2 = mysqli_num_rows($conect2);

        if ($result2 > 0) {
            echo json_encode('emailError');
        } else {
            $query = "INSERT INTO suppliers(nameSupplier,phone,direction,email,categoria,stateSupplier) VALUE ('$name','$phone','$direction','$email','$categoria','1')";

            $file =  mysqli_query($conexion, $query);

            if ($file) {
                echo json_encode('ok');
            } else {
                echo json_encode('error');
            }
        }
    } else {
        echo json_encode('email');
    }
}

if (trim($_POST['accion']) == 'select_ListSuppliers') {

    $respuesta = new stdClass();
    $cadena = "SELECT * FROM suppliers";

    $result = mysqli_query($conexion, $cadena);

    $elementos = [];
    $i = 1;
    while ($datos = mysqli_fetch_array($result)) {
        array_push($elementos, ['idSupplier' => $datos["idSupplier"], 'nameSupplier' => $datos["nameSupplier"], 'phone' => $datos["phone"],'direction' => $datos["direction"],'email' => $datos["email"], 'categoria' => $datos["categoria"], 'stateSupplier' => $datos["stateSupplier"]]);
        $i++;
    }
    $respuesta->registros = $elementos;

    echo json_encode($respuesta);
}


if ($_POST['accion'] == 'updateSupplier') {
    $id = $_POST['id'];
    $name = $_POST['nombre'];
    $email = $_POST['correo'];
    $phone = $_POST['celular'];
    $direction = $_POST['direction'];
    $categoria = $_POST['categoria'];
    $state = $_POST['estado'];

    $query = "UPDATE suppliers SET nameSupplier = '$name', phone = '$phone', direction = '$direction', email = '$email',categoria = '$categoria',,stateSupplier = '$state' WHERE idSupplier = '$id'";

    $file =  mysqli_query($conexion, $query);

    if ($file) {
        echo json_encode('ok');
    } else {
        echo json_encode('error');
    }
}

if ($_POST['accion'] == 'anularSupplier') {
    $id = $_POST['id'];

    $query = "UPDATE suppliers SET stateSupplier = '0' WHERE idSupplier = '$id'";

    $file =  mysqli_query($conexion, $query);

    if ($file) {
        echo json_encode('ok');
    } else {
        echo json_encode('error');
    }
}
