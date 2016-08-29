
<?php
$output = shell_exec('cat /proc/cpuinfo');
$hostname = shell_exec('hostname');
$date = shell_exec('date "+%A %W %Y %X"');
//echo "<pre>$output</pre>";
$pageTitle = "CPU info";

?>

<html>
<head>
<title>DSC ovpn CpuInfo</title>
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

<br><p><a class="btn btn-primary btn-lg" href="javascript:history.go(-1)" role="button">back</a><tab><a class="btn btn-primary btn-lg" style="margin-left: 12px !IMPORTANT;" href="javascript:window.location.reload(true)" role="button">reload</a></p>			<br>

		<div class='well'>
			<?php echo "<pre>$output</pre>"; ?>
		</div>
		
	</div>
</div>
	</div>
</div>
</body>
</html>
