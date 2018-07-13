<?php
  include 'DB.php';

  $kode_lampu = $_GET['kode_lampu'];

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  //Cek Total Kerusakan
  $sql = "SELECT * FROM tabel_rekap WHERE kode_lampu = '$kode_lampu' AND kondisi = 0";
  $result = mysqli_query($conn, $sql);
  $total_kerusakan = mysqli_num_rows($result);

  //Cek Tegangan Tertinggi
  $sql2 = "SELECT MAX(tegangan) AS max FROM tabel_rekap WHERE kode_lampu = '$kode_lampu'";
  $result2 = mysqli_query($conn, $sql2);
  $row = mysqli_fetch_assoc($result2);
  $tegangan_tertinggi = $row['max'];

  //Cek Status Terakhir
  $sql3 = "SELECT status FROM tabel_rekap WHERE kode_lampu = '$kode_lampu' ORDER BY id_rekap DESC LIMIT 1";
  $result3 = mysqli_query($conn, $sql3);
  $row3 = mysqli_fetch_assoc($result3);
  $status_terakhir = $row3['status'];

  //Cek Intensitas Tertinggi
  $sql4 = "SELECT MAX(intensitas) AS max FROM tabel_rekap WHERE kode_lampu = '$kode_lampu'";
  $result4 = mysqli_query($conn, $sql4);
  $row4 = mysqli_fetch_assoc($result4);
  $intensitas_tertinggi = $row4['max'];
?>

<div class="row">
  <div class="col-md-12">
    <!-- Widget: user widget style 1 -->
    <div class="box box-widget widget-user">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-aqua-active">
        <h3 class="widget-user-username">ID Lampu: <?php echo $kode_lampu; ?></h3>
        <h4>
        <?php

        if ($status_terakhir == 1) {
          echo '<i class="fa fa-circle text-success"></i> Nyala';
        } else {
          echo '<i class="fa fa-circle text-danger"></i> Padam';
        }

        ?>
        </h4>
      </div>
      <div class="box-footer">
        <div class="row">

          <div class="col-sm-4 text-center">
            <input type="text" class="knob" value="<?php echo $total_kerusakan ?>" data-min="0" data-max="50" data-skin="tron" data-thickness="0.2" data-width="90" data-height="90" data-fgColor="#428bca" data-readonly="true">

            <div class="knob-label"><b>Total Kerusakan</b></div>
          </div>

          <div class="col-sm-4 text-center">
            <input type="text" class="knob" value="<?php echo $intensitas_tertinggi ?>" data-min="0" data-max="1024" data-skin="tron" data-thickness="0.2" data-width="90" data-height="90" data-fgColor="#5cb85c" data-readonly="true">

            <div class="knob-label"><b>Intensitas Cahaya Tertinggi</b></div>
          </div>

          <div class="col-sm-4 text-center">
            <input type="text" class="knob" value="<?php echo $tegangan_tertinggi ?>" data-min="0" data-max="15" data-skin="tron" data-thickness="0.2" data-width="90" data-height="90" data-fgColor="#d9534f" data-readonly="true">

            <div class="knob-label"><b>Tegangan Tertinggi</b></div>
          </div>

          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    </div>
    <!-- /.widget-user -->
  </div>
</div>
<br>