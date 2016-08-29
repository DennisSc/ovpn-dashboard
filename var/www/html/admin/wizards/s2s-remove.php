
<?php
$clientname = $_GET['clientname'];
$subnet = $_GET['subnet'];
$netmask = $_GET['netmask'];
$hostname = shell_exec('hostname');
$date = shell_exec('date "+%A %W %Y %X"');
//echo "<pre>$output</pre>";
$pageTitle = "User removal (site2site)";

?>

<html>
<head>
<title>DSC ovpn removeRwUsr</title>
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
						 <br><p><a class="btn btn-primary btn-lg" href="/admin/vpnusers/showusers" role="button">back to user overview</a><tab>
						<a class="btn btn-primary btn-lg" style="margin-left: 12px !IMPORTANT;" href="../" role="button">back to Dashboard</a></p>
						<br>

		<div class='well'>
			<?php
				$run = shell_exec('sudo /var/www/html/admin/vpnusers/removeuser_s2s.sh -c '.$clientname.' -s '.$subnet.' -m '.$netmask.' -o /var/www/html/download');
				$result  = shell_exec('echo '.$run.' ｜ grep "DSC ovpn RemclientWizS2S done"');
				if ($result){
					echo "Removed ".$clientname." successfully.<br><br><pre>".$result."</pre>";
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
