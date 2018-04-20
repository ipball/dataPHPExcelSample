<?php require 'config.php'; ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Data</title>
	<link href="<?php echo $baseurl; ?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo $baseurl; ?>css/bootstrap-theme.min.css" rel="stylesheet">
	<link href="<?php echo $baseurl; ?>css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo $baseurl; ?>css/ionicons.min.css" rel="stylesheet">
	<style>
		body {
			margin-top: 20px;
		}

		.loading {
			background-image: url("ajax-loader.gif");
			background-repeat: no-repeat;
			display: none;
			height: 100px;
			width: 100px;
		}
	</style>
	<script type="text/javascript">
		var gUrl = '<?php echo $baseurl; ?>';
	</script>
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<form class="form-inline" name="searchform" id="searchform">
					<div class="form-group">
						<label>จำนวนหน้าแสดง</label>
						<select name="perpage" class="form-control">
							<option value="10">10</option>
							<option value="15">15</option>
							<option value="30">30</option>
							<option value="50">50</option>
						</select>
					</div>
					<div class="form-group">
						<input type="text" name="first_name" class="form-control" placeholder="ชื่อ" autocomplete="off" style="width:150px;">
						<input type="text" name="last_name" class="form-control" placeholder="นามสกุล" autocomplete="off" style="width:150px;">
						<input type="text" name="age" class="form-control" placeholder="อายุ" autocomplete="off" style="width:150px;">
						<input type="text" name="place" class="form-control" placeholder="สถานที่" autocomplete="off" style="width:150px;">
					</div>
					<button type="button" class="btn btn-primary" id="btnSearch">
						<span class="glyphicon glyphicon-search"></span>
						ค้นหา
					</button>

					<button type="button" class="btn btn-warning" id="btnExport">
					<span class="glyphicon glyphicon-export"></span>
						Excel
					</button>

				</form>
			</div>
		</div>
		<div class="loading"></div>
		<div class="row" id="list-data" style="margin-top: 10px;">

		</div>
	</div>
	<script src="<?php echo $baseurl; ?>js/jquery.min.js"></script>
	<script src="<?php echo $baseurl; ?>js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo $baseurl; ?>pagination/public/javascript/zebra_pagination.js"></script>
	<script type="text/javascript" src="<?php echo $baseurl; ?>js/app.js"></script>
</body>

</html>