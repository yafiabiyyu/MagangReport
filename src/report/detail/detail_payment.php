<?php
session_start();
include('../../../config.php');
if ($_SESSION['username'] == "") {
    echo "<script>alert('Maaf anda belum login');
    window.location='../../../index.html'</script>";
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql1 = "SELECT LOWER(CONCAT(cus.first_name,cus.last_name)) as nama_customer,LOWER(cus.email) as email,
    SUM(pay.amount) as total_paid, COUNT(pay.payment_id) as total_rental
    FROM payment as pay 
    INNER JOIN customer as cus on cus.customer_id = pay.customer_id WHERE cus.customer_id = '".$id."' ";
    $sql1_result = mysqli_query($host,$sql1);
    if (mysqli_num_rows($sql1_result) > 0) {
        $row = mysqli_fetch_assoc($sql1_result);
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Payment</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css" integrity="sha384-REHJTs1r2ErKBuJB0fCK99gCYsVjwxHrSU0N7I1zl9vZbggVJXRMsv/sLlOAGb4M" crossorigin="anonymous">

    <!-- Page level plugin CSS-->
    <link href="../../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../../css/sb-admin.css" rel="stylesheet">
</head>
<body id="page-top">
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
        <a href="../report_payment.php" class="navbar-brand mr-1">Kembali</a>
    </nav>
    <div id="wrapper">
        <div id="content-wrapper">
            <div class="container-fluid">
                <form action="">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="nama_cus">Nama Pelanggan</label>
                            <input type="text" class="form-control" value="<?php echo $row['nama_customer'];?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="email_cus">Email Pelanggan</label>
                            <input type="text" class="form-control"  value="<?php echo $row['email'];?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="nama_cus">Total Pembayaran</label>
                            <input type="text" class="form-control"  value="<?php echo $row['total_paid'];?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="nama_cus">Jumlah Transaksi</label>
                            <input type="text" class="form-control"  value="<?php echo $row['total_rental'];?>">
                        </div>
                    </div>
                </form>
                <div class="card mb-3">
                    <div class="card-header">
                        Detail Payment
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-border" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center">Payment ID</th>
                                        <th class="text-center">Judul Film</th>
                                        <th class="text-center">Durasi Sewa</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $get_payment = "SELECT p2.payment_id,LOWER(flm.title) as title,datediff(rent.return_date,rent.rental_date) as durasi_sewa
                                        from payment as p2
                                        join customer as cus on cus.customer_id = p2.customer_id 
                                        join rental as rent on rent.rental_id = p2.rental_id
                                        join inventory as inven on inven.inventory_id = rent.inventory_id
                                        join film as flm on flm.film_id = inven.film_id
                                        WHERE p2.customer_id = '".$id."' ORDER BY CONCAT(cus.first_name,cus.last_name)";
                                        $sql_result = mysqli_query($host,$get_payment);
                                        while($data = mysqli_fetch_assoc($sql_result)){
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $data['payment_id']; ?></td>
                                        <td class="text-center"><?php echo $data['title']; ?></td>
                                        <td class="text-center"><?php echo $data['durasi_sewa']; ?></td>
                                    </tr>
                                        <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../../vendor/jquery/jquery.min.js"></script>
    <script src="../../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="../../../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../../../vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../../js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="../../../js/demo/datatables-demo.js"></script>
</body>
</html>