<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "worksphere";
$port = 3306;

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

function query($sql) {
    global $conn;
    return mysqli_query($conn, $sql);
}

function escape($value) {
    global $conn;
    return mysqli_real_escape_string($conn, $value);
}
?>