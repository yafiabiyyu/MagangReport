<?php
// $servername = "127.0.0.1";
// $database = "sakila";
// $username = "yafiabiyyu";
// $password = "yafi2105";

// $host = mysqli_connect($servername,$username,$password,$database);
// if (!$host) {
//     die('Koneksi ke serber gagal: '.mysqli_connect_error());
// }
$sql_server = 'egServer70';
$sql_username = 'SA';
$sql_password='#Scoutgalasta23';
$sql_database = 'BikeStores';
$conn = mssql_connect($sql_server,$sql_username,$sql_password) or die("Couldn't connect to sql server on $SITS_server");
$selected = mssql_select_db($sql_database,$conn);
?>