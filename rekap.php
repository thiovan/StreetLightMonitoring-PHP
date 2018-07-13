<?php
include 'DB.php';

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  //Tabel Lampu
  $sql = "SELECT * FROM tabel_lampu";
  $result = mysqli_query($conn, $sql);
?>

<!-- Tabel Data Lampu-->
<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
      <div class="box-header">
        <center><h3 style="margin:0px;">Rekap Data Lampu</h3></center>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Kode Lampu</th>
            <th>Lokasi</th>
            <th>Status</th>
            <th>Kondisi</th>
            <th>Total Kerusakan</th>
            <th>Intensitas Tertinggi</th>
            <th>Tegangan Tertinggi</th>
            <th>Laporan Terakhir</th>
          </tr>
          </thead>
          <tbody>
          
          <?php
            while($row = mysqli_fetch_assoc($result)) {
              $kode_lampu = $row['kode_lampu'];
              $lokasi = $row['lokasi'];

              $sql2 = "SELECT * FROM tabel_rekap WHERE kode_lampu='$kode_lampu' ORDER BY id_rekap DESC LIMIT 1";
              $result2 = mysqli_query($conn, $sql2);
              $row2 = mysqli_fetch_assoc($result2);

              $sql3 = "SELECT * FROM tabel_rekap WHERE kode_lampu='$kode_lampu' AND kondisi=0";
              $result3 = mysqli_query($conn, $sql3);

              $sql4 = "SELECT MAX(intensitas) AS max FROM tabel_rekap WHERE kode_lampu = '$kode_lampu'";
              $result4 = mysqli_query($conn, $sql4);
              $row4 = mysqli_fetch_assoc($result4);

              $sql5 = "SELECT MAX(tegangan) AS max FROM tabel_rekap WHERE kode_lampu = '$kode_lampu'";
              $result5 = mysqli_query($conn, $sql5);
              $row5 = mysqli_fetch_assoc($result5);

              if ($row2['status'] == 1) {
                $status = "<span class='badge bg-green'>NYALA</span>";
              } else {
                $status = "<span class='badge bg-red'>PADAM</span>";
              }
              

              if ($row2['kondisi'] == 1) {
                $kondisi = "<span class='badge bg-green'>BAIK</span>";
              } else {
                $kondisi = "<span class='badge bg-red'>RUSAK</span>";
              }

              $total_kerusakan = mysqli_num_rows($result3);
              $intensitas = $row4['max'];
              $intensitas_persen = ($intensitas / 1024) * 100;
              $tegangan = $row5['max'];
              $tegangan_persen = ($tegangan / 15) * 100;
              $laporan = $row2['datetime'];

              echo "<tr>";
              echo "<td>$kode_lampu</td>";
              echo "<td>$lokasi</td>";
              echo "<td>$status</td>";
              echo "<td>$kondisi</td>";
              echo "<td>$total_kerusakan</td>";
              echo '<td>'.$intensitas.'<div class="progress progress-xs progress-striped active"><div class="progress-bar progress-bar-primary" style="width: '.$intensitas_persen.'%"></div></div></td>';
              echo '<td>'.$tegangan.'<div class="progress progress-xs progress-striped active"><div class="progress-bar progress-bar-warning" style="width: '.$tegangan_persen.'%"></div></div></td>';
              echo "<td>$laporan</td>";


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