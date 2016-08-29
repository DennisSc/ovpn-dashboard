
<?php
$clientname = $_GET['clientname'];
$PEM = $_GET['PEM'];
$hostname = shell_exec('hostname');
$date = shell_exec('date "+%A %W %Y %X"');
//echo "<pre>$output</pre>";
$pageTitle = "Certificate revocation results";

?>

<html>
<head>
<title>DSC ovpn RevokeCert</title>
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
						 <br><p><a class="btn btn-primary btn-lg" href="../vpninfo/calog" role="button">back to CA revocation list</a><tab>
						<a class="btn btn-primary btn-lg" style="margin-left: 12px !IMPORTANT;" href="../" role="button">back to Dashboard</a></p>
						<br>

		<div class='well'>
			<?php
				$run = shell_exec('sudo /var/www/html/admin/vpnusers/forcerevoke.sh -c '.$clientname.' -p '.$PEM);
				$result  = shell_exec('echo '.$run.' ｜ grep "done"');
				if ($result){
					echo "success revoking PEM ".$PEM." for user ".$clientname.".";
				}else{
					echo "failure";
				}
			?>
			 <br>
		</div>
		
	</div>
</div>
	</div>
</div>
</body>
</html>
