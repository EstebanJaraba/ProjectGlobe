<?php
session_start();

?>

<?php

require('http/db/conexion.php');

$queryCliente = "SELECT * FROM clients";
$queryVenta = "SELECT * FROM services";
$resultadoCliente = mysqli_query($conexion, $queryCliente);
$resultadoServicio = mysqli_query($conexion, $queryVenta);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GLOBE</title>

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
    <!-- CDN para swealert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="hold-transition sidebar-collapse sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include 'layout/nav.php' ?>

        <!-- Main Sidebar Container -->
        <?php include 'layout/aside.php' ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Ventas</h1>
                        </div>
                    </div>
                </div>
            </div>


            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header d-flex justify-content-end">
                            <button data-toggle="modal" data-target="#registroVenta" class="btn btn-primary btn-sm">Nueva venta</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tableVentas" class="table table-sm table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Descripción      </th>
                                        <th>Cliente</th>
                                        <th>Servicio</th>
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

    <script>
        $(document).ready(function() {
            listarVentas();
        })
    </script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.js"></script>

    <!-- Archivo APP clientes -->
    <script src="app/Venta.app.js"></script>

    <!-- Modal de registro -->
    <div class="modal fade" id="registroVenta" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="staticBackdropLabel">Nueva venta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="nameSale">Descripción</label>
                        <input type="text" class="form-control" id="nameSale" aria-describedby="emailHelp">
                    </div>

                    <div class="row">
                        <div class="col-6" style="margin-right: 0;">
                            <div class="form-group">
                                <label for="idClient">Cliente</label>
                                <select class="form-control" id="idClient" aria-describedby="">
                                    <option value="">--Seleccione--</option>
                                    <?php while ($row = $resultadoCliente->fetch_assoc()) { ?>
                                        <option value="<?php echo $row['idClient']; ?>"><?php echo $row['nameClient']; ?></option>
                                    <?php }   ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-6" style="margin-left: 0;">
                            <div class="form-group">
                                <label for="idService">Servicio</label>
                                <select class="form-control" id="idService" aria-describedby="">
                                    <option value="">--Selecione--</option>
                                    <?php while ($row = $resultadoServicio->fetch_assoc()) { ?>
                                        <option value="<?php echo $row['idService']; ?>"><?php echo $row['nameService']; ?></option>
                                    <?php }   ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="stateSale">Estado</label>
                                <select class="form-control" id="stateSale" aria-describedby="emailHelp">
                                    <option value="1">Activo</option>
                                    <option value="0">Anulada</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" onclick="registroVenta()" class="btn btn-primary" data-dismiss="modal">Guardar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal de editar
<div class="modal fade" id="editarVenta" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="staticBackdropLabel">Actualizar venta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
                <input type="hidden" name="idSaleEditar" class="form-control" id="idSaleEditar">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="nameSaleEditar">Nombre</label>
                        <input type="text" class="form-control" id="nameSaleEditar" aria-describedby="">
                    </div>

                    <div class="row">
                        <div class="col-6" style="margin-right: 0;">
                            <div class="form-group">
                                <label for="clientSaleEditar">Cliente</label>
                                <select class="form-control" id="clientSaleEditar" aria-describedby="">
                                    <option value="">---</option>
                                    <?php while ($row = $resultadoCliente->fetch_assoc()) { ?>
                                        <option value="<?php echo $row['idClient']; ?>"><?php echo $row['nameClient']; ?></option>
                                    <?php }   ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-6" style="margin-left: 0;">
                            <div class="form-group">
                                <label for="serviceSaleEditar">Servicio</label>
                                <select class="form-control" id="serviceSaleEditar" aria-describedby="">
                                    <option value="">---</option>
                                    <?php while ($row = $resultadoServicio->fetch_assoc()) { ?>
                                        <option value="<?php echo $row['idService']; ?>"><?php echo $row['nameService']; ?></option>
                                    <?php }   ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="stateSaleEditar">Estado</label>
                                <select class="form-control" id="stateSaleEditar" aria-describedby="">
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button> <br><br><br><br><br>
                    <button type="button" onclick="editarVenta()" data-dismiss="modal" class="btn btn-primary">Guardar cambios</button>
                </div>
        </div>
    </div>
</div>
-->
</body>

</html>