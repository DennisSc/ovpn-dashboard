
<?php $pageTitle = "Cleanup";
$result=shell_exec('rm /var/www/html/restore/*');
?>

<html>
<head>


	<meta http-equiv="refresh" content="3;url=/admin/vpnconfig/restoreconf" />

	<title>DSC ovpn Dashboard</title>
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
			<br><div class="col-md-12 text-center">Cleanup finished. You will be redirected to the upload page now.<br><pre><?php echo $result; ?></pre><br></div><br><br>
			<?php #<br><div class="col-md-12 text-center"><a class="btn btn-primary btn-lg"  href="/" role="button">back to start page</a><br> <?>
		
<br><br>			
</div>
</div>
</div>		
</body>
</html>
