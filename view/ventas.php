<?php
session_start();

?>

<?php

require('http/db/conexion.php');




$queryVenta = "SELECT * FROM services";
$queryInsumo = "SELECT * FROM supplys";
$queryCliente = "SELECT * FROM clients";
$queryEmpleado = "SELECT * FROM employees WHERE stateEmployee='1'";

$resultadoServicio = mysqli_query($conexion, $queryVenta);
$resultadoInsumo = mysqli_query($conexion, $queryInsumo);
$resultadoCliente = mysqli_query($conexion, $queryCliente);
$resultadoEmpleado = mysqli_query($conexion, $queryEmpleado);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GLOBE</title>

    <link href="assets/dist/img/Globee.jpeg" rel="icon">
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
                    <div class="row mb-1">
                        <div class="col-sm-4">
                            <h1 class="m-0">Gestión de ventas</h1>
                        </div>
                    </div>
                </div>
            </div>


            <section class="content">
                <div id="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <div class="card">
                                <div id="container-fluid">
                                    <div class="row" id="cancel-row">
                                        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                                            <div class="statbox widget box box-shadow">
                                                <div class="widget-content widget-content-area">
                                                    <div class="card showRegister collapse" id="showRegister">
                                                        <div class=" d-flex justify-content-end p-4 pr-5">
                                                            <button class="btn btn-danger" onclick="ocultar()"><i class="bi bi-x-lg"></i></button>
                                                        </div>
                                                        <div class=" m-2">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <h3 class="card-title">Registrar venta</h3>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <form id="registroInsumo">
                                                                            <div class="row">
                                                                                <div class="col-4">
                                                                                    <div class="form-group">
                                                                                        <label for="facturaVenta">Número de factura</label>
                                                                                        <input type="text" placeholder="Ingrese número de factura" class="form-control" id="facturaVenta" aria-describedby="">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-4" style="margin-right: 0;">
                                                                                    <div class="form-group">
                                                                                        <label for="idClient">Cliente</label>
                                                                                        <select name="cliente" class="form-control" aria-required="" id="listaCliente">
                                                                                            <option value="0">--Seleccione--</option>
                                                                                            <?php while ($row = $resultadoCliente->fetch_assoc()) { ?>
                                                                                                <option value="<?php echo $row['idClient']; ?>"><?php echo $row['nameClient']; ?></option>
                                                                                            <?php }   ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-4">
                                                                                    <div class="form-group">
                                                                                        <label for="total">Total</label>
                                                                                        <p class="form-label h2" id="totalVenta">000000</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                

                                                                                <div class="col-6" style="margin-left: 0;">
                                                                                    <div class="form-group">
                                                                                        <label for="idService">Servicio</label>
                                                                                        <select name="servicio" class="form-control" aria-required="" id="listaServicio">
                                                                                            <option value="">--Seleccione--</option>
                                                                                            <?php while ($row = $resultadoServicio->fetch_assoc()) { ?>
                                                                                                <option value="<?php echo $row['idService']; ?>"><?php echo $row['nameService']; ?></option>
                                                                                            <?php }   ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-6" style="margin-left: 0;">
                                                                                    <div class="form-group">
                                                                                        <label for="idEmpleado">Empleado</label>
                                                                                        <select name="empleado" class="form-control" aria-required="" id="listaEmpleado">
                                                                                            <option value="">--Seleccione--</option>
                                                                                            <?php while ($row = $resultadoEmpleado->fetch_assoc()) { ?>
                                                                                                <option value="<?php echo $row['idEmployee']; ?>"><?php echo $row['nameEmployee']; ?></option>
                                                                                            <?php }   ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>


                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label for="descriptionSale" class="form-label">Descripción</label>
                                                                                <textarea class="form-control" id="descriptionSale" rows="3"></textarea>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-3" style="margin-left: 0;">
                                                                                    <div class="form-group">
                                                                                        <label for="idSupply">Insumo</label>
                                                                                        <select name="insumo" class="form-control" aria-required="" id="listaInsumo">
                                                                                            <option value="">--Seleccione--</option>
                                                                                            <?php while ($row = $resultadoInsumo->fetch_assoc()) { ?>
                                                                                                <option value="<?php echo $row['idSupply']; ?>"><?php echo $row['nameSupply']; ?></option>
                                                                                            <?php }   ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-3" style="margin-left: 0;">
                                                                                    <div class="form-group">
                                                                                        <label for="cantidad">Cantidad</label>
                                                                                        <input onkeyup="calcularValorTotal()" name="cantidadAgregar" type="number" class="form-control" id="cantidadAgregar">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-3" style="margin-left: 0;">
                                                                                    <div class="form-group">
                                                                                        <label for="cantidad">V. Unitario</label>
                                                                                        <input onkeyup="calcularValorTotal()" name="v_unitario" type="number" class="form-control" id="v_unitario">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-3" style="margin-left: 0;">
                                                                                    <div class="form-group">
                                                                                        <label for="cantidad">Total</label>
                                                                                        <input name="v_total" type="number" disabled style="background:white" class="form-control" id="v_total">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <div class="form-footer">
                                                                                <button type="button" onclick="agregarInsumo()" class="btn btn-primary">Agregar</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <!-- /.card-header -->
                                                                    <div class="card-body p-0">
                                                                        <table id="tableVentas" class="table table-hover">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th style="width: 10px">Id</th>
                                                                                    <th>Insumos</th>
                                                                                    <th>Cantidad</th>
                                                                                    <th>V. Unitario</th>
                                                                                    <th>Total</th>
                                                                                    <th>Acción</th>
                                                                                </tr>
                                                                            </thead>
                                                                        </table>
                                                                    </div>
                                                                    <div>
                                                                        <div class="modal-footer">
                                                                            <!-- <button type="button" class="btn btn-danger"
                                                                            data-dismiss="modal">Limpiar</button> -->
                                                                            <button type="button" onclick="registrarVenta()" data-dismiss="modal" id="guardaVentas" class="btn btn-primary">Guardar
                                                                                venta</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive mb-4">
                                                            <div class="d-flex justify-content-end p-4 pr-5">
                                                                <button class="btn btn-primary btn-sm" onclick="mostrar()">Nueva venta</button>
                                                            </div>
                                                            <table id="tableInsumos" class="table table-sm table-striped table-hover table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Factura</th>
                                                                        <th>Cliente</th>
                                                                        <th>Servicio</th>
                                                                        <th>Empleado</th>
                                                                        <th>Total</th>
                                                                        <th>Descripción</th>
                                                                        <th>Estado</th>
                                                                        <th>Acciones</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                </tbody>
                                                            </table>
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
            listar();
            listarInsumos();

        })
    </script>

    <script>
        function mostrar() {
            document.getElementById('showRegister').style.display = 'flex';
        }

        function ocultar() {
            document.getElementById('showRegister').style.display = 'none';
        }
    </script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.js"></script>

    <!-- Archivo APP ventas -->
    <script src="app/Venta.app.js"></script>
</body>

</html>

<!-- detalle de la venta -->
<div class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" id="detalleVenta" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark" >
                <h5 class="modal-title">Detalle de venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label for="id_sale_detail" class="col-sm-2 col-form-label">Id:</label>
                    <div class="col-sm-4">
                        <input type="text" readonly class="form-control-plaintext" id="id_sale_detail">
                    </div>

                    <label for="idClientDetail" class="col-sm-2 col-form-label">Cliente:</label>
                    <div class="col-sm-4">
                        <input type="text" readonly class="form-control-plaintext" id="idClientDetail">
                    </div>
                </div>

                <div class="row">
                    <label for="idServiceDetail" class="col-sm-2 col-form-label">Servicio:</label>
                    <div class="col-sm-4">
                        <input type="text" readonly class="form-control-plaintext" id="idServiceDetail">
                    </div>

                    <label for="idEmployeeDetail" class="col-sm-2 col-form-label">Empleado:</label>
                    <div class="col-sm-4">
                        <input type="text" readonly class="form-control-plaintext" id="idEmployeeDetail">
                    </div>
                </div>

                <div class="row">
                    <label for="totalDetail" class="col-sm-2 col-form-label">Total:</label>
                    <div class="col-sm-4">
                        <input type="text" readonly class="form-control-plaintext" id="totalDetail">
                    </div>

                    <label for="descriptionSaleDetail" class="col-sm-2 col-form-label">Descripción:</label>
                    <div class="col-sm-4">
                        <input type="text" readonly class="form-control-plaintext" id="descriptionSaleDetail">
                    </div>
                </div>

                <div class="row">
                    <label for="estadoDetail" class="col-sm-2 col-form-label">Estado:</label>
                    <div class="col-sm-4">
                        <input type="text" readonly class="form-control-plaintext" id="estadoDetail">
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table" id="tablaInsumos">
                        <thead>
                            <tr>
                                <th>Insumos</th>
                                <!-- <th>Precio</th> -->
                                <th>Cantidad</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

