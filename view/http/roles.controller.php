<?php

require_once 'db/conexion.php';
if ($_POST['accion'] == 'registrarRol') {
    $nombre = $_POST['nombre'];
    $estado = $_POST['estado'];
    $checks = explode(",",$_POST['permissions']);

    $query = "INSERT INTO role_management(name_rol, state_rol) VALUE('$nombre','$estado')";
    $file = mysqli_query($conexion,$query);
    $queryRow = mysqli_query($conexion,"SELECT id_rol FROM role_management order by id_rol DESC limit 1");  
    $idLast = mysqli_fetch_assoc($queryRow);
    foreach($checks as $check){
        mysqli_query($conexion,"INSERT INTO permission_rol (id_rol, id_permission) VALUE('".$idLast['id_rol']."','$check')") or die (mysqli_error($conexion));
    }
    if ($file) {
        echo json_encode('ok');
    } else {
        echo json_encode('error');
    }

}

if (trim($_POST['accion']) == 'seleccionarListaRoles') {

    $respuesta = new stdclass();

    $cadena = "SELECT
                rl.id_rol,rl.name_rol, GROUP_CONCAT(pm.name_permission SEPARATOR ', ') AS permisos, GROUP_CONCAT(pm.id_permission) AS id_permisions, rl.state_rol
            FROM
                permission_rol pr
            JOIN permissions pm ON
                (
                pr.id_permission = pm.id_permission
            )
            RIGHT JOIN role_management rl ON
                (pr.id_rol = rl.id_rol)
            GROUP BY
                rl.name_rol, rl.id_rol";
    $resultado = mysqli_query($conexion, $cadena);
    
    $elementos = [];
    $i = 1;

    while ($datos = mysqli_fetch_array($resultado)) {
        array_push(
            $elementos,
            [
                'id' => $datos["id_rol"],
                'nombre' => $datos["name_rol"],
                'permission' => $datos['permisos'] ?: "No definido",
                'id_permisions' => $datos['id_permisions'],
                'estado' => $datos["state_rol"]
            ]
        );
        $i++;
    }
    $respuesta->registros = $elementos;

    echo json_encode($respuesta);
}


if ($_POST['accion'] == 'actualizarRoles') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $estado = $_POST['state'];
    $checks = explode(",",$_POST['permissions']);
    $query = "UPDATE role_management SET name_rol = '$nombre', state_rol = '$estado' WHERE id_rol = '$id'";
    $file = mysqli_query($conexion,$query) or die(mysqli_error($conexion));
    mysqli_query($conexion,"DELETE FROM permission_rol where id_rol ='$id'");
    foreach($checks as $check){
        mysqli_query($conexion,"INSERT INTO permission_rol (id_rol, id_permission) VALUE('".$id."','$check')") or die (mysqli_error($conexion));
    }


    if ($file > 0) {
        echo json_encode('ok');
    } else {
        echo json_encode('error');
    }
}
