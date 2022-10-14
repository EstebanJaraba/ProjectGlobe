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
</head>

<body class="hold-transition login-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="../../index2.html" class="h1"><b>Globe</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Registrar un nuevo usuario</p>

                <form action="../view/http/users.controller.php" method="post">

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
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="axgreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    Acepto envio de datos    
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <a href="../indexLogin.php" class="text-center">Ya tengo una cuenta</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
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
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.min.js"></script>
</body>

</html>