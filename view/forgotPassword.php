<?php
require "http/db/conexion.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Globe | LOGIN</title>

  <link href="assets/dist/img/icon empre.jpeg" rel="icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <!-- CDN para sweetalert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../view/app/recuperar.app.js"> </script>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="" class="h1"><b>Globe</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">¿Olvidaste tu contraseña?</p>
        <form id="recoverForm">
          <div class="input-group mb-3">
            <input type="email" name="email" id="email" class="form-control" placeholder="Correo">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="text" name="text" id="text" class="form-control" placeholder="Documento">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <a type="submit" href="recoverPassword.php" id="recuperar" class="btn btn-primary btn-block">Enviar</a>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <p class="mt-3 mb-1 text-lg-right">
          <a href="../indexLogin.php">Regresar</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <?php

  error_reporting(0);

  if ($_GET['id'] == "0") {
    echo "
      <script>
          Swal.fire({
              icon: 'warning',
              heightAuto: false,
              title: 'Debes ingresar su nombre de usuario'
          })
      </script>
      ";
  } else if ($_GET['id'] == "1") {
    echo "
    <script>
        Swal.fire({
            icon: 'warning',
            heightAuto: false,
            title: 'Debes ingresar su contraseña'
        })
    </script>
    ";
  }
  ?>
  

  <!-- jQuery -->
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/dist/js/adminlte.min.js"></script>
</body>

</html>