<?php
	include 'DB.php';
  include 'get_header.php'; 

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

  //Tabel Lampu
	$sql = "SELECT * FROM tabel_lampu";
	$result = mysqli_query($conn, $sql);

  //Tabel Rekap
  $sql2 = "SELECT * FROM tabel_rekap ORDER BY id_rekap DESC";
  $result2 = mysqli_query($conn, $sql2);
?>

<!-- Header Content -->
<div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3><?php echo $jumlah_lampu; ?></h3>

          <p>Jumlah Lampu</p>
        </div>
        <div class="icon">
          <i class="ion ion-android-bulb"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?php echo $lampu_nyala; ?></h3>

          <p>Lampu Nyala</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-lightbulb"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?php echo $lampu_mati; ?></h3>

          <p>Lampu Padam</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-lightbulb-outline"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?php echo $lampu_rusak; ?></h3>

          <p>Lampu Rusak</p>
        </div>
        <div class="icon">
          <i class="ion ion-android-cancel"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
</div>

<!-- Tabel Data Lampu-->
<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
      <div class="box-header">
        <center><h3 style="margin:0px;">Data Lampu</h3></center>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Kode Lampu</th>
            <th>Konstruksi Lampu</th>
            <th>Jenis Lampu</th>
            <th>Daya Lampu</th>
            <th>Merk Lampu</th>
            <th>Lokasi</th>
            <th>Opsi</th>
          </tr>
          </thead>
          <tbody>
          
          <?php
          	while($row = mysqli_fetch_assoc($result)) {
              $kode_lampu = $row['kode_lampu'];
              $konstruksi_lampu = $row['konstruksi_lampu'];
              $jenis_lampu = $row['jenis_lampu'];
              $daya_lampu = $row['daya_lampu'];
              $merk_lampu = $row['merk_lampu'];
              $lokasi = $row['lokasi'];

          		echo "<tr>";
          		echo "<td>$kode_lampu</td>";
          		echo "<td>$konstruksi_lampu</td>";
          		echo "<td>$jenis_lampu</td>";
          		echo "<td>$daya_lampu</td>";
          		echo "<td>$merk_lampu</td>";
          		echo "<td>$lokasi</td>";
              //echo "<form method='post' action='detail.php'><td><input class='btn btn-primary' type='submit' name='action' value='Detail'/><input type='hidden' name='kode_lampu' value='$kode_lampu'/></td></form>";
              echo "<td><a href='hapus_data.php?kode_lampu=$kode_lampu'><input class='btn btn-danger' type='submit' name='action' value='Hapus'/></a> &nbsp <a href='index.php?detail=1&kode_lampu=$kode_lampu'><input class='btn btn-primary' type='submit' name='action' value='Detail'/></a></td>";
          		echo "</tr>";
          	}
          ?>
          
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>

<!-- Tabel Rekap Lampu-->
<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
      <div class="box-header">
        <center><h3 style="margin:0px;">Log Data Pelaporan</h3></center>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example2" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Kode Lampu</th>
            <th>Kondisi</th>
            <th>Status</th>
            <th>Intensitas</th>
            <th>Tegangan</th>
            <th>Waktu</th>
          </tr>
          </thead>
          <tbody>

          <?php
            while($row2 = mysqli_fetch_assoc($result2)) {
              $kode_lampu = $row2['kode_lampu'];

              $kondisi = $row2['kondisi'];
              if ($kondisi == 1) {
                $kondisi = "<span class='badge bg-green'>BAIK</span>";
              } else {
                $kondisi = "<span class='badge bg-red'>RUSAK</span>";
              }

              $status = $row2['status'];
              if ($status == 1) {
                $status = "<span class='badge bg-green'>NYALA</span>";
              } else {
                $status = "<span class='badge bg-red'>PADAM</span>";
              }

              $intensitas = $row2['intensitas'];
              $intensitas_persen = ($intensitas / 1024) * 100;

              $tegangan = $row2['tegangan'];
              $tegangan_persen = ($tegangan / 10) * 100;

              $waktu = $row2['datetime'];

              echo "<tr>";
              echo "<td>$kode_lampu</td>";
              echo "<td>$kondisi</td>";
              echo "<td>$status</td>";
              echo '<td>'.$intensitas.'<div class="progress progress-xs progress-striped active"><div class="progress-bar progress-bar-primary" style="width: '.$intensitas_persen.'%"></div></div></td>';
              echo '<td>'.$tegangan.'<div class="progress progress-xs progress-striped active"><div class="progress-bar progress-bar-warning" style="width: '.$tegangan_persen.'%"></div></div></td>';
              echo "<td>$waktu</td>";
              echo "</tr>";
            }
          ?>
          
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>