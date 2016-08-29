
<?php
$output = shell_exec("sudo ./showcalog.sh");
$hostname = shell_exec('hostname');
$date = shell_exec('date "+%A %W %Y %X"');
//echo "<pre>$output</pre>";
$pageTitle = "openVPN server CA revocation list";

?>

<html>
<head>
<title>DSC ovpn CAlog</title>
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
			<br>
			<p>
			<a class="btn btn-primary btn-lg" href="javascript:history.go(-1)" role="button">back</a><tab>
			<a class="btn btn-primary btn-lg" style="margin-left: 6px !IMPORTANT;"  href="javascript:window.location.reload(true)" role="button">reload</a><tab>
			<a class="btn btn-primary btn-lg" style="margin-left: 6px !IMPORTANT;"  href="../vpnusers/forcerevoke" role="button">Revoke cert</a><tab>
			</p>

<br>
		<div class='well'>
			<b>V</b> is valid, <b>R</b> is revoked
			<?php echo "<pre>$output</pre>"; ?>
			 
		</div>
	
	</div>
</div>	</div>
</div>
</body>
</html>
