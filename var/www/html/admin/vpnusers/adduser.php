
<?php

$hostname = shell_exec('hostname');
$date = shell_exec('date "+%A %W %Y %X"');
//echo "<pre>$output</pre>";
$pageTitle = "Add users";

?>

<html>
<head>
<title>DSC ovpn Adduser</title>
<?php include '../header.php'; ?>
<script type="text/javascript" language="javascript">function ClearForm(){ document.myform.reset();}</script>

</head>
<body style='overflow: scroll !important;' onload="ClearForm()">
<?php include '../navbar.php'; ?>
<div class="container">
	<div class="jumbotron">
			<br>
		<h3><?=$pageTitle;?></h3>
		<br>
		<div class="panel panel-default">
		  <div class="panel-body">
				 <br>
						<p><a class="btn btn-primary btn-lg" href="javascript:history.go(-1)" role="button">back</a><tab>
						<a class="btn btn-primary btn-lg" style="margin-left: 6px !IMPORTANT;" href="javascript:window.location.reload(true)" role="button">reload</a></p>
						<br>

		<div class='well'>
			<br>
<div class="row"><div class="col-lg-2"><a class="btn btn-primary btn-success" style="margin-left: 52px !IMPORTANT; margin-top: -7px !IMPORTANT;" href="/admin/wizards/rw1-wiz1" role="button">Wizard1</a></div>
<div class="col-lg-8"> Roadwarrior1 (dialup VPN; single user; all internet traffic goes through the VPN)</div></div>
<br>
<div class="row"><div class="col-lg-2"><a class="btn btn-primary btn-success" style="margin-left: 52px !IMPORTANT; margin-top: -7px !IMPORTANT;" href="/admin/wizards/s2s-wiz1" role="button">Wizard2</a></div>
<div class="col-lg-8"> site2site (remote subnet can communicate wit local subnet; only subnet traffic goes through VPN)</div></div>
<br>
<div class="row"><div class="col-lg-2"><a class="btn btn-primary btn-danger " style="margin-left: 52px !IMPORTANT; margin-top: -7px !IMPORTANT;" href="javascript:window.location.reload(true)" role="button" disabled>Wizard3</a></div>
<div class="col-lg-8"> to be populated sometime in the future</div></div>
<br>
			 <br>
		</div>
		
	</div>
</div>
	</div>
</div>
</body>
</html>
