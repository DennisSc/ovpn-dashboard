
<?php
$output = shell_exec('uname -a');
$output2 = shell_exec('who');
$output3 = shell_exec('uptime');
$clientcount = shell_exec('sudo /var/www/html/admin/getusercount.sh');
$load = sys_getloadavg();

$ovpnactive = shell_exec("sudo /var/www/html/admin/vpnconfig/ovpnservicestatus.sh | grep active  | awk '{ print $2 }'");
$ovpnactive = str_replace(array("\r", "\n"), '', $ovpnactive);


$fh = fopen('/proc/meminfo','r');
  $mem = 0;
  while ($line = fgets($fh)) {
    $pieces = array();
    if (preg_match('/^MemTotal:\s+(\d+)\skB$/', $line, $pieces)) {
      $mem = $pieces[1];
      break;
    }
  }
  fclose($fh);
$fh = fopen('/proc/meminfo','r');
  $memfree = 0;
  while ($line = fgets($fh)) {
    $pieces = array();
    if (preg_match('/^MemFree:\s+(\d+)\skB$/', $line, $pieces)) {
      $memfree = $pieces[1];
      break;
    }
  }
  fclose($fh);

$users= array();
exec('/bin/ls /etc/openvpn/ccd', $users);
$usercount = 0;

foreach ($users as &$user){
	$result=exec('cat /etc/openvpn/openvpn-status.log | grep ' . $user);
				if ($result){
					$usercount=$usercount+1;	
				}	
}

$memused = $mem - $memfree;

$hostname = shell_exec('hostname');

//echo "<pre>$output</pre>";
$pageTitle = "openVPN Dashboard";

?>

<html>
<head>
<title>DSC ovpn Dashboard</title>
<?php include './header.php'; ?>

</head>
<body style='overflow: scroll !important;'>
<?php include './navbar.php'; ?>
<div class="container">
	<div class="jumbotron">
		<br>
		<h3><?=$pageTitle;?></h3>
		<br>
		<div class="panel panel-default">
		  <div class="panel-body">
			<br><p><a class="btn btn-primary btn-lg" href="javascript:history.go(-1)" role="button">back</a><tab><a class="btn btn-primary btn-lg" style="margin-left: 12px !IMPORTANT;" href="javascript:window.location.reload(true)" role="button">reload</a></p>
<br>			
			
	
					<?php
			





						echo "<div class='col-lg-12'>";
							echo "<pre><b>Kernel:</b> $output"; 
							echo "<b>Uptime: </b>$output3"; 
							echo "<b><br>Logged on users:</b><br>$output2</pre>"; 
						echo "</div>";			



						echo "<div class='col-lg-6'>";
								if ($ovpnactive == "active"){
									echo "<pre style='height:93px; '><b>openVPN service status: running </b><button style='padding-top: 1px !IMPORTANT; margin-bottom: 2px !IMPORTANT;' class='btn btn-primary btn-success btn-sm' role='button' disabled></button><a href='/admin/vpnconfig/servicerestartselect'><br><br><b>Restart services</b></a></pre>";			 
									
								}else{
									echo "<pre style='height:93px; '><b>openVPN service status: down </b><button style='padding-top: 1px !IMPORTANT; margin-bottom: 2px !IMPORTANT; ' class='btn btn-primary btn-danger btn-sm' role='button' disabled></button><a href='/admin/vpnconfig/servicerestartselect'><br><br><b>Restart services</b></a></pre>";
								echo "";
								}								
						echo "</div>";
					

						echo "<div class='col-lg-6'>";
						if ($usercount > 0){}
						$link="<a href='/admin/vpnusers/showusers'>View vpn peer list</a>";
						echo "<pre style='margin-left: -4px;'><b><div class='pull-left'>Active connections: ".$usercount."<br>Total peer count: ".$clientcount."<br>".$link."</b></div></pre>";
						echo "</div>";

						
								
								
					?>


<div class='col-lg-12'>
						
<pre><b><div class="pull-left"><a href='/admin/vpninfo/vpninfo'>View connections and routing table</a></div></b></pre>

</div>						
						
					
<hr>
	<div class='col-lg-12'>
		<table style="width:100%; " cellspacing="40">
		<tr>
			<td style="width:44%">
			  <div class="panel panel-default">
			  <div class="panel-heading" style="font-size: 13px !IMPORTANT; font-family: Menlo,Monaco,Consolas,Courier New,monospace;"><b>CPU load (avg over last 1/5/15 min.): </b><?=$load[0];?>, <?=$load[1];?>, <?=$load[2];?></div>
			  <div class="panel-body">			
			
			<div class="progress">
			  <div class="progress-bar" role="progressbar" aria-valuenow="<?=$load[0];?>" aria-valuemin="0" aria-valuemax="100" style="min-width: 0em; width: <?=$load[0];?>%">
				<?=$load[0];?>%
				<span class="sr-only">actual load: <?=$load[0];?> percent</span>
			  </div>
			</div>
			<div style="font-size: 13px; font-family: Menlo,Monaco,Consolas,Courier New,monospace;"><b><a href='/admin/sysinfo/procinfo'>View running processes</a></b></div>
	
</div>
</div>

			</td>
			<td style="width:2%"></td>
			<td style="width:44%">
			<div class="panel panel-default">
			<div class="panel-heading" class="panel-heading" style="font-size: 13px !IMPORTANT; font-family: Menlo,Monaco,Consolas,Courier New,monospace;"><b>Memory usage: </b><?=$memused;?> of <?=$mem;?> bytes</div>
			<div class="panel-body">			
			<div class="progress">
			  <div class="progress-bar" role="progressbar" aria-valuenow="<?=$memused;?>" aria-valuemin="0" aria-valuemax="<?=$mem;?>" style="min-width: 0em; width: <?=(((1 / $mem) * $memused)*100);?>%">
					<?=round((((1 / $mem) * $memused)*100),0);?>%
				<span class="sr-only">mem usage: <?=$memused;?> of <?=$mem;?> bytes</span>
			  </div>
			</div>
			<div style="font-size: 13px; font-family: Menlo,Monaco,Consolas,Courier New,monospace;"><b><a href='/admin/sysinfo/meminfo'>View memory allocation</a></b></div>
			</div>
			</div>
			</td>
			
		</tr>

</div>
		</table>



	</div>
</div>
	</div>
</div>
</body>
</html>
