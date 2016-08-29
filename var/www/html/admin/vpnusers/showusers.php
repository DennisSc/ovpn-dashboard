
<?php
$users= array();

exec('/bin/ls /etc/openvpn/ccd', $users);

$hostname = shell_exec('hostname');
$date = shell_exec('date "+%A %W %Y %X"');
//echo "<pre>$output</pre>";
$pageTitle = "Peer overview";

?>

<html>
<head>
<title>DSC ovpn showPeers</title>
<?php include '../header.php'; ?>

</head>
<body style='overflow: scroll !important;'>
<?php include '../navbar.php'; ?>
<div class="container">
	<div class="jumbotron"><br>
		<h3><?=$pageTitle;?></h3><br>
		<div class="panel panel-default">
		<div class="panel-body">
		<br><p><a class="btn btn-primary btn-lg" href="javascript:history.go(-1)" role="button">back</a><tab><a class="btn btn-primary btn-lg" style="margin-left: 12px !IMPORTANT;" href="javascript:window.location.reload(true)" role="button">reload</a></p>
		<div>
		<button type="button" class="btn btn-sm btn-primary btn-success" disabled>green is connected</button>
		<button type="button" class="btn btn-sm btn-primary btn-warning" disabled>yellow is offline</button>
		</div><br>
		<div class="dropdown">
		  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
			Show peer details
			<span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
			<?php foreach ($users as &$user){
				echo '<li><a href="/admin/vpnusers/userdetails?username='.$user.'">';
				echo $user;
				echo '</a></li>';
			}?>			
			
		  </ul>
		  <a class="btn btn-default dropdown-toggle" role="button" id="dropdownMenu1" href="/admin/vpnusers/adduser">Add new peer</a>
			
		</div>

		<br>
		
		  
			<br>
		<?php foreach ($users as &$user)
			{
				$result=exec('cat /etc/openvpn/openvpn-status.log | grep ' . $user);
				if ($result){
				echo "<div class='alert alert-success clearfix' role='alert'>";
					echo  "<div class='pull-left' style='margin-top: 7px !IMPORTANT;'>".$user.'</div>';
					echo "<div>";
					echo "<a class='btn btn-default pull-right' href='/admin/vpnusers/userdetails?username=".$user."' role='button'>details</a>";
					echo "</div>";
				echo "</div>";
				}
				else
				{
				echo "<div class='alert alert-warning clearfix' role='alert'>";
					echo "<div class='pull-left' style='margin-top: 7px !IMPORTANT;'>".$user.'</div>';
					echo "<div>";
						echo "<a class='btn btn-default pull-right' href='/admin/vpnusers/userdetails?username=".$user."' role='button'>details</a>";
					echo "</div>";
				echo "</div>";
				}
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
