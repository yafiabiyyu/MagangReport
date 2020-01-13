<?php
include('../../config.php');
session_start();
if ($_SESSION['username'] == "") {
    echo "<script>alert('Maaf anda belum login');
    window.location='../../index.html'</script>";
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report | Payment</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css" integrity="sha384-REHJTs1r2ErKBuJB0fCK99gCYsVjwxHrSU0N7I1zl9vZbggVJXRMsv/sLlOAGb4M" crossorigin="anonymous">

    <!-- Page level plugin CSS-->
    <link href="../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin.css" rel="stylesheet">
</head>
<body id="page-top">
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
        <a href="../home/dashboard.php" class="navbar-brand mr-1">Report</a>
        <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <!-- Navbar -->
        <ul class="navbar-nav d-none d-md-inline-block ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <li class="nav-item dropdown no-arrow">
                <a href="#" class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-hashpopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle fa-fw"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- start wrapper -->
    <div id="wrapper">
        <ul class="sidebar navbar-nav">
            <li class="nav-item active">
                <a href="../home/dashboard.php" class="nav-link">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Report</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a href="../report/report_payment.php" class="dropdown-item">Payment</a>
                    <a href="../report/report_customer.php" class="dropdown-item">Customer</a>
                </div>
            </li>
        </ul>

        <!-- start content-wrapper -->
        <div id="content-wrapper">
            <!-- start container-fluid -->
            <div class="container-fluid">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Data Payment
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-border" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center">Payment ID</th>
                                        <th class="text-center">Nama Customer</th>
                                        <th class="text-center">Total USD</th>
                                        <th class="text-center">Tanggal transaksi</th>
                                        <th class="text-center">Detail</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $get_payment = 'select pay.payment_id,cus.customer_id,LOWER(CONCAT(cus.first_name,cus.last_name)) as nama_cus,
                                        SUM(pay.amount) as total_belanja,DATE_FORMAT(pay.payment_date,"%m/%d/%Y") as tanggal_transaksi
                                        from payment as pay
                                        join customer as cus on cus.customer_id = pay.customer_id GROUP BY cus.first_name,cus.last_name
                                        ORDER BY cus.last_name ASC';
                                        $sql_result = mysqli_query($host,$get_payment);
                                        while($data = mysqli_fetch_assoc($sql_result)){
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $data['payment_id']; ?></td>
                                        <td class="text-center"><?php echo $data['nama_cus']; ?></td>
                                        <td class="text-center"><?php echo $data['total_belanja']; ?></td>
                                        <td class="text-center"><?php echo $data['tanggal_transaksi']; ?></td>
                                        <td class="text-center">
                                            <a href="detail/detail_payment.php?id=<?php echo $data['customer_id']; ?>" class="btn btn-info">Detail Payment</a>
                                        </td>
                                    </tr>
                                        <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end content-wrapper -->
    </div>
    <!-- end wrapper -->
    <a href="#page-top" class="scroll-to-top rounded">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Start logout modal -->
    <div class="modal fade" id="logoutModal" tabinde="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-xontent">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session_start</div>
                <div class="modal-footer">
                    <button class="btn btnsecondary" type="button" data-dismiss="modal">Cancel</button>
                    <a href="../../index.html" class="btn btn-primary">Logout</a>
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
    <script src="../../vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="../../js/demo/datatables-demo.js"></script>
</body>
</html>