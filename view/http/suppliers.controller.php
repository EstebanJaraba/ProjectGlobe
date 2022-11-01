<?php

require_once 'db/conexion.php';

if ($_POST['accion'] == 'registerSuppliers') {
    $name = $_POST['nombre'];
    $last_name = $_POST['apellido'];
    $documento = $_POST['documento'];
    $email = $_POST['correo'];
    $phone = $_POST['celular'];
    $state = $_POST['estado'];

    if ($name == "" || $last_name == "" || $documento == "" || $email == "" || $phone == "" || $state == "") {
        echo json_encode('fallo');
    } else if (strlen($documento) <= 9 || !is_numeric($documento)) {
        echo json_encode('max');
    } else if (strlen($phone) <= 9 || strlen($phone) > 15 || !is_numeric($phone)) {
        echo json_encode('max2');
    } else if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $consulta = "SELECT document FROM suppliers WHERE document='$documento'";
        $consultaCorreo = "SELECT email FROM suppliers WHERE email='$email'";

        $conect = mysqli_query($conexion, $consulta);
        $conect2 = mysqli_query($conexion, $consultaCorreo);

        $result = mysqli_num_rows($conect);
        $result2 = mysqli_num_rows($conect2);

        if ($result > 0) {
            echo json_encode('doc');
        } else if ($result2 > 0) {
            echo json_encode('emailError');
        } else {
            $query = "INSERT INTO suppliers(nameSupplier,last_name,document,email,phone,stateSupplier) VALUE ('$name','$last_name','$documento','$email','$phone','$state')";

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
        array_push($elementos, ['idSupplier' => $datos["idSupplier"], 'nameSupplier' => $datos["nameSupplier"], 'last_name' => $datos["last_name"], 'document' => $datos["document"], 'email' => $datos["email"], 'phone' => $datos["phone"], 'stateSupplier' => $datos["stateSupplier"]]);
        $i++;
    }
    $respuesta->registros = $elementos;

    echo json_encode($respuesta);
}


if ($_POST['accion'] == 'updateSupplier') {
    $id = $_POST['id'];
    $name = $_POST['nombre'];
    $last_name = $_POST['apellido'];
    $documento = $_POST['documento'];
    $email = $_POST['correo'];
    $phone = $_POST['celular'];
    $state = $_POST['estado'];

    $query = "UPDATE suppliers SET nameSupplier = '$name', last_name = '$last_name',document = '$documento',email = '$email', phone = '$phone',stateSupplier = '$state' WHERE idSupplier = '$id'";

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
