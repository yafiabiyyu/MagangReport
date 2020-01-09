<?php
session_start();
require_once('../../config.php');
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $login_query = "SELECT * FROM staff where username = '".$username."' and password = '".$password."'";
    $sql_result = mysqli_query($host,$login_query);
    $cek = mysqli_num_rows($sql_result);
    if ($cek > 0) {
        $_SESSION['username'] = $username;
        echo "<script>alert('Selamat Datang');
        window.location='../home/dashboard.php'</script>";
    }else {
        echo "<script>alert('Gagal Login');
        window.location='../../index.html'</script>";
    }
}
?>