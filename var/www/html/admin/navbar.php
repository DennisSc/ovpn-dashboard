
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
	<a  href="/admin" class="navbar-brand"><img src="/admin/ovpnlogo.png" width="22px" heigth="22px" alt="DSC ovpn GUI"></a>
	<ul class="nav navbar-nav">

		<li><a href="/admin/">Dashboard</a></li>
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false" id="vpnStats">vpnStatus <span class="caret"></span></a>
				  <ul class="dropdown-menu" aria-labelledby="vpnStats">
					<li><a href="/admin/sysinfo/tunifinfo">tun0 statistics</a></li>
					<li><a href="/admin/vpninfo/vpninfo">Connection statistics</a></li>
					<li><a href="/admin/vpninfo/vpnlog">View openVPN logfile</a></li>
					<li><a href="/admin/vpninfo/vpnconf">View server config</a></li>
					
					
				  </ul>
		</li>
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false" id="vpnConfig">vpnConfig <span class="caret"></span></a>
				  <ul class="dropdown-menu" aria-labelledby="vpnConfig">
					<li><a href="/admin/vpnconfig/editconf">Edit live configuration</a></li>
					<li><a href="/admin/vpnconfig/servicerestartselect">Restart services</a></li>
					<li><a href="#">Shutdown & reboot</a></li>
					<li><a href="/admin/vpnconfig/backupconf">Backup config file</a></li>
					<li><a href="/admin/vpnconfig/restoreconf">Restore config backup</a></li>
					
				  </ul>
		</li>

		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false" id="vpnUsers">vpnPeers <span class="caret"></span></a>
				  <ul class="dropdown-menu" aria-labelledby="vpnUsers">
					<li><a href="/admin/vpnusers/showusers">Peer overview</a></li>
					<li><a href="/admin/vpnusers/adduser">Add new peer</a></li>
					<li><a href="/admin/vpninfo/calog">CA revocation list</a></li>
					<li><a href="/admin/vpnusers/forcerevoke">Revoke certificates</a></li>

				  </ul>
		</li>
		<li><a href="/download/">Downloads</a></li>

		<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false" id="SysInfo">SysInfo <span class="caret"></span></a>
				  <ul class="dropdown-menu" aria-labelledby="SysInfo">
				    <li><a href="/admin/sysinfo/lanifinfo">eth0 statistics</a></li>
				    <li><a href="/admin/sysinfo/meminfo">Memory usage</a></li>
					<li><a href="/admin/sysinfo/diskinfo">Disk usage</a></li>
					<li><a href="/admin/sysinfo/cpuinfo">CPU information</a></li>
					<li><a href="/admin/sysinfo/procinfo">Process info</a></li>
					
					<li><a href="/admin//phpinfo">Show PHPinfo</a></li>

				    <li role="separator" class="divider"></li>
				    <li><a href="/admin/">Dashboard</a></li>

				  </ul>
		</li>
		<li><a href="javascript:void(0);" onclick="logout();">Logout</a></li>
			</ul>
	<p class="navbar-text navbar-right"><?=$hostname;?> - <?=$date;?></p>
	
  </div>
</nav>
