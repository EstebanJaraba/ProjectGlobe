<?php

session_start();

if (!isset($_SESSION['userName'])) {
  header('location: ../indexLogin.php');
}

?>

<?php

require('http/db/conexion.php');

$queryProveedor = "SELECT * FROM suppliers";
$queryCompras = "SELECT * FROM supplys";
$resultadoProveedor = mysqli_query($conexion, $queryProveedor);
$resultadoCompras = mysqli_query($conexion, $queryCompras);
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
              <h1 class="m-0">Compras</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="inicio.php">Home</a></li>
                <li class="breadcrumb-item active">Compras</li>
              </ol>
            </div>
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
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
                            <div class="row m-2">
                              <div class="col-6">
                                <div class="card">
                                  <div class="card-header">
                                    <h3 class="card-title">Registrar compra</h3>
                                  </div>
                                  <div class="card-body">
                                    <form id="registroProducto">
                                      <div class="row">
                                        <div class="col-5">
                                          <div class="form-group">
                                            <label for="nombre">Numero de factura</label>
                                            <input name="descripcion" type="text" placeholder="Ingrese numero de factura" class="form-control" id="facturaCompra">
                                          </div>
                                        </div>
                                        <div class="col-7">
                                          <div class="form-group">
                                            <label for="total">Total</label>
                                            <p class="form-label h1" id="totalCompra">000000</p>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-6" style="margin-right: 0;">
                                          <div class="form-group">
                                            <label for="proveedorPurchase">Proveedor</label>
                                            <select class="form-control" id="proveedorPurchase" aria-describedby="">
                                              <option value="">---</option>
                                              <?php while ($row = $resultadoProveedor->fetch_assoc()) { ?>
                                                <option value="<?php echo $row['idSupplier']; ?>"><?php echo $row['nameSupplier']; ?></option>
                                              <?php }   ?>
                                            </select>
                                          </div>
                                        </div>

                                        <div class="col-6" style="margin-left: 0;">
                                          <div class="form-group">
                                            <label for="insumoPurchase">Insumo</label>
                                            <select class="form-control" id="insumoPurchase" aria-describedby="">
                                              <option value="">---</option>
                                              <?php while ($row = $resultadoCompras->fetch_assoc()) { ?>
                                                <option value="<?php echo $row['idSupply']; ?>"><?php echo $row['nameSupply']; ?></option>
                                              <?php }   ?>
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="mb-3">
                                        <label for="descriptionPurchase" class="form-label">Descripción</label>
                                        <textarea class="form-control" id="descriptionPurchase" rows="3"></textarea>
                                      </div>
                                      <div class="row">
                                        <div class="col-4">
                                          <label for="cantidad">Cantidad</label>
                                          <input onkeyup="calcularValorTotal()" name="cantidadAgregar" type="number" class="form-control" id="cantidadAgregar">
                                        </div>
                                        <div class="col-4">
                                          <label for="cantidad">V. Unitario</label>
                                          <input onkeyup="calcularValorTotal()" name="v_unitario" type="number" class="form-control" id="v_unitario">
                                        </div>
                                        <div class="col-4">
                                          <label for="cantidad">V. Total</label>
                                          <input name="v_total" type="number" disabled style="background:white" class="form-control" id="v_total">
                                        </div>
                                      </div>
                                      <div>
                                        <div class="modal-footer">
                                          <button type="button" onclick="agregarProducto()" data-dismiss="modal" class="btn btn-primary">Agregar</button>
                                        </div>
                                      </div>

                                    </form>
                                  </div>

                                </div>

                                <!-- <form id="registroProducto">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Registrar
                                      Compra
                                    </h5>
                                  </div>
                                  <div class="row">
                                    <div class="col-5">
                                      <div class="form-group">
                                        <label for="nombre">Numero de factura</label>
                                        <input name="descripcion" type="text" placeholder="Ingrese numero de factura" class="form-control" id="facturaCompra">
                                      </div>
                                    </div>
                                    <div class="col-7">
                                      <div class="form-group">
                                        <label for="total">Total</label>
                                        <p class="form-label h2" id="totalCompra">000000</p>
                                      </div>
                                    </div>
                                  </div>
                                  <div>
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Proveedor</label>
                                      <select name="proveedor" class="form-control" required aria-required="" id="listaProveedor">
                                        <option value="0">Seleccione un proveedor</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-12">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Producto</label>
                                        <select name="producto" class="form-control" id="listaProducto">
                                          <option value="0">Seleccione un producto
                                          </option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-4">
                                      <label for="cantidad">Cantidad</label>
                                      <input onkeyup="calcularValorTotal()" name="cantidadAgregar" type="number" class="form-control" id="cantidadAgregar">
                                    </div>
                                    <div class="col-4">
                                      <label for="cantidad">V. Unitario</label>
                                      <input onkeyup="calcularValorTotal()" name="v_unitario" type="number" class="form-control" id="v_unitario">
                                    </div>
                                    <div class="col-4">
                                      <label for="cantidad">V. Total</label>
                                      <input name="v_total" type="number" disabled style="background:white" class="form-control" id="v_total">
                                    </div>
                                  </div>
                                  <div>
                                    <div class="modal-footer">
                                      <button type="button" onclick="agregarProducto()" data-dismiss="modal" class="btn btn-primary">Agregar</button>
                                    </div>
                                  </div>
                                </form> -->
                              </div>
                              <div class="col-6">

                                <div class=" scroll">
                                  <div class="card">
                                    <div class="card-header">
                                      <h3 class="card-title">Insumos</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0">
                                      <table class="table table-sm" id="tablaCompras">
                                        <thead>
                                          <tr>
                                            <th style="width: 10px">ID</th>
                                            <th>Nombre</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Total</th>
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
                                <div>
                                  <div class="modal-footer">
                                    <button type="button" onclick="registrarCompra()" data-dismiss="modal" id="guardaCompras" class="btn btn-primary">Guardar</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card-body">
                            <div class="table-responsive mb-4">
                              <div class="d-flex justify-content-end p-4 pr-5">
                                <button class="btn btn-primary btn-sm" onclick="mostrar()">Nueva compra</button>
                              </div>
                              <table id="tablePurchases" class="table table-sm table-striped table-hover table-bordered">
                                <thead>
                                  <tr>
                                    <th>Factura</th>
                                    <th>Proveedor</th>
                                    <th>Descripción</th>
                                    <th>Total</th>
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
  <script src="app/purchases.app.js"></script>
</body>

<script>
  $(document).ready(function() {
    listar();
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

</html>