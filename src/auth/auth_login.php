<?php
session_start();
require_once('../../config.php');
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $login_query = "SELECT * FROM pengguna where username = '".$username."' and password_user = '".$password."'";
    $sql_result = mssql_query($login_query);
    $admin_check = mssql_fetch_assoc($sql_result);
    $cek = mssql_num_rows($sql_result);
    if ($cek > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['admin_status'] = $admin_check['role'];
        echo "<script>alert('Selamat Datang');
        window.location='../home/dashboard.php'</script>";
    }else {
        echo "<script>alert('Gagal Login');
        window.location='../../index.html'</script>";
    }
}
?>