<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GLOBE | fumigaciones</title>

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
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Clientes</h1>
                        </div>
                    </div>
                </div>
            </div>


            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header d-flex justify-content-end">
                            <button data-toggle="modal" data-target="#registroCliente" class="btn btn-primary btn-sm">Nuevo cliente</button>
                            
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tableClientes" class="table table-sm table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Documento</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Correo</th>
                                        <th>Dirección</th>
                                        <th>Telefono</th>
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
                    <a href="reportes/reporte.clientes.php" target="_blank" class="btn btn-primary btn-sm">Ver reporte cliente</a>
                    

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
            listarClientes();
        })
    </script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.js"></script>

    <!-- Archivo APP clientes -->
    <script src="app/Cliente.app.js"></script>




    <!-- Funcionalidad de javascript del modulo Clientes -->
    <script src="app/Cliente.app.js"></script>


    <!-- Modal de registro -->
    <div class="modal fade" id="registroCliente" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title" id="staticBackdropLabel">Información del cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="documentClient">Documento</label>
                        <input type="number" class="form-control" id="documentClient" aria-describedby="emailHelp">
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nameClient">Nombre</label>
                                <input type="text" class="form-control" id="nameClient" aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="last_name">Apellidos</label>
                                <input type="text" class="form-control" id="last_name" aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Correo</label>
                                <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="address">Dirección</label>
                                <input type="text" class="form-control" id="address" aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="phone">Telefono</label>
                                <input type="number" class="form-control" id="phone" aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="stateClient">Estado</label>
                                <select class="form-control" id="stateClient" aria-describedby="emailHelp">
                                    <option value="1">Activo</option>
                                    <option value="0">Anular</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" onclick="registroCliente()" data-dismiss="modal" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal de editar-->
    <div class="modal fade" id="editarCliente" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title" id="staticBackdropLabel">Actualizar datos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <input type="hidden" name="id" class="form-control" id="idClientEditar">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="documentClientEditar">Documento</label>
                        <input type="number" class="form-control" id="documentClientEditar" aria-describedby="emailHelp">
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nameClient">Nombre</label>
                                <input type="text" class="form-control" id="nameClientEditar" aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="last_nameClient">Apellidos</label>
                                <input type="text" class="form-control" id="last_nameClientEditar" aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Correo</label>
                                <input type="email" class="form-control" id="emailClientEditar" aria-describedby="emailHelp">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="addressClientEditar">Dirección</label>
                                <input type="text" class="form-control" id="addressClientEditar" aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>
                        

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="phone">Telefono</label>
                                <input type="number" class="form-control" id="phoneClientEditar" aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="stateClient">Estado</label>
                                <select class="form-control" id="stateClientEditar" aria-describedby="emailHelp">
                                    <option value="1">Activo</option>
                                    <option value="0">Anular</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" onclick="editarCliente()" data-dismiss="modal" class="btn btn-primary">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>