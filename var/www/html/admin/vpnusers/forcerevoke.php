
<?php

$hostname = shell_exec('hostname');
$date = shell_exec('date "+%A %W %Y %X"');
//echo "<pre>$output</pre>";
$pageTitle = "Certificate revocation";

?>

<html>
<head>
<title>DSC ovpn crt revocation</title>
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
						 <br><p><a class="btn btn-primary btn-lg" href="javascript:history.go(-1)" role="button">back</a><tab>
						<a class="btn btn-primary btn-lg" style="margin-left: 6px !IMPORTANT;" href="javascript:window.location.reload(true)" role="button">clear form</a></p>
						<br>

		<div class='well'>
			<form id="myform" action="/admin/vpnusers/forcerevoke2" >			
			<div class="row">
			  <div class="col-lg-4">
				
				  <input type="text" class="form-control" name="clientname" placeholder="peer name" value="">
				
			  </div>
			  <div class="col-lg-4">
				  <input type="text" class="form-control" name="PEM" placeholder="certificate PEM number" value="">
				
			  </div>
			  <div class=col-lg-3">
				 <button class="btn btn-primary pull-right" style="margin-right: 20px !IMPORTANT;" type="submit">revoke</button>
			  </div>
			</div>
			</form>
			 
		</div>
		
	</div>
</div>
	</div>
</div>
</body>
</html>
