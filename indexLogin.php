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
        <!-- <a data-toggle="modal" data-target="#registerUsers">
          <h6 class="text-lg-right">Crear cuenta</h6>
        </a> -->

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
            <div class="col-4">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Recordar
                </label>
              </div>
            </div>

            <div class="col-4">
              <button type="button" name="access" data-toggle="modal" data-target="#registerUsers" class="btn btn-primary btn-block">Crear</button>
            </div>
            <div class="col-4">
              <button type="submit"  name="access" class="btn btn-success btn-block">Acceder</button>
            </div>

          </div>
        </form>
        <p class="mb-1">
          <a href="view/forgotPassword.php">Olvidé mi contraseña</a>
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
              title: 'No hay un usuario registrado con ese nombre.'
          }).then(function(isConfirm) {
            if (isConfirm) {
              location.href = 'indexLogin.php';
            } else {
              //if no clicked => do something else
            }
          });
      </script>
      ";
  } else if ($_GET['id'] == "1") {
    echo "
    <script>
        Swal.fire({
            icon: 'warning',
            heightAuto: false,
            title: 'Contraseña Incorrecta.'
        }).then(function(isConfirm) {
          if (isConfirm) {
            location.href = 'indexLogin.php';
          } else {
            //if no clicked => do something else
          }
        });
    </script>
    ";
  }else if ($_GET['id'] == "3") {
    echo "
    <script>
        Swal.fire({
            icon: 'warning',
            heightAuto: false,
            title: 'error'
        }).then(function(isConfirm) {
          if (isConfirm) {
            location.href = 'indexLogin.php';
          } else {
            //if no clicked => do something else
          }
        });
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
  <script src="view/app/create.app.js"></script>
</body>


</html>
<div class="modal fade" data-backdrop="static" id="registerUsers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="card-outline card-primary">
        <div class="modal-header ">
          <div class="col-6 ">
            <b class="h3">Registro Usuario</b>
          </div>
          <div class="col-6">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
        <div class="card-body">
          <form action="../../index.html" method="post">
            <div class="row">
              <div class="col-6">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" id="nameUser" placeholder="Nombre">
                </div>
              </div>
              <div class="col-6">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" id="last_nameUser" placeholder="Apellidos">
                </div>
              </div>
            </div>

            <div class="input-group mb-3">
              <input type="text" class="form-control" id="documentUser" placeholder="Documento">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>

            <div class="input-group mb-3">
              <input type="email" class="form-control" id="emailUser" placeholder="Email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>

            <div class="input-group mb-3">
              <input type="text" class="form-control" id="phoneUser" placeholder="Telefono">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-phone"></span>
                </div>
              </div>
            </div>

            <div class="input-group mb-3">
              <input type="password" class="form-control" id="passwordUser" placeholder="Contraseña">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <input type="hidden" class="form-control" id="roleUser" value="1">
            <input type="hidden" class="form-control" id="stateUser" value="1">

            <div class="row">
              <div class="col-6">
                <div class="icheck-primary">
                  <input type="checkbox" id="axgreeTerms" name="terms" value="agree">
                  <label for="agreeTerms">
                    Acepto envio de datos
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-6 text-lg-right">
                <button type="button" onclick="registerUser()" class="btn btn-primary" data-dismiss="modal">Guardar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>