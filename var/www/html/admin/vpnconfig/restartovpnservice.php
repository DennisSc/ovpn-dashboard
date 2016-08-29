
<?php $pageTitle = "DSC ovpn Service restart";
$result=shell_exec('sudo /var/www/html/admin/vpnconfig/restartovpn.sh');
?>

<html>
<head>


	<meta http-equiv="refresh" content="3;url=/admin/vpnconfig/servicerestartselect" />

	<title>DSC ovpnRestart</title>
	<?php include '../header.php'; ?>

</head>
<body style='overflow: scroll !important;'>

<div class="container">
	<div class="jumbotron col-md-12"">
		<br>
		<h3 style="text-align: center;"><?=$pageTitle;?></h3>
		<br>
		<div class="panel panel-default col-md-offset-2 col-md-8">
		  <div class="panel-body" >
			<br><div class="col-md-12 text-center">OpenVPN service was restarted. You will be redirected to the service overview now.<br><pre><?php echo $result; ?></pre><br></div><br><br>
			<?php #<br><div class="col-md-12 text-center"><a class="btn btn-primary btn-lg"  href="/" role="button">back to start page</a><br> <?>
		
<br><br>			
</div>
</div>
</div>		
</body>
</html>
