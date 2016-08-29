<?php 
$date = shell_exec('date "+%A %W %Y %X"');
$hostname = shell_exec('hostname');
 ?>


<html>
  <head>
<?php include './header.php'; ?>
  
  <title>Frameset</title>
  </head>
  	<body style='overflow: scroll !important;'>
<?php include './navbar.php'; ?>
<div class="container">
	<div class="jumbotron">
		<br>
		<h3>PHP info</h3>
<br><p><a class="btn btn-primary btn-lg" href="javascript:history.go(-1)" role="button">back</a><tab><a class="btn btn-primary btn-lg" style="margin-left: 12px !IMPORTANT;" href="javascript:window.location.reload(true)" role="button">reload</a></p>		<div class="panel panel-default">

		  <div class="panel-body">
			<br>
		<div class="panel">
		  <div class="panel-body">
			PHP version information
				<?php
				phpinfo();
				?>
		  </div>
		</div>
	</div>
</div>
	</div>
</div>

	</body>
</html>



