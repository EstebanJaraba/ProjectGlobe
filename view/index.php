<?php

session_start();

if (!isset($_SESSION['userName'])) {
  header('location: ../indexLogin.php');
}
?>
<?php
require('http/db/conexion.php');

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
  <link rel="stylesheet" href="assets/plugins/uplot/uPlot.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
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
              <h1 class="m-0">Dashboard</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="inicio.php">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div>
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color:#58B6FA">
              <div class="inner">
                <?php
                $countP = "SELECT idPurchase FROM purchases ORDER BY idPurchase";
                $count_runP = mysqli_query($conexion, $countP);

                $rowP = mysqli_num_rows($count_runP);

                echo '<h3>' . $rowP . '<h3>';
                ?>

                <p>Compras</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>

            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: #6DE661">
              <div class="inner">
                <?php
                $count = "SELECT idUser FROM users ORDER BY idUser";
                $count_run = mysqli_query($conexion, $count);

                $row = mysqli_num_rows($count_run);

                echo '<h3>' . $row . '<h3>';
                ?>

                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="icon ion-stats-bars"></i>
              </div>

            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: #FAFF92">
              <div class="inner">

                <?php
                $count = "SELECT idUser FROM users ORDER BY idUser";
                $count_run = mysqli_query($conexion, $count);

                $row = mysqli_num_rows($count_run);

                echo '<h3>' . $row . '<h3>';
                ?>

                <p>Usuarios registrados</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>

            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: #FA8873">
              <div class="inner">
                <?php
                $count = "SELECT idUser FROM users ORDER BY idUser";
                $count_run = mysqli_query($conexion, $count);

                $row = mysqli_num_rows($count_run);

                echo '<h3>' . $row . '<h3>';
                ?>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>

            </div>
          </div>
          <!-- ./col -->
        </div>
      </div>


      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Usuarios</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <p class="card-text">
                  <canvas id="myChartUsers" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  <script>
                    const ctxUsers = document.getElementById('myChartUsers');
                    const myChartUsers = new Chart(ctxUsers, {
                      type: 'bar',
                      data: {
                        labels: [
                          <?php

                          $sql = "SELECT * FROM users";

                          $query = mysqli_query($conexion, $sql);

                          while ($row = mysqli_fetch_array($query)) {
                          ?> '<?php echo $row['userName'] ?>',
                          <?php
                          }

                          ?>

                        ],
                        datasets: [{
                          label: '# of Votes',
                          data: [
                            <?php

                            $sql = "SELECT * FROM users";

                            $query = mysqli_query($conexion, $sql);

                            while ($row = mysqli_fetch_array($query)) {
                            ?> '<?php echo $row['idUser'] ?>',
                            <?php
                            }

                            ?>
                          ],
                          backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                          ],
                          borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                          ],
                          borderWidth: 1
                        }]
                      },
                      options: {
                        scales: {
                          y: {
                            beginAtZero: true
                          }
                        }
                      }
                    });
                  </script>
                </p>

              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Compras vs Ventas</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">

                <p class="card-text">
                  <canvas id="myChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  <script>
                    const ctx = document.getElementById('myChart').getContext('2d');
                    const myChart = new Chart(ctx, {
                      type: 'doughnut',
                      data: {
                        labels: [<?php

                                  $sql = "SELECT * FROM users";

                                  $query = mysqli_query($conexion, $sql);

                                  while ($row = mysqli_fetch_array($query)) {
                                  ?> '<?php echo $row['userName'] ?>',
                          <?php
                                  }

                          ?>
                        ],
                        datasets: [{
                          label: '# of Votes',
                          data: [<?php

                                  $sql = "SELECT * FROM users";

                                  $query = mysqli_query($conexion, $sql);

                                  while ($row = mysqli_fetch_array($query)) {
                                  ?> '<?php echo $row['idUser'] ?>',
                            <?php
                                  }

                            ?>,
                          ],
                          backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                          ],
                          borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                          ],
                          borderWidth: 1
                        }]
                      },
                      // options: {
                      //   scales: {
                      //     y: {
                      //       beginAtZero: true
                      //     }
                      //   }
                      // }
                    });
                  </script>

                </p>

              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Compras</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">

                <p class="card-text">
                  <canvas id="myChartCompras" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  <script>
                    const ctxCompras = document.getElementById('myChartCompras');
                    const myChartCompras = new Chart(ctxCompras, {
                      type: 'bar',
                      data: {
                        labels: [
                          <?php

                          $sql = "SELECT * FROM purchases";

                          $query = mysqli_query($conexion, $sql);

                          while ($row = mysqli_fetch_array($query)) {
                          ?> '<?php echo $row['idPurchase'] ?>',
                          <?php
                          }

                          ?>
                        ],
                        datasets: [{
                          label: '# of Votes',
                          data: [12, 19, 3, 5, 2, 3],
                          backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                          ],
                          borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                          ],
                          borderWidth: 1
                        }]
                      },
                      options: {
                        scales: {
                          y: {
                            beginAtZero: true
                          }
                        }
                      }
                    });
                  </script>
                </p>

              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Ventas</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">

                <p class="card-text">
                  <canvas id="myChartVentas" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  <script>
                    const ctxVentas = document.getElementById('myChartVentas');
                    const myChartVentas = new Chart(ctxVentas, {
                      type: 'bar',
                      data: {
                        labels: [
                          <?php

                          $sql = "SELECT * FROM sales";

                          $query = mysqli_query($conexion, $sql);

                          while ($row = mysqli_fetch_array($query)) {
                          ?> '<?php echo $row['nameSale'] ?>',
                          <?php
                          }

                          ?>
                        ],
                        datasets: [{
                          label: '# of Votes',
                          data: [12, 19, 3, 5, 2, 3],
                          backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                          ],
                          borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                          ],
                          borderWidth: 1
                        }]
                      },
                      options: {
                        scales: {
                          y: {
                            beginAtZero: true
                          }
                        }
                      }
                    });
                  </script>
                </p>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Insumos</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <p class="card-text">
                  <canvas id="myChartInsumos" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  <script>
                    const ctxInsumos = document.getElementById('myChartInsumos');
                    const myChartInsumos = new Chart(ctxInsumos, {
                      type: 'bar',
                      data: {
                        labels: [
                          <?php

                          $sql = "SELECT * FROM supplys";

                          $query = mysqli_query($conexion, $sql);

                          while ($row = mysqli_fetch_array($query)) {
                          ?> '<?php echo $row['nameSupply'] ?>',
                          <?php
                          }

                          ?>
                        ],
                        datasets: [{
                          label: '# of Votes',
                          data: [
                            <?php

                            $sql = "SELECT * FROM supplys";

                            $queryId = mysqli_query($conexion, $sql);

                            while ($row = mysqli_fetch_array($queryId)) {
                            ?> '<?php echo $row['idSupply'] ?>',
                            <?php
                            }

                            ?>
                          ],
                          backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                          ],
                          borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                          ],
                          borderWidth: 2
                        }]
                      },
                      options: {
                        scales: {
                          y: {
                            beginAtZero: true
                          }
                        }
                      }
                    });
                  </script>
                </p>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Compras vs Ventas</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <div id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-wrapper -->


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
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
  <!-- <script src="assets/plugins/summernote/summernote-bs4.min.js"></script> -->
  <!-- overlayScrollbars -->
  <script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/dist/js/adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="assets/dist/js/pages/dashboard.js"></script>
  <!-- uPlot -->
  <script src="assets/plugins/uplot/uPlot.iife.min.js"></script>
  <!-- AdminLTE App -->
  <!-- <script src="assets/dist/js/adminlte.min.js"></script> -->



  <script>
    $(function() {
      /* uPlot
       * -------
       * Here we will create a few charts using uPlot
       */

      function getSize(elementId) {
        return {
          width: document.getElementById(elementId).offsetWidth,
          height: document.getElementById(elementId).offsetHeight,
        }
      }

      let data = [
        [0, 1, 2, 3, 4, 5, 6],
        [28, 48, 40, 19, 86, 27, 90],
        [65, 59, 80, 81, 56, 55, 40]
      ];

      //--------------
      //- AREA CHART -
      //--------------

      const optsAreaChart = {
        ...getSize('areaChart'),
        scales: {
          x: {
            time: false,
          },
          y: {
            range: [0, 100],
          },
        },
        series: [{},
          {
            fill: 'rgba(60,141,188,0.7)',
            stroke: 'rgba(60,141,188,1)',
          },
          {
            stroke: '#c1c7d1',
            fill: 'rgba(210, 214, 222, .7)',
          },
        ],
      };

      let areaChart = new uPlot(optsAreaChart, data, document.getElementById('areaChart'));


    })
  </script>
</body>

</html>