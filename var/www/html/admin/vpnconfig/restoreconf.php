
<?php

$hostname = shell_exec('hostname');
$date = shell_exec('date "+%A %W %Y %X"');
//echo "<pre>$output</pre>";
$pageTitle = "Restore configuration from file";

?>

<html>
<head>
<title>DSC ovpn RestoreConf</title>
<?php include '../header.php'; ?>

</head>
<body style='overflow: scroll !important;'>
<?php include '../navbar.php'; ?>
<div class="container">
	<div class="jumbotron">
		<br>
		<h3><?=$pageTitle;?></h3>
		<br>
		<div class="panel panel-default">
		  <div class="panel-body">
						 <br><p><a class="btn btn-primary btn-lg" href="javascript:history.go(-1)" role="button">back</a><tab><a class="btn btn-primary btn-lg" style="margin-left: 12px !IMPORTANT;" href="javascript:window.location.reload(true)" role="button">reload</a></p>
<br>

		<div class='well'>
			
				<form action="uploader" method="post" enctype="multipart/form-data">
					<b>Select backup file to restore the configuration from:</b><br><br>
					<input type="file" name="fileToUpload" id="fileToUpload"><br><br>
					<input type="submit" class="btn btn-primary btn-success btn-lg" value="Restore" name="submit">
				</form>

			 <br>
		</div>
		
	</div>
</div>
	</div>
</div>
</body>
</html>
