<?php
session_start();

require_once('../../config.php');
$username = $_POST['username'];
$password = $_POST['password'];
$login_query = "SELECT * FROM pengguna where username = '".$username."' and password = '".$password."'";
$sql_result = mysqli_query($host,$login_query);

$cek = mysqli_num_rows($sql_result);
if ($cek > 0) {
    echo "<script>alert('Selamat Datang');
    window.location='../home/dashboard.php'</script>";
}else {
    echo "<script>alert('Selamat Datang');
    window.location='../../index.html'</script>";
}
?>