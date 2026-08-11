<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "simikesu";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {

    die("Koneksi database gagal : " . mysqli_connect_error());

}

// Mengatur timezone Indonesia
date_default_timezone_set("Asia/Jakarta");

?>