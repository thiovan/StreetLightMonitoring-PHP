<?php
include 'DB.php';

$kode_lampu = $_GET['kode_lampu'];

?>

<div class="row">
	<div class="col-xs-12">
    <div class="box box-primary">
    <div class="box-header">
    <center><h3>Data Lampu</h3></center>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
	<div class="col-md-6">
		<div style="width:auto;">
				<canvas id="canvas"></canvas>
		</div>
	</div>

	<div class="col-md-6">
		<div style="width:auto;">
				<canvas id="canvas2"></canvas>
		</div>
	</div>
	


	<div class="col-md-6">
		<div style="width:auto;">
			<canvas id="canvas3"></canvas>
		</div>
	</div>

	<div class="col-md-6">
		<div style="width:auto;">
			<canvas id="canvas4"></canvas>
		</div>
	</div>

</div>

<form>
	<input type="hidden" id="hidden" value="">
</form>
</div>
</div>
</div>
