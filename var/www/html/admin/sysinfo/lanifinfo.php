
<?php
$ifinfo = shell_exec('ifconfig eth0');
$hostname = shell_exec('hostname');
$date = shell_exec('date "+%A %W %Y %X"');
//echo "<pre>$output</pre>";
$pageTitle = "eth0 interface statistics";

?>

<html>
<head>
<title>DSC ovpn LANstatus</title>
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
			<?php echo "<pre>$ifinfo</pre>"; ?>
			 <br>
		
	</div>
</div>	</div>
</div>
</body>
</html>
