<?php
	include 'DB.php';

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

  	//Tabel Lampu
	$sql = "SELECT * FROM tabel_simulasi";
	$result = mysqli_query($conn, $sql);


	if (isset($_GET['kode_lampu'])) {
		$kode_lampu = $_GET['kode_lampu'];

		if ($kode_lampu == "all") {
			$control_checked = "checked";
			$ldr1 = 0;
			$ldr2 = 0;
			$tegangan = 0;
			$jam_awal = 0;
			$jam_akhir = 0;
		} else {
			$sql2 = "SELECT * FROM tabel_simulasi WHERE kode_lampu = '$kode_lampu'";
			$result2 = mysqli_query($conn, $sql2);
			$row2 = mysqli_fetch_assoc($result2);

			if ($row2['control'] == 1) {
				$control_checked = "checked";
			}else{
				$control_checked = "";
			}
			$ldr1 = $row2['ldr1'];
			$ldr2 = $row2['ldr2'];
			$tegangan = $row2['tegangan'];
			$jam_awal = $row2['jam_awal'];
			$jam_akhir = $row2['jam_akhir'];
		}
		
	} else {

		$control_checked = "";
		$ldr1 = 0;
		$ldr2 = 0;
		$tegangan = 0;
		$jam_awal = 0;
		$jam_akhir = 0;
	}
	
?>

<!-- Tabel Data Lampu-->
<div class="row">
  <div class="col-xs-6">
    <div class="box box-primary">
      <div class="box-header">
        <center><h3 style="margin:0px;">Data Lampu</h3></center>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example3" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Kode Lampu</th>
            <th><center>Simulasi</center></th>
            <th><center>Option</center></th>
          </tr>
          </thead>
          <tbody>
          
          <?php
          	while($row = mysqli_fetch_assoc($result)) {
              $id_lampu = $row['kode_lampu'];
              $control = $row['control'];
              if ($control == 1) {
                $control = "<span class='badge bg-green'>AKTIF</span>";
              } else {
                $control = "<span class='badge bg-red'>TIDAK AKTIF</span>";
              }

          		echo "<tr>";
          		echo "<td>$id_lampu</td>";
          		echo "<td><center>$control</center></td>";
              //echo "<form method='post' action='detail.php'><td><input class='btn btn-primary' type='submit' name='action' value='Detail'/><input type='hidden' name='kode_lampu' value='$kode_lampu'/></td></form>";
              echo "<td><center><a href='index.php?simulasi=1&kode_lampu=$id_lampu'><input class='btn btn-success' type='submit' name='action' value='Take Control'/></a></center></td>";
          		echo "</tr>";
          	}
          ?>
          
          </tbody>
        </table>

        <br>
        <center><a href='index.php?simulasi=1&kode_lampu=all'><input class='btn btn-warning' type='submit' name='action' value='Take Control All'/></a></center>
      </div>
      <!-- /.box-body -->
    </div>
  </div>

<form method="post" action="update_simulasi.php">


  <div class="col-xs-6">
    <div class="box box-primary">
      <div class="box-header">
        <center><h3 style="margin:0px;">Simulasi</h3></center>
        <center>(id lampu: <?php echo $kode_lampu; ?>)</center>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
      	<div class="knob-label" style="text-align: left;"><b>Aktifkan simulasi:</b> &nbsp <input type="checkbox" name="control" value="1" <?php echo $control_checked;?> ></div>
      	
      	<br>

		<div class="row">
		<div class="col-xs-6 text-center">
		  <input type="text" name="ldr1" class="knob" value="<?php echo $ldr1; ?>" data-min="0" data-max="1024" data-skin="tron" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" data-width="120" data-height="120" data-fgColor="#00c0ef">

		  <div class="knob-label"><b>Sensor LDR 1</b></div>
		</div>

		<div class="col-xs-6 text-center">
		  <input type="text" name="ldr2" class="knob" value="<?php echo $ldr2; ?>" data-min="0" data-max="1024" data-skin="tron" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" data-width="120" data-height="120" data-fgColor="#00c0ef">

		  <div class="knob-label"><b>Sensor LDR 2</b></div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 text-center">
		  <input type="text" name="tegangan" class="knob" value="<?php echo $tegangan; ?>" data-min="0" data-max="15" data-skin="tron" data-thickness="0.2" data-angleArc="250" data-angleOffset="-125" data-width="120" data-height="120" data-fgColor="#00c0ef">

		  <div class="knob-label"><b>Sensor Tegangan</b></div>
		</div>
	</div>

	<br>
	<br>

		<div class="row">
		<div class="col-xs-6">
			<div class="knob-label" style="text-align: left;"><b>Jam Dinyalakan</b></div>
			<div class="input-group">
	            <input type="text" name="jam_awal" class="form-control timepicker" value="<?php echo $jam_awal; ?>">

	            <div class="input-group-addon">
	              <i class="fa fa-clock-o"></i>
	            </div>
	         </div>
	         
	     </div>


	     <div class="col-xs-6">
	     	<div class="knob-label" style="text-align: left;"><b>Jam Dimatikan</b></div>
			<div class="input-group">
	            <input type="text" name="jam_akhir" class="form-control timepicker" value="<?php echo $jam_akhir; ?>">

	            <div class="input-group-addon">
	              <i class="fa fa-clock-o"></i>
	            </div>
	         </div>
	     </div>
	     </div>

		<br>
	     <div class="row">
	     	<div class="col-xs-4 col-xs-offset-4">
	     		<button type="submit" class="btn btn-block btn-success">Submit</button>
	     		<input type="hidden" name="kode_lampu" value="<?php echo $kode_lampu; ?>">
	     	</div>
	     </div>

      </div>
  </div>
</div>
</form>

</div>
