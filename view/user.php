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
  <!-- DataTables -->
  <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="hold-transition sidebar-collapse sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <?php include 'layout/nav.php' ?>

    <?php include 'layout/aside.php' ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Usuarios</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="inicio.php">Home</a></li>
                <li class="breadcrumb-item active">Usuarios</li>
              </ol>
            </div>
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

      <section class="content">
        <div id="container-fluid">
          <div class="card">
            <div class="card-header d-flex justify-content-end">
              <button data-toggle="modal" data-target="#registerUsers" title="Este b??ton es para registrar un nuevo usuario" class="btn btn-primary btn-sm">Nuevo usuario</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tableUsers" class="table table-sm table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Documento</th>
                    <th>Correo electr??nico</th>
                    <th>Tel??fono</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>


                </tbody>

              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </section>
    </div>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- jQuery Knob Chart -->
  <script src="assets/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="assets/plugins/moment/moment.min.js"></script>
  <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="assets/plugins/summernote/summernote-bs4.min.js"></script>

  <!-- AdminLTE App -->
  <script src="assets/dist/js/adminlte.js"></script>

  <!-- DataTables  & Plugins -->
  <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <script src="app/user.app.js"></script>
</body>

<script>
  $(document).ready(function() {
    listarUsuarios();
  })
</script>


</html>


<!-- Modal Register-->
<div class="modal fade" data-backdrop="static" id="registerUsers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h5 class="modal-title" id="exampleModalLabel">Informaci??n del usuario</h5>
        <button type="button" title="Este b??ton cierra el formulario sin guardar cambios" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
        <input type="hidden" class="form-control" id="roleUser" value="0">
        <div class="row">
          <div class="col-6" style="margin-right:0;">
            <div class="form-group">
              <label for="nameUser">Nombre</label><label for="">*</label>
              <input type="text" class="form-control" id="nameUser" placeholder="Primer nombre">
            </div>
          </div>
          <div class="col-6" style="margin-right:0;">
            <div class="form-group">
              <label for="last_nameUser">Apellidos</label><label for="">*</label>
              <input type="text" class="form-control" id="last_nameUser" placeholder="Primer apellido o ambos">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="documentUser">Documento</label><label for="">*</label>
          <input type="text" onkeyup="assinmenetPassword()" class="form-control" id="documentUser" placeholder="N??mero de documento">
        </div>

        <div class="row">
          <div class="col-6" style="margin-right:0;">
            <div class="form-group">
              <label for="phoneUser">Tel??fono</label><label for="">*</label>
              <input type="text" class="form-control" id="phoneUser" placeholder="N??mero de tel??fono">
            </div>
          </div>
          <div class="col-6" style="margin-right:0;">
            <div class="form-group">
              <label for="emailUser">Correo electr??nico</label><label for="">*</label>
              <input type="emal" class="form-control" id="emailUser" placeholder="Correo electr??nico">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label for="passwordUser">Contrase??a</label><label for="">*</label>
              <input type="number" disabled style="background-color: white" class="form-control" id="passwordUser" placeholder="Contrase??a temporal">
            </div>
          </div>

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" title="Este b??ton cierra el formulario sin guardar cambios" data-dismiss="modal">Cerrar</button>
        <a onclick="registerUser()" title="Este b??ton es para enviar los datos del usuario" class="btn btn-primary">Guardar</a>
      </div>
    </div>
  </div>
</div>
<!-- Modal update -->
<div class="modal fade" id="updateUser" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar datos</h5>
        <button type="button" title="Este b??ton cierra el formulario sin guardar cambios" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <input type="hidden" class="form-control" id="idUserUpdate" aria-describedby="">
      <input type="hidden" class="form-control" id="passwordUserUpdate" value="<?php echo $_SESSION['passwordUser'] ?>">
      <input type="hidden" class="form-control" id="roleUserUpdate" value="0">

      <div class="modal-body">

        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label for="nameUserUpdate">Nombre</label><label for="">*</label>
              <input type="text" class="form-control" id="nameUserUpdate" aria-describedby="">
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="last_nameUserUpdate">Apellidos</label><label for="">*</label>
              <input type="text" class="form-control" id="last_nameUserUpdate" aria-describedby="">
            </div>
          </div>
        </div>



        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label for="documentUserUpdate">Documento</label><label for="">*</label>
              <input type="number" class="form-control" id="documentUserUpdate" aria-describedby="">
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="phoneUserUpdate">Tel??fono</label><label for="">*</label>
              <input type="text" class="form-control" id="phoneUserUpdate" aria-describedby="">
            </div>
          </div>
        </div>


        <div class="form-group">
          <label for="emailUserUpdate">Correo electr??nico</label><label for="">*</label>
          <input type="emal" class="form-control" id="emailUserUpdate" aria-describedby="">

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" title="Este b??ton cierra el formulario sin guardar cambios" data-dismiss="modal">Cancelar</button>
        <button type="button" onclick="updateUsers()" title="Este b??ton guarda los cambios realizados" class="btn btn-primary" data-dismiss="modal">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>