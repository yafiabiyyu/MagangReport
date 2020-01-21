<?php
include("../../config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin - Dashboard</title>

  <!-- Custom fonts for this template-->
  <!-- <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css" integrity="sha384-REHJTs1r2ErKBuJB0fCK99gCYsVjwxHrSU0N7I1zl9vZbggVJXRMsv/sLlOAGb4M" crossorigin="anonymous">

  <!-- Page level plugin CSS-->
  <link href="../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../../css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">
  <!-- start copy ke semua page -->
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1" href="dashboard.html">Report</a>
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
    <!-- Navbar -->
    <ul class="navbar-nav d-none d-md-inline-block ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>
  </nav>
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-fw fa-plus-square"></i>
          <span>Query</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Report</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <?php
            $get_report = "select * from report";
             $sql_result = mssql_query($get_report);
             while ($data = mssql_fetch_assoc($sql_result)) {
          ?>
           <a href="../report/report.php?id=<?php echo $data['id'];?>&status=<?php echo $data['filter_date_status'];?>" id="payment" class="dropdown-item"><?php echo $data['name_report']; ?></a>
             <?php $status = $data['id']; }?>
        </div>
      </li>
    </ul>
    <!-- end copy ke semua page -->

    <div id="content-wrapper">
      <div class="container-fluid">
        <!-- get pyment data -->
        <?php
          $sql = "select COUNT(order_id) as transaksi from sales.orders";
          $sql2 = "select COUNT(customer_id) as customer from sales.customers";
          $sql3 = "select COUNT(store_id) as jml_toko from sales.stores";
          $result = mssql_query($sql);
          $result2 = mssql_query($sql2);
          $result3 = mssql_query($sql3);
          $row = mssql_fetch_assoc($result);
          $row2 = mssql_fetch_assoc($result2);
          $row3 = mssql_fetch_assoc($result3);

        ?>
        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-4 col-sm-6 mb-4">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="mr-5"><?php echo round($row['transaksi']);?> Transaksi</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
              </a>
            </div>
          </div>
          <div class="col-xl-4 col-sm-6 mb-4">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="mr-5"><?php echo round($row3['jml_toko']);?> Store</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
              </a>
            </div>
          </div>
          <div class="col-xl-4 col-sm-6 mb-4">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-users"></i>
                </div>
                <div class="mr-5"><?php echo round($row2['customer']);?> Customer</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
              </a>
            </div>
          </div>
        </div>

        <!-- Area Chart Example-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Chart Transaksi Harian</div>
          <div class="card-body">
            <canvas id="myAreaChart" width="100%" height="30"></canvas>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Your Website 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <script src="../../vendor/jquery/jquery.min.js"></script>
  <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="../../vendor/chart.js/Chart.min.js"></script>
  <script src="../../vendor/datatables/jquery.dataTables.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../../js/sb-admin.min.js"></script>

  <!-- script php untuk chart -->
  <?php
    $tx_harian = mssql_query("select DAY(order_date) as hari from sales.orders GROUP BY DAY(order_date)");
    $hari = mssql_query("select COUNT(order_id) as tx_hari from sales.orders GROUP BY DAY(order_date)");
  ?>
  <script>
    // Set new default font family and font color to mimic Bootstrap's default styling
      Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
      Chart.defaults.global.defaultFontColor = '#292b2c';

      // Area Chart Example
      var ctx = document.getElementById("myAreaChart").getContext('2d');
      var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: [<?php while ($b = mssql_fetch_array($hari)) { echo '"' . $b['hari'] . '",';}?>],
          datasets: [{
            label: "Transaksi",
            lineTension: 0.3,
            backgroundColor: "rgba(2,117,216,0.2)",
            borderColor: "rgba(2,117,216,1)",
            pointRadius: 5,
            pointBackgroundColor: "rgba(2,117,216,1)",
            pointBorderColor: "rgba(255,255,255,0.8)",
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(2,117,216,1)",
            pointHitRadius: 50,
            pointBorderWidth: 2,
            data: [<?php while ($b = mssql_fetch_array($tx_harian)) { echo '"' . $b['tx_hari'] . '",';}?>],
          }],
        },
        options: {
          scales: {
            xAxes: [{
              time: {
                unit: 'date'
              },
              gridLines: {
                display: false
              },
              ticks: {
                maxTicksLimit: 7
              }
            }],
            yAxes: [{
              ticks: {
                min: 0,
                max: 1000,
                maxTicksLimit: 10
              },
              gridLines: {
                color: "rgba(0, 0, 0, .125)",
              }
            }],
          },
          legend: {
            display: true
          },
          title:{
            display: true,
            text:"Tanggal",
            position: 'bottom'
          }
        }
      });
  </script>

</body>

</html>
