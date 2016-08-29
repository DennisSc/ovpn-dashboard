
<?php 
$pageTitle = "DSC ovpn configuration change";
$proto = $_GET['proto'];
$port = $_GET['port'];
$subnet = $_GET['TransSubnet'];
$netmask = $_GET['TransNetmask'];
$cipher = $_GET['cipher'];
$interclient = $_GET['interclient'];
$lzo = $_GET['lzo'];



?>

<html>
<head>


	<meta http-equiv="refresh" content="6;url=/admin/vpnconfig/editconf" />

	<title>DSC ChangeConf</title>
	<?php include '../header.php'; ?>

</head>
<body style='overflow: scroll !important;'>
<?php $result=shell_exec('sudo /var/www/html/admin/vpnconfig/changeconf.sh -pr '.$proto.' -po '.$port.' -s '.$subnet.' -m '.$netmask.' -c '.$cipher.' -i '.$interclient.' -l '.$lzo); ?>

<div class="container">
	<div class="jumbotron col-md-12"">
		<br>
		<h3 style="text-align: center;"><?=$pageTitle;?></h3>
		<br>
		<div class="panel panel-default col-md-offset-2 col-md-8">
		  <div class="panel-body" >
			<br><div class="col-md-12 ">OpenVPN configuration changed. You will be redirected to the configuration editor now. The following changes were made: <br><br><pre><?=$result?></pre><br></div><br><br>
			<?php #<br><div class="col-md-12 text-center"><a class="btn btn-primary btn-lg"  href="/" role="button">back to start page</a><br> <?>
		
<br><br>			
</div>
</div>
</div>		
</body>
</html>
