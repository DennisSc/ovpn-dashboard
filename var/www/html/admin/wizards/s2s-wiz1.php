
<?php

$hostname = shell_exec('hostname');
$date = shell_exec('date "+%A %W %Y %X"');
//echo "<pre>$output</pre>";
$pageTitle = "User creation wizard s2s template - step 1";

?>

<html>
<head>
<title>DSC ovpn AdduserWiz</title>
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
			<form id="myform" action="/admin/wizards/s2s-wiz2" >			
			<div class="row">
			  <div class="col-lg-4">
				
				  <input type="text" class="form-control" name="clientname" placeholder="peer name" value="">
				
			  </div>
			  <div class="col-lg-4">
				  <input type="text" class="form-control" name="server" placeholder="server URL or public IP" value="">
				
			  </div>
			</div><br>
			<div class="row">
			  <div class="col-lg-4">
				
				  <input type="text" class="form-control" name="network" placeholder="peer subnet, e.g. 192.168.10.0/24" value="">
				
			  </div>
			  
			</div>

			  <div class=col-lg-3">
				 <button class="btn btn-primary pull-right" style="margin-right: 20px !IMPORTANT; margin-top: -30px !IMPORTANT;" type="submit">create</button>
			  </div>
			
			</form>
			 
		</div>
		
	</div>
</div>
	</div>
</div>
</body>
</html>
