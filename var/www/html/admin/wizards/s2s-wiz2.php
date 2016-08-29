
<?php
$clientname = $_GET['clientname'];
$serverurl = $_GET['server'];
$network = $_GET['network'];
$hostname = shell_exec('hostname');
$date = shell_exec('date "+%A %W %Y %X"');
//echo "<pre>$output</pre>";
$pageTitle = "User Wizard s2s - step 2";

?>

<html>
<head>
<title>DSC ovpn AdduserWiz</title>
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
						 <br><p><a class="btn btn-primary btn-lg" href="../vpnusers/showusers" role="button">back to user overview</a><tab>
						<a class="btn btn-primary btn-lg" style="margin-left: 6px !IMPORTANT;" href="../" role="button">back to Dashboard</a></p>
						<br>

		<div class='well'>
			<?php
				$run = shell_exec('sudo /var/www/html/admin/vpnusers/adduser.sh -c '.$clientname.' -t s2s -s '.$serverurl.' -n '.$network.' -o /var/www/html/download');
				$result  = shell_exec('echo '.$run.' ｜ grep "DSC ovpn clientWiz done"');
				if ($result){
					echo "success creating user ".$clientname.".<br>Please go to <a href='../../download/".$clientname."/'>/download/".$clientname."</a> to retrieve the generated client config and certs.";
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
