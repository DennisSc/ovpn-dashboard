
<?php
$output = shell_exec('cat /etc/openvpn/openvpn-status.log');
$hostname = shell_exec('hostname');
//echo "<pre>$output</pre>";
$pageTitle = "openVPN Connection status";

?>

<html>
<head>
<title>DSC ovpn ConnStatus</title>
<?php include '../header.php'; ?>

</head>
<body>
<?php include '../navbar.php'; ?>
<div class="container">
	<div class="jumbotron">
		<br>
		<h2><?=$pageTitle;?></h2>
		<br>
		<div class="panel panel-default">
		  <div class="panel-body">
			<br>

		<div class='well'>
			<?php echo "<pre>$output</pre>"; ?>
			 <p><a class="btn btn-primary btn-lg" href="javascript:window.location.reload(true)" role="button">reload page</a></p>
		</div>
	
	</div>
</div>	</div>
</div>
</body>
</html>
