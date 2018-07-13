<?php
header('Content-Type: application/json');
include 'DB.php';

$kode_lampu = $_POST['kode_lampu'];

//get connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

if(!$mysqli){
	die("Connection failed: " . $mysqli->error);
}

//query to get data from the table
$query = sprintf("SELECT kondisi, status, intensitas, tegangan, datetime FROM tabel_rekap WHERE kode_lampu = '$kode_lampu' ORDER BY 'datetime' DESC LIMIT 8");

//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($data);

?>