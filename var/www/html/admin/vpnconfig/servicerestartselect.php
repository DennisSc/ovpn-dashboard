
<?php 
$date = shell_exec('date "+%A %W %Y %X"');
$hostname = shell_exec('hostname');
$pageTitle = "Restart services";

#	<meta http-equiv="refresh" content="8;url=/admin/vpnconfig/restoreconf.php" />

?>

<html>
<head>


		<?php include '../header.php'; ?>
  <title>DSC oVPN ResetSrv</title>
</head>



<body style='overflow: scroll !important;'>
<?php include '../navbar.php'; ?>
<div class="container">
	<div class="jumbotron"">
		<br>
		<h3 ><?=$pageTitle;?></h3>
		<br>
		<div class="panel panel-default ">
		  <div class="panel-body" >
						 <br><p><a class="btn btn-primary btn-lg" href="javascript:history.go(-1)" role="button">back</a><tab><a class="btn btn-primary btn-lg" style="margin-left: 12px !IMPORTANT;" href="../" role="button">Dashboard</a></p>
<br>

			<br><div class="col-md-12 ">
					<b>openVPN service status overview:</b><br><br><pre><?php 
$ovpnstatus=shell_exec('sudo /var/www/html/admin/vpnconfig/ovpnservicestatus.sh');

echo $ovpnstatus;
 ?></pre>

					<div ><br><a class="btn btn-primary btn-lg btn-danger" href="/admin/vpnconfig/restartovpnservice" role="button">Restart openVPN service</a></div>


<br><br></div><br><br>
<br><br>			
</div>
</div>
</div>
</div>	

</body>
</html>
