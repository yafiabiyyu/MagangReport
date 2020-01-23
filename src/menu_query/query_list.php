<?php
include('../../config.php');
session_start();
if ($_SESSION['username'] == "") {
    echo "<script>alert('Maaf anda belum login');
    window.location='../../index.html'</script>";
}
if (isset($_GET['delete'])) {
  $iddel = $_GET['delete'];
  $sql = "update report set delete_status = 1 where id =".$iddel;
  $deletquery = mssql_query($sql);
  if ($deletquery) {
    echo "<script>alert('Data berhasil dihapus');
    window.location='query_list.php'</script>";
  }else{
    echo "<script>alert('Data gagal dihapus');
    window.location='query_list.php'</script>";
  }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report</title>
  <!-- Custom fonts for this template-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css" integrity="sha384-REHJTs1r2ErKBuJB0fCK99gCYsVjwxHrSU0N7I1zl9vZbggVJXRMsv/sLlOAGb4M" crossorigin="anonymous">

<!-- Page level plugin CSS-->
<link href="../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="../../css/sb-admin.css" rel="stylesheet">
</head>
<body id="page-top">
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
          <a class="dropdown-item" href="../auth/auth_logout.php" data-toggle="modal" data-target="#logoutModal">Logout</a>
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
        <a class="nav-link" href="../menu_query/query_list.php">
          <i class="fas fa-fw fa-plus-square"></i>
          <span>Query</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="../home/dashboard.php" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Report</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
        <?php
            $get_report = "select * from report where delete_status = 0";
             $sql_result = mssql_query($get_report);
             while ($data = mssql_fetch_assoc($sql_result)) {
               
          ?>
          <a href="../report/report.php?id=<?php echo $data['id'];?>&status=<?php echo $data['filter_date_status'];?>" id="payment" class="dropdown-item"><?php echo $data['name_report']; ?></a>
             <?php $status = $data['id']; }?>
        </div>
      </li>
    </ul>
    <div id="content-wrapper">
        <div class="container-fluid">
            <div class="card-mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Data Query
                </div>
                <div class="card-body">
                    <a href="add_query.php" class="btn btn-primary form-group">Add Query</a>
                    <div class="table-responsive">
                        <table class="table table-border display" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Report Name</th>
                                    <th class="text-center">Report Query</th>
                                    <th class="text-center">Query Filter</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $querysql = "SELECT * FROM report where delete_status = 0";
                                    $query_result = mssql_query($querysql);
                                    while ($data = mssql_fetch_assoc($query_result)) {
                                ?>
                                <tr>
                                    <td><?php echo $data['id']?></td>
                                    <td><?php echo $data['name_report']?></td>
                                    <td><?php echo $data['report_query']?></td>
                                    <td><?php echo $data['filter_query']?></td>
                                    <td>
                                    <a href="edit_query.php?id=<?php echo $data['id'] ?>" class="btn btn-info">Edit</a>
                                    <br>
                                    <br>
                                    <a href="query_list.php?delete=<?php echo $data['id'] ?>" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
            <a class="btn btn-primary" href="../auth/auth_logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="../../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin.min.js"></script>
    <script src="../../js/moment.js"></script>

    <!-- Demo scripts for this page-->
    <script src="../../js/demo/datatables-demo.js"></script>
</body>
</html>