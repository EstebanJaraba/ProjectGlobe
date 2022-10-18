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
              <div class="row">
                <div class="col-6">
                  <form id="registerPurchase" >
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
                    <div class="mb-3" style="margin-left: 0;">
                      <div class="form-group">
                        <label for="statePurchase">Estado</label>
                        <select class="form-control" id="statePurchase" aria-describedby="">
                          <option value="">---</option>
                          <option value="0">PENDIENTE</option>
                          <option value="1">EN COBRO</option>
                          <option value="2">PAGADO</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-footer">
                      <button type="button" onclick="registerPurchase()" class="btn btn-primary">Guardar</button>
                    </div>
                  </form>
                </div>
                <div class="col-6">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Insumos</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <table class="table table-sm">
                        <thead>
                          <tr>
                            <th style="width: 10px">ID</th>
                            <th>Nombre</th>
                            <th>Número de parte</th>
                            <th style="width: 40px">Cantidad</th>
                            <th>Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1.</td>
                            <td>Update software</td>
                            <td>
                              <div class="progress progress-xs">
                                <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                              </div>
                            </td>
                            <td><span class="badge bg-danger">55%</span></td>
                            <td><span class="badge bg-danger">30%</span></td>
                          </tr>
                          <tr>
                            <td>2.</td>
                            <td>Clean database</td>
                            <td>
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-warning" style="width: 70%"></div>
                              </div>
                            </td>
                            <td><span class="badge bg-warning">70%</span></td>
                            <td><span class="badge bg-danger">2%</span></td>
                          </tr>
                          <tr>
                            <td>3.</td>
                            <td>Cron job running</td>
                            <td>
                              <div class="progress progress-xs progress-striped active">
                                <div class="progress-bar bg-primary" style="width: 30%"></div>
                              </div>
                            </td>
                            <td><span class="badge bg-primary">30%</span></td>
                            <td><span class="badge bg-success">100%</span></td>
                          </tr>
                          <tr>
                            <td>4.</td>
                            <td>Fix and squish bugs</td>
                            <td>
                              <div class="progress progress-xs progress-striped active">
                                <div class="progress-bar bg-success" style="width: 90%"></div>
                              </div>
                            </td>
                            <td><span class="badge bg-success">90%</span></td>
                            <td><span class="badge bg-danger">4%</span></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                </div>
              </div>

            </div>

          </div>
        </div>
      </section>
      <section class="content">
        <div id="container-fluid">
          <div class="card">
            <div class="card-body">
              <section class="content">
                <div id="container-fluid">
                  <div class="card">
                    <div class="card-body">
                      <table id="tablePurchases" class="table table-sm table-striped">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Proveedor</th>
                            <th>Insumo</th>
                            <th>Descripción</th>
                            <th>Precio</th>
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
              </section>
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
    listarCompras();
  })
</script>

</html>


<!-- Modal Register-->
<!-- <div class="modal fade" id="registerPurchase" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h5 class="modal-title" id="exampleModalLabel">Registro Compra</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group">
          <label for="namePurchase">Nombre</label>
          <input type="text" class="form-control" id="namePurchase" aria-describedby="">
        </div>

        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label for="dateEntregaPurchase">Direccion de entrega</label>
              <input type="text" class="form-control" id="dateEntregaPurchase" aria-describedby="">
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="datePedidoPurchase">Direccion de pedido</label>
              <input type="text " class="form-control" id="datePedidoPurchase" aria-describedby="">
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
                  <option value="<?php echo $row['idSupplier']; ?>"><?php echo $row['name']; ?></option>
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
        <div class="form-group">
          <label for="dateExpiracionPurchase">Fecha de expiración</label>
          <input type="date" class="form-control" id="dateExpiracionPurchase" aria-describedby="">
        </div>
        <div class="col-12" style="margin-left: 0;">
          <div class="form-group">
            <label for="statePurchase">Estado</label>
            <select class="form-control" id="statePurchase" aria-describedby="">
              <option value="0">PENDIENTE</option>
              <option value="1">EN COBRO</option>
              <option value="2">PAGADO</option>
            </select>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" onclick="registerPurchase()" class="btn btn-primary" data-dismiss="modal">Guardar</button>
      </div>
    </div>
  </div>
</div> -->
<!-- Modal update -->
<!-- <div class="modal fade" id="updatePurchase" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Usuario</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <input type="hidden" class="form-control" id="idPurchaseUpdate" aria-describedby="">
      <div class="modal-body">
        <div class="form-group">
          <label for="namePurchaseUpdate">Nombre</label>
          <input type="text" class="form-control" id="namePurchaseUpdate" aria-describedby="">
        </div>

        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label for="dateEntregaPurchaseUpdate">Direccion de entrega</label>
              <input type="date" class="form-control" id="dateEntregaPurchaseUpdate" aria-describedby="">
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="datePedidoPurchaseUpdate">Direccion de pedido</label>
              <input type="date" class="form-control" id="datePedidoPurchaseUpdate" aria-describedby="">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-6" style="margin-right: 0;">
            <div class="form-group">
              <label for="proveedorPurchaseUpdate">Proveedor</label>
              <select class="form-control" id="proveedorPurchaseUpdate" aria-describedby="">
                <option value="">---</option>
                <?php while ($row = $resultadoProveedor->fetch_assoc()) { ?>
                  <option value="<?php echo $row['idSupplier']; ?>"><?php echo $row['name']; ?></option>
                <?php }   ?>
              </select>
            </div>
          </div>

          <div class="col-6" style="margin-left: 0;">
            <div class="form-group">
              <label for="insumoPurchaseUpdate">Insumo</label>
              <select class="form-control" id="insumoPurchaseUpdate" aria-describedby="">
                <option value="">---</option>
                <?php while ($row = $resultadoCompras->fetch_assoc()) { ?>
                  <option value="<?php echo $row['idSupply']; ?>"><?php echo $row['nameSupply']; ?></option>
                <?php }   ?>
              </select>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="dateExpiracionPurchaseUpdate">Fecha de expiración</label>
          <input type="date" class="form-control" id="dateExpiracionPurchaseUpdate" aria-describedby="">
        </div>
        <div class="col-12" style="margin-left: 0;">
          <div class="form-group">
            <label for="statePurchaseUpdate">Estado</label>
            <select class="form-control" id="statePurchaseUpdate" aria-describedby="">
              <option value="0">PENDIENTE</option>
              <option value="1">EN COBRO</option>
              <option value="2">PAGADO</option>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="updatePurchase()" class="btn btn-primary" data-dismiss="modal">Guardar cambios</button>
      </div>
    </div>
  </div>
</div> -->