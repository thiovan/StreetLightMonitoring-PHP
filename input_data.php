<?php
	include 'DB.php';

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	date_default_timezone_set('Asia/Jakarta');

	$kode_lampu = $_GET['kode_lampu'];
	$kondisi = $_GET['kondisi'];
	$status = $_GET['status'];
	$intensitas = $_GET['intensitas'];
	$tegangan = $_GET['tegangan'];
	$datetime = date("Y-m-d H:i:s");

	$sql = "INSERT INTO tabel_rekap VALUES ('', '$kode_lampu', $kondisi, $status, $intensitas, $tegangan, '$datetime')";

	if (mysqli_query($conn, $sql)) {
	    echo "Success";
	} else {
	    echo "Failed";
	}

	$sql = "SELECT * FROM tabel_rekap WHERE kode_lampu = '$kode_lampu' ORDER BY id_rekap DESC";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 50) {
		$sql = "SELECT * FROM tabel_rekap WHERE kode_lampu = '$kode_lampu' LIMIT 20";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($result)) {
			$last = $row['id_rekap'];
		}

		$sql_delete = "DELETE FROM tabel_rekap WHERE kode_lampu='$kode_lampu' AND id_rekap < '$last'";
		mysqli_query($conn, $sql_delete);
	}

	mysqli_close($conn);

?>