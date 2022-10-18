<?php

session_start();

if (!isset($_SESSION['userName'])) {
  header('location: ../indexLogin.php');
}

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
              <h1 class="m-0">Insumos</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="inicio.php">Home</a></li>
                <li class="breadcrumb-item active">Insumos</li>
              </ol>
            </div>

          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

      <section class="content">
        <div id="container-fluid">
          <div class="card">
            <div class="card-header d-flex justify-content-end">
              <button data-toggle="modal" data-target="#registerSupplys" class="btn btn-primary btn-sm">Nuevo Insumo</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tableSupplys" class="table table-sm table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="d-flex justify-content-center">ID</th>
                    <th>Nombre</th>
                    <th>Número de parte</th>
                    <th>Cantidad</th>
                    <th class="d-flex justify-content-center">Estado</th>
                    <th>acciones</th>
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
  <!-- overlayScrollbars -->
  <script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
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



  <!-- <script>
    $(function() {
      $("#listadoUsuarios").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#listadoUsuarios_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script> -->
  <script src="app/supply.app.js"></script>
</body>

<script>
  $(document).ready(function() {
    listarInsumos();
  })
</script>
<!-- <script>
  $(document).ready(function() {
    $('#tableSupplys').DataTable();
  });
</script> -->
<!-- <script>
  $(document).ready(function() {
    $('#tableSupplys').DataTable({
     "destroy": true,
    });
  });
</script> -->

</html>


<!-- Modal Register -->
<div class="modal fade" id="registerSupplys" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h5 class="modal-title" id="exampleModalLabel">Registro Insumo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group">
          <label for="nameSupply">Nombre</label>
          <input type="text" class="form-control" id="nameSupply" aria-describedby="">
        </div>

        <div class="form-group">
          <label for="partNumberSupply">Número de parte</label>
          <input type="number" class="form-control" id="partNumberSupply" aria-describedby="">
        </div>
        <div class="form-group">
          <label for="quantitySupply">Cantidad</label>
          <input type="number" class="form-control" id="quantitySupply" aria-describedby="">
        </div>

        <div class="col-3" style="margin-left: 0;">
          <div class="form-group">
            <label for="stateSupply">Estado</label>
            <select class="form-control" id="stateSupply" aria-describedby="">
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <a onclick="registerSupply()" class="btn btn-primary">Guardar</a>
      </div>
    </div>

  </div>
</div>

<!-- Modal update -->
<div class="modal fade" id="updateSupplys" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Insumo</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <input type="hidden" class="form-control" id="idSupplyUpdate" aria-describedby="">
      <div class="modal-body">
        <div class="col-12">
          <div class="form-group">
            <label for="nameSupplyUpdate">Nombre</label>
            <input type="text" class="form-control" id="nameSupplyUpdate" aria-describedby="">
          </div>
        </div>

        <div class="col-12">
          <div class="form-group">
            <label for="partNumberSupplyUpdate">Número de parte</label>
            <input type="number" class="form-control" id="partNumberSupplyUpdate" aria-describedby="">
          </div>
        </div>
        <div class="col-12" style="margin-left: 0;">
          <div class="form-group">
            <label for="stateSupply">Estado</label>
            <select class="form-control" id="stateSupplyUpdate" aria-describedby="">
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button  onclick="updateSupply()" class="btn btn-primary" data-dismiss="modal">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>