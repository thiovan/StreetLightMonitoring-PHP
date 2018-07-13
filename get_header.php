<?php
include 'DB.php';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Get Jumlah Lampu
$sql = "SELECT * FROM tabel_lampu";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $jumlah_lampu = mysqli_num_rows($result);
} else {
    $jumlah_lampu = 0;
}

$lampu_nyala = 0;
$lampu_mati = 0;
$lampu_rusak = 0;

$sql = "SELECT * FROM `tabel_rekap` WHERE `kode_lampu`='6001940C1073' ORDER BY id_rekap DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if ($row['status'] == 1) {
	$lampu_nyala = $lampu_nyala + 1;
}
if ($row['status'] == 0) {
	$lampu_mati = $lampu_mati + 1;
}
if ($row['kondisi'] == 0) {
	$lampu_rusak = $lampu_rusak + 1;
}

$sql = "SELECT * FROM `tabel_rekap` WHERE `kode_lampu`='5CCF7FEEE2D3' ORDER BY id_rekap DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if ($row['status'] == 1) {
	$lampu_nyala = $lampu_nyala + 1;
}
if ($row['status'] == 0) {
	$lampu_mati = $lampu_mati + 1;
} 
if ($row['kondisi'] == 0) {
	$lampu_rusak = $lampu_rusak + 1;
}

$sql = "SELECT * FROM `tabel_rekap` WHERE `kode_lampu`='A020A61883C9' ORDER BY id_rekap DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if ($row['status'] == 1) {
	$lampu_nyala = $lampu_nyala + 1;
}
if ($row['status'] == 0) {
	$lampu_mati = $lampu_mati + 1;
} 
if ($row['kondisi'] == 0) {
	$lampu_rusak = $lampu_rusak + 1;
}

mysqli_close($conn);
?>