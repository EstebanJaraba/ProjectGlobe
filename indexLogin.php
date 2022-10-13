<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Globe | LOGIN</title>

  <link href="view/assets/dist/img/icon empre.jpeg" rel="icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="view/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="view/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="view/assets/dist/css/adminlte.min.css">
  <!-- CDN para sweetalert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="view/assets/index2.html"><b>GLOBE</b></a>
      <link href="view/assets/dist/img/icon empre.jpeg" rel="icon">
    </div>
    <!-- /.login-logo -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title"> Inicio de sesión </h3>
      </div>
      <div class="card-body login-card-body">
        <form action="view/http/access.controller.php" method="post">

          <div class="input-group mb-3">
            <input type="text" name="user" require class="form-control" placeholder="Nombre de usuario">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>


          <div class="input-group mb-3">
            <input type="password" name="pass" require class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Recordar contraseña
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" name="access" class="btn btn-primary btn-block">Acceder</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <p class="mb-1">
          <a href="forgot-password.html">Olvidé mi contraseña</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
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
  <script src="view/assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="view/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="view/assets/dist/js/adminlte.min.js"></script>
</body>

</html>