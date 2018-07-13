<?php
include 'DB.php';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['kode_lampu'])) {
	$kode_lampu = $_POST['kode_lampu'];

	if (isset($_POST['control'])) {
		$control = 1;
	} else {
		$control = 0;
	}
	
	$ldr1 = $_POST['ldr1'];
	$ldr2 = $_POST['ldr2'];
	$tegangan = $_POST['tegangan'];
	$jam_awal = $_POST['jam_awal'];
	$jam_akhir = $_POST['jam_akhir'];

	if ($kode_lampu == "all") {
		$sql = "UPDATE tabel_simulasi SET control=$control, ldr1=$ldr1, ldr2=$ldr2, tegangan=$tegangan, jam_awal=$jam_awal, jam_akhir=$jam_akhir";
	} else {
		$sql = "UPDATE tabel_simulasi SET control=$control, ldr1=$ldr1, ldr2=$ldr2, tegangan=$tegangan, jam_awal=$jam_awal, jam_akhir=$jam_akhir WHERE kode_lampu = '$kode_lampu'";
	}
	
	$result = mysqli_query($conn, $sql);

	mysqli_query($conn, $sql);
}

header("Location: index.php?simulasi=1&kode_lampu=$kode_lampu");

?>