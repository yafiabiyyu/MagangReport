<?php
include('../../../config.php');
session_start();
if ($_SESSION['username'] == "") {
    echo "<script>alert('Maaf anda belum login');
    window.location='../../../index.html'</script>";
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_detail = 'SELECT cus.customer_id, LOWER(CONCAT(cus.first_name,cus.last_name)) as nama_customer,
    LOWER(cus.email) as email,addr.phone,
    IF(cus.active = 1,"Aktif","Tidak Aktif") as status, addr.address as alamat_1,
    addr.address2 as alamat_2, addr.district, cit.city,addr.postal_code,con.country from customer as cus
    JOIN address as addr on addr.address_id = cus.address_id
    JOIN city as cit on cit.city_id = addr.city_id
    JOIN  country as con on con.country_id = cit.country_id WHERE cus.customer_id = '.$id.' ';
    $sql_result = mysqli_query($host,$sql_detail);
    if (mysqli_num_rows($sql_result)) {
        $row = mysqli_fetch_assoc($sql_result);
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Customer</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css" integrity="sha384-REHJTs1r2ErKBuJB0fCK99gCYsVjwxHrSU0N7I1zl9vZbggVJXRMsv/sLlOAGb4M" crossorigin="anonymous">

    <!-- Page level plugin CSS-->
    <link href="../../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../../css/sb-admin.css" rel="stylesheet">
</head>
<body id="page-top">
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
        <a href="../report_customer.php" class="navbar-brand mr-1">Kembali</a>
    </nav>
    <div id="wrapper">
        <div id="content-wrapper">
            <div class="container-fluid">
                <div class="card mb-3">
                    <div class="card-header">
                        Detail Customer
                    </div>
                    <div class="card-body">
                        <form action="">
                           <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="customer_id">Customer ID</label>
                                    <input type="text" class="form-control" id="customer_id" readonly="readonly" value="<?php echo $row['customer_id'];?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="status">Status</label>
                                    <input type="text" class="form-control" id="customer_id" readonly="readonly" value="<?php echo $row['status'];?>">
                                </div>
                           </div>
                           <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="customer_name">Nama Customer</label>
                                    <input type="text" class="form-control" id="customer_name" readonly="readonly" value="<?php echo $row['nama_customer'];?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" readonly="readonly" value="<?php echo $row['email'];?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" readonly="readonly" value="<?php echo $row['phone'];?>">
                                </div>
                           </div>
                           <div class="form-group">
                                <label for="address1">Address</label>
                                <input type="text" class="form-control" id="address1" readonly="readonly" value="<?php echo $row['alamat_1'];?>">
                           </div>
                           <div class="form-group">
                                <label for="address2">Address 2</label>
                                <input type="text" class="form-control" id="address2" readonly="readonly" value="<?php echo $row['alamat_2'];?>">
                           </div>
                           <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="daerah">District</label>
                                    <input type="text" class="form-control" id="daerah" readonly="readonly" value="<?php echo $row['district'];?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="kota">Kota</label>
                                    <input type="text" class="form-control" id="kota" readonly="readonly" value="<?php echo $row['city'];?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="kodepos">Postal Code</label>
                                    <input type="text" class="form-control" id="kodepos" readonly="readonly" value="<?php echo $row['postal_code'];?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="negara">Country</label>
                                    <input type="text" class="form-control" id="negara" readonly="readonly" value="<?php echo $row['country'];?>">
                                </div>
                           </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>