<?php
include 'DB.php';

$kode_lampu = $_GET['kode_lampu'];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Tabel Lampu
$sql = "SELECT * FROM tabel_simulasi WHERE kode_lampu = '$kode_lampu'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


echo $row['control'];
echo ",";
echo $row['ldr1'];
echo ",";
echo $row['ldr2'];
echo ",";
echo $row['jam_awal'];
echo ",";
echo $row['jam_akhir'];
echo ",";
echo $row['tegangan'];
echo ",";
echo $row['ldr1_threshold'];
echo ",";
echo $row['ldr2_threshold'];
echo ",";
echo $row['voltage_threshold'];
?>