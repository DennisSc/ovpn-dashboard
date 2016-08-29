<?php
$date = shell_exec('date +"%H%M%S-%Y%m%d"');
$date = str_replace(array("\r", "\n"), '', $date);

$hostname = shell_exec('hostname');
$hostname = str_replace(array("\r", "\n"), '', $hostname);

$downloadfile = "/etc/openvpn/server.conf";
$filesize = filesize($downloadfile);

$filename = $hostname;
$filename .= "-ovpn-server-backup-".$date.".conf";



#$filename="test.conf";

header("Content-Type: application/octet-stream"); 
header('Content-Disposition: attachment; filename="'.$filename.'"'); 
header("Content-Length: $filesize");
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
readfile($downloadfile);
exit;
?>
