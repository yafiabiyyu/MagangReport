<?php
include('../../config.php');
session_start();
if ($_SESSION['username'] == "") {
    echo "<script>alert('Maaf anda belum login');
    window.location='../../index.html'</script>";
}
if (isset($_POST['submit'])) {
  $nama_query = $_POST['nama_query'];
  $query_utama = $_POST['query_main'];
  $filter_status = $_POST['query_status'];
  $query_filter = $_POST['query_filter'];
  $sql = "INSERT INTO report(name_report,report_query,filter_query,filter_date_status) VALUES('".$nama_query."','".$query_utama."','".$query_filter."','".$filter_status."')";
  $saveResult = mssql_query($sql);
  if ($saveResult) {
    echo "<script>alert('Query berhasil ditambahkan');
      window.location='../home/dashboard.php'</script>";
  }else{
    echo "<script>alert('Query gagal ditambahkan');
      window.location='../home/dashboard.php'</script>";
  }
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Query Filter</title>
     <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css" integrity="sha384-REHJTs1r2ErKBuJB0fCK99gCYsVjwxHrSU0N7I1zl9vZbggVJXRMsv/sLlOAGb4M" crossorigin="anonymous">

<!-- Page level plugin CSS-->
    <link href="../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

<!-- Custom styles for this template-->
    <link href="../../css/sb-admin.css" rel="stylesheet">
</head>
<body id="page-top">
<!-- start copy ke semua page -->
<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1" href="../home/dashboard.html">Report</a>
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
        <a class="nav-link" href="../home/dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="../report/add_query.php">
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
        <form action="" method="post">
          <div class="form-group col-md-5">
              <label for="queryName">Nama Query</label>
              <input type="text" name="nama_query" class="form-control">
              <p> <strong>Info!</strong> Gunakan huruf kapital diawal kalimat.</p>
          </div>
          <div class="form-group col-md-5">
              <label for="query">Query Utama</label>
              <textarea name="query_main" id="" cols="10" rows="5" class="form-control"></textarea>
          </div>
          <div class="form-group col-md-5">
            <label for="filterQuery">Memiliki filter tanggal?</label>
            <select name="query_status" id="queryfilter" class="form-control">
            <option value="">---</option>
              <option value="1">Ya</option>
              <option value="0">Tidak</option>
            </select>
          </div>
          <div class="form-group col-md-5" id="datefilter">
              <label for="query">Query Filter</label>
              <textarea name="query_filter" id="" cols="10" rows="5" class="form-control"></textarea>
          </div>
          <div class="form-group col-md-5">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
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
  <script>
    $(document).ready(function(){
      $('#datefilter').hide();
      $('#queryfilter').change(function(){
        if ($('#queryfilter').val() == '1') {
          $('#datefilter').show();
        }else{
          $('#datefilter').hide();
        }
      });
    });
  </script>
</html>