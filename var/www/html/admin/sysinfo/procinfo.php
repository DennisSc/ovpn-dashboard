
<?php
$output = shell_exec('ps  -axo "uname,ppid,pid,etime,%cpu,%mem,args" | tail -n +2 | sort -rn -k 5');
$header= shell_exec('ps  -axo uname,ppid,pid,etime,%cpu,%mem,args | sed -n 1p');
$hostname = shell_exec('hostname');
$date = shell_exec('date "+%A %W %Y %X"');
//echo "<pre>$output</pre>";
$pageTitle = "Process overview";

?>

<html>
<head>
<title>DSC ovpn ProcInfo</title>
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
			
<br><p><a class="btn btn-primary btn-lg" href="javascript:history.go(-1)" role="button">back</a><tab><a class="btn btn-primary btn-lg" style="margin-left: 12px !IMPORTANT;" href="javascript:window.location.reload(true)" role="button">reload</a></p><bR>
		<div class='well'>
			<?php echo "<label >$header</label><br><pre>$output</pre>"; ?>
			
		</div>
		
	</div>
</div>
	</div>
</div>
</body>
</html>
