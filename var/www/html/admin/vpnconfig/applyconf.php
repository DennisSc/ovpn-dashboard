
<?php 
$date = shell_exec('date "+%A %W %Y %X"');
$hostname = shell_exec('hostname');
$pageTitle = "Apply configuration finished";
$confname = $_GET['confname'];
#	<meta http-equiv="refresh" content="8;url=/admin/vpnconfig/restoreconf.php" />

?>

<html>
<head>


		<?php include '../header.php'; ?>
	<meta http-equiv="refresh" content="3;url=/admin/vpnconfig/cleanup" />
</head>



<body style='overflow: scroll !important;'>
<?php include '../navbar.php'; ?>
	<div class="jumbotron col-md-12"">
		<br>
		<h3 style="text-align: center;"><?=$pageTitle;?></h3>
		<br>
		<div class="panel panel-default col-md-offset-2 col-md-8">
		  <div class="panel-body" >
						 
			<br><div class="col-md-12 text-center">


				<?php

					$result=shell_exec("sudo /var/www/html/admin/vpnconfig/applyconf.sh -c $confname");
					echo "<pre>".$result." Starting cleanup of restore folder in 5 seconds.</pre>";
				?>

<br><br></div><br><br>
<br><br>			
</div>
</div>
</div>	

</body>
</html>
