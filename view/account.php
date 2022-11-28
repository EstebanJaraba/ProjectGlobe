<?php

session_start();

if (!isset($_SESSION['userName'])) {
    header('location: ../indexLogin.php');
}
?>
<?php

require('http/db/conexion.php');

$query = "SELECT * FROM role_management";

$resultado = mysqli_query($conexion, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GLOBE</title>

    <link href="assets/dist/img/icon empre.jpeg" rel="icon">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="assets/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed">
    <div class="wrapper">
        <?php include 'layout/nav.php' ?>

        <?php include 'layout/aside.php' ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Perfil</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="inicio.php">Home</a></li>
                                <li class="breadcrumb-item active">Perfil</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle" src="assets/dist/img/user.jpg" alt="User profile picture">
                                    </div>

                                    <h3 class="profile-username text-center"><?php echo $_SESSION['nombreCompleto'] ?></h3>

                                    <p class="text-muted text-center"><?php echo $_SESSION['id_rol'] ?></p>

                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Correo</b> <a class="float-right"><?php echo $_SESSION['email'] ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Teléfono</b> <a class="float-right"><?php echo $_SESSION['phone'] ?></a>
                                        </li>
                                    </ul>

                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header">
                                    Editar contraseña
                                </div>
                                <div class="card-body">
                                    <input type="hidden" class="form-control" id="idup" value="<?php echo $_SESSION['idUser'] ?>">
                                    <div class="form-group">
                                        <label for="pass">Contraseña nueva</label>
                                        <input type="text" class="form-control" id="passUpdate" placeholder="*">
                                    </div>
                                    <div class="form-group">
                                        <label for="pass">Repetir contraseña nueva</label>
                                        <input type="text" class="form-control" id="passr" placeholder="*">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="updatePass()" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </section>
            <!-- <section class="content">
                <div class="container-fluid">
                    <div>
                        <div class="card">
                            <div id="container-fluid">
                                <div class="row" id="cancel-row">
                                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                                        <div class="statbox widget box box-shadow">
                                            <div class="widget-content widget-content-area">
                                                <div class="card update collapse" id="update">

                                                    <div class=" m-2">
                                                        <div class="col-">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <div class="row">
                                                                        <div class="d-flex col-11">
                                                                            <h3 class="card-title">Editar perfil</h3>
                                                                        </div>

                                                                        <div class=" d-flex justify-content-end">
                                                                            <button class="btn btn-danger" onclick="ocultar()"><i class="bi bi-x-lg"></i></button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <form id="editar perfil">

                                                                        <div class="card-body">
                                                                            <input type="hidden" class="form-control" id="idAccount" value="<?php echo $_SESSION['idUser'] ?>">
                                                                            <input type="hidden" class="form-control" id="roleAccount" value="<?php echo $_SESSION['id_rol'] ?>">

                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <label for="nameAccount">Nombre</label>
                                                                                        <input type="text" class="form-control" id="nameAccount" placeholder="*">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <label for="last_nameAccount">Apellidos</label>
                                                                                        <input type="text" class="form-control" id="last_nameAccount" placeholder="*">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <label for="emailAccount">Email</label>
                                                                                        <input type="email" class="form-control" id="emailAccount" placeholder="*">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <label for="phoneAccount">Telefono</label>
                                                                                        <input type="text" class="form-control" id="phoneAccount" placeholder="*">
                                                                                    </div>
                                                                                </div>
                                                                            </div>



                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" onclick="updateAccount()" class="btn btn-primary">Guardar</button>
                                                                        </div>

                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-end">
                                                        <button class="btn btn-primary btn-sm" onclick="mostrar()">Editar perfil</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </section> -->
        </div>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>


    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="assets/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="assets/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="assets/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="assets/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="assets/plugins/moment/moment.min.js"></script>
    <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="assets/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="app/edit.app.js"></script>
</body>

</html>