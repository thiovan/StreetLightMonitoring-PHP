<?php

include 'DB.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['0'])) {

$tambah_kode       = $_POST['0'];
$tambah_konstruksi = $_POST['1'];
$tambah_jenis      = $_POST['2'];
$tambah_daya       = $_POST['3'];
$tambah_merk       = $_POST['4'];
$tambah_lokasi     = $_POST['5'];

$sql = "INSERT INTO tabel_lampu VALUES ('$tambah_kode', '$tambah_konstruksi', '$tambah_jenis', '$tambah_daya', '$tambah_merk', '$tambah_lokasi')";
$sql2 = "INSERT INTO tabel_simulasi VALUES ('', '$tambah_kode', '0', '0', '0', '0', '0', '0')";

if (mysqli_query($conn, $sql)) {
  mysqli_query($conn, $sql2);
    $success = "Ditambahkan";
} else {
  $failed = "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
?>


<?php 
    if(isset($success))
    {
      ?>
        <div class='alert alert-success'>
        <button class='close' data-dismiss='alert'>&times;</button>
        <strong>Success!</strong> Data Berhasil <?php echo $success ?>
      </div>
    <?php
    }
    ?>

    <?php 
    if(isset($failed))
    {
      ?>
        <div class='alert alert-danger'>
        <button class='close' data-dismiss='alert'>&times;</button>
        <strong>Success!</strong> Data Berhasil <?php echo $failed ?>
      </div>
    <?php
    }
    ?>

  <div class="box box-success container">
  <h2>Data Lampu</h2>
  <hr>
  <form id="edit" method="POST">

          <div class="form-group col-md-6">
          <label>Kode Lampu:</label>
          <input name="0" type="text" class="form-control" placeholder="Kode Lampu" value="">
        </div>
        <div class="form-group col-md-6">
          <label>Konstruksi Tiang:</label>
          <input name="1" type="text" class="form-control" placeholder="Konstruksi Tiang" value="">
        </div>
         <div class="form-group col-md-6">
          <label>Jenis Lampu:</label>
          <input name="2" type="text" class="form-control" placeholder="Jenis Lampu" value="">
        </div>
         <div class="form-group col-md-6">
          <label>Daya Lampu:</label>
          <input name="3" type="text" class="form-control" placeholder="Daya lampu" value="">
        </div>
         <div class="form-group col-md-6">
          <label>Merk Lampu:</label>
          <input name="4" type="text" class="form-control" placeholder="Merk Lampu" value="">
        </div>
        
          <div class="form-group col-md-6">
          <label>Tambah lokasi:</label>
          <input name="5" type="text" class="form-control" placeholder="Lokasi" value="">
        </div>

        <button name="insert" type="submit" class="btn btn-success col-md-offset-4 col-md-4" style="margin-top: 20px; margin-bottom: 40px;">Tambah Data</button>
      </form>
</div>

<br>
