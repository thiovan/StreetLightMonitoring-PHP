<?php
include 'DB.php';

$kode_lampu = $_GET['kode_lampu'];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// hapus dari tabel lampu
$sql = "DELETE FROM tabel_lampu WHERE kode_lampu='$kode_lampu'";
$sql_simulasi = "DELETE FROM tabel_simulasi WHERE kode_lampu='$kode_lampu'";

if (mysqli_query($conn, $sql)) {
	mysqli_query($conn, $sql_simulasi);
	$sql = "DELETE FROM tabel_rekap WHERE kode_lampu='$kode_lampu'";
	if (mysqli_query($conn, $sql)) {
		header("Location: index.php");
	} else {
		echo "Error deleting record from tabel_rekap: " . mysqli_error($conn);
	}

} else {
    echo "Error deleting record from tabel_lampu: " . mysqli_error($conn);
}

mysqli_close($conn);
?>