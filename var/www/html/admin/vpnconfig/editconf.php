<?php 
$date = shell_exec('date "+%A %W %Y %X"');
$hostname = shell_exec('hostname');

$proto = shell_exec("cat /etc/openvpn/server.conf | grep proto | cut -c 7-");
$port  = shell_exec("cat /etc/openvpn/server.conf | grep port  | cut -c 6-");
$serverNet = shell_exec("cat /etc/openvpn/server.conf | grep server | cut -c 8-");
$serverNetArr = explode(' ', $serverNet);



 ?>


<html>
  <head>
<?php include '../header.php'; ?>
  
  <title>DSC oVPN ConfSrv</title>

<style>
.modal, .modal-open {
  margin-right: 0px !important;
}
</style>

  </head>
  	<body style="overflow: scroll !important;">

<?php 

function startsWith($haystack, $needle)
{
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}


							$serverNet = shell_exec("cat /etc/openvpn/server.conf | grep 'server ' | cut -c 8-");
							$serverNet = str_replace(array("\r", "\n"), '', $serverNet);
							$serverNetArr = explode(' ', $serverNet);
							$proto = shell_exec("cat /etc/openvpn/server.conf | grep proto | cut -c 7-");
							$proto = str_replace(array("\r", "\n"), '', $proto);
							$port  = shell_exec("cat /etc/openvpn/server.conf | grep port  | cut -c 6-");
							$port = str_replace(array("\r", "\n"), '', $port);
							$cipher  = shell_exec("cat /etc/openvpn/server.conf | grep 'cipher '  | cut -c 8-");
							$cipher = str_replace(array("\r", "\n"), '', $cipher);
							$interclient  = shell_exec("cat /etc/openvpn/server.conf | grep 'client-to-client'");
							$interclient = str_replace(array("\r", "\n"), '', $interclient);
							$compression  = shell_exec("cat /etc/openvpn/server.conf | grep 'comp-lzo'");
							$compression = str_replace(array("\r", "\n"), '', $compression);





if (startsWith($interclient,";")) {
$interclient="disabled";
}else{
$interclient="enabled";
}

if (startsWith($compression,";")) {
$compression="disabled";
}else{
$compression="enabled";
}
						?>
					  
<?php include '../navbar.php'; ?>
<div class="container">
	<div class="jumbotron">
		<br>
		<h3>openVPN server configuration editor</h3>
		<br>
		<div class="panel panel-default">
		  <div class="panel-body">
						 <br><p><a class="btn btn-primary btn-lg" href="javascript:history.go(-1)" role="button">back</a><tab><a class="btn btn-primary btn-lg" style="margin-left: 12px !IMPORTANT;" href="javascript:window.location.reload(true)" role="button">reload current values</a></p><br>
		<div class='well'>
			<form role="form" id="formfield" action="/admin/vpnconfig/changeconf">

				<div class="row">
					<div class="col-lg-5">
					  <b>Protocol (<?=$proto?>):</b>
					</div>
			  		<div class="col-lg-5">
					  <label class="radio-inline"><input type="radio" name="proto" value="tcp" id="proto" <?php if ($proto == "tcp"){echo "checked";}?>>TCP</label>
					  <label class="radio-inline"><input type="radio" name="proto" value="udp" id="proto" <?php if ($proto == "udp"){echo "checked";}?>>UDP</label>
					</div>
			  		<div class="col-lg-2">

					</div>
				</div><br>				

			  <div class="row">
					<div class="col-lg-5">
					  <b>Port (<?=$port?>):</b>
					</div>
			  		<div class="col-lg-5">
					  <input type="text" name="port" value="<?=$port?>" id="port" ></input>
					</div>
			  		<div class="col-lg-2">
			
					</div>
				</div><br>	

 			  <div class="row">
					<div class="col-lg-5">
					  <b>Transit network (<?=$serverNetArr[0]?>/<?=$serverNetArr[1]?>):</b>
					</div>
			  		<div class="col-lg-6">
						<input type="text"  id="transnet" name="TransSubnet" value="<?=$serverNetArr[0]?>" ></input>
						<input type="text"  id="transmask" name="TransNetmask" value="<?=$serverNetArr[1]?>" ></input>

					</div>
			  		<div class="col-lg-1">
						
					</div>
				</div><br>	

				<div class="row">
					<div class="col-lg-5">
					  <b>Cipher (<?=$cipher?>):</b>
					</div>
			  		<div class="col-lg-6">
					  <label class="radio-inline"><input id="cipher" type="radio" name="cipher" value="DES-EDE3-CBC" <?php if ($cipher === "DES-EDE3-CBC"){echo "checked";}?>>3DES</label>
					  <label class="radio-inline"><input id="cipher" type="radio" name="cipher" value="BF-CBC" <?php if ($cipher === "BF-CBC"){echo "checked";}?>>Blowfish</label>
					  <label class="radio-inline"><input id="cipher" type="radio" name="cipher" value="AES-128-CBC" <?php if ($cipher === "AES-128-CBC"){echo "checked";}?>>AES128</label>
					  <label class="radio-inline"><input id="cipher" type="radio" name="cipher" value="AES-256-CBC" <?php if ($cipher === "AES-256-CBC"){echo "checked";}?>>AES256</label>
					</div>
			  		<div class="col-lg-1">
			
					</div>
				</div><br>	


				<div class="row">
					<div class="col-lg-5">
					  <b>Allow client-to-client communication (<?=$interclient?>):</b>
					</div>
			  		<div class="col-lg-5">
					  <label class="radio-inline"><input type="radio" id="interclient" name="interclient" value="1" <?php if ($interclient == "enabled"){echo "checked";}?>>enabled</label>
					  <label class="radio-inline"><input type="radio" id="interclient" name="interclient" value="0" <?php if ($interclient == "disabled"){echo "checked";}?>>disabled</label>
					</div>
			  		<div class="col-lg-2">

					</div>
				</div><br>				

				<div class="row">
					<div class="col-lg-5">
					  <b>LZO compression (<?=$compression?>):</b>
					</div>
			  		<div class="col-lg-5">
					  <label class="radio-inline"><input type="radio" name="lzo" id="lzo" value="1" <?php if ($compression == "enabled"){echo "checked";}?>>enabled</label>
					  <label class="radio-inline"><input type="radio" name="lzo" id="lzo" value="0" <?php if ($compression == "disabled"){echo "checked";}?>>disabled</label>
					</div>
			  		<div class="col-lg-2">

					</div>
				</div><br>		


				<div class="row">
					<div class="col-lg-5">
					</div>
			  		<div class="col-lg-5">
					</div>
			  		<div class="col-lg-2">
						<input type="button" name="btn" value="Submit" id="submitBtn" data-toggle="modal" data-target="#confirm-submit" class="btn btn-default pull-right" />					  

					</div>
				</div><br>		



			</form>




<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Confirm Submit
            </div>
            <div class="modal-body">
                Are you sure you want to submit the following changes to the server configuration file?

                <!-- We display the details entered by the user here -->
                <table class="table">
                    <tr>
                        <th>Protocol</th>
                        <td id="prot"></td>
                    </tr>
                    <tr>
                        <th>Transit </th>
                        <td id="prt"></td>
                    </tr>
                    <tr>
                        <th>Transit Network</th>
                        <td id="transnt"></td>
                    </tr>
                    <tr>
                        <th>Transit Netmask</th>
                        <td id="transmsk"></td>
                    </tr>
                    <tr>
                        <th>Cipher</th>
                        <td id="ciph"></td>
                    </tr>
                    <tr>
                        <th>Allow communication between clients</th>
                        <td id="intercl"></td>
                    </tr>
                    <tr>
                        <th>Enable LZO compression</th>
                        <td id="clzo"></td>
                    </tr>

                </table>

            </div>

  <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <a href="#" id="submit" class="btn btn-success success">Submit</a>
        </div>
    </div>
</div>
</div>

			<script>
			$('#submitBtn').click(function() {
				 $('#prot').text(document.querySelector('input[name="proto"]:checked').value);
				 $('#prt').text($('#port').val());
				 $('#ciph').text(document.querySelector('input[name="cipher"]:checked').value);
				 $('#transnt').text($('#transnet').val());
				 $('#transmsk').text($('#transmask').val());
				 $('#intercl').text(document.querySelector('input[name="interclient"]:checked').value);
				 $('#clzo').text(document.querySelector('input[name="lzo"]:checked').value);

			});

			$('#submit').click(function(){
			
				$('#formfield').submit();
			});
			</script>


		
	</div>
</div>
<br></div>
</div>
	</body>
</html>



