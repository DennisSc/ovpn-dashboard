<?php 
$date = shell_exec('date "+%A %W %Y %X"');
$hostname = shell_exec('hostname');
$username = $_GET['username'];
$rsArr = array();
echo exec("cat /etc/openvpn/openvpn-status.log | grep ".$username, $rsArr);
$BitStatArr = explode(',', $rsArr[0]);
				

 ?>


<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
<?php include '../header.php'; ?>
  
  <title>DSC oVPN peerDetails</title>


<style>
.modal, .modal-open {
  margin-right: 0px !important;
}
</style>

  </head>
  	<body style="overflow: scroll !important;">


<?php include '../navbar.php'; ?>
<div class="container">
	<div class="jumbotron">
		<br>
		<h3>openVPN peer details for <?=$username?></h3>
		<br>
		<div class="panel panel-default">
		  <div class="panel-body">
						 <br><p><a class="btn btn-primary btn-lg" href="javascript:history.go(-1)" role="button">back</a><tab><a class="btn btn-primary btn-lg" style="margin-left: 12px !IMPORTANT;" href="javascript:window.location.reload(true)" role="button">reload</a></p>

		<div class="panel panel-default">
		  <div class="panel-body">

			<h4>Username:
				<?php

				
				$status = exec('cat /etc/openvpn/openvpn-status.log | grep ' . $username);
				$routes = exec("cat /etc/openvpn/ccd/".$username." | sed -r 's/^.{7}//'");
				$StatsArray = explode(',', $status);
				echo $username."</h4>";
#print_r($rsArr);
				

			
			if ($routes){
				echo "S-2-S subnet route:<i> ".$routes."</i><br>";
				$routeArray = explode(' ', $routes);
			}else{
				echo "Roadwarrior<i> (no remote subnet)</i><br>";
			}
			
 
			if ($status){
				echo "<br>Active: yes <button style='padding-top: 1px !IMPORTANT; margin-bottom: 2px !IMPORTANT;' class='btn btn-primary btn-success btn-sm' role='button' disabled></button><br>";			 
				echo "Virtual IP address: " . $StatsArray[0] . "<br>";
				echo "Certificate Common Name: CN=" . $StatsArray[1] . "<br>";
				echo "Public IP address: " . $StatsArray[2] . "<br>";
				echo "Last Heartbeat: " . $StatsArray[3] . "<br>";
				echo "Connected Since: " . $BitStatArr[4] . "<br>";
				echo "Bytes Received: " . $BitStatArr[2] . "<br>";
				echo "Bytes Sent: " . $BitStatArr[3] . "<br>";
			}else{
				echo "<br>Active: no <button style='padding-top: 1px !IMPORTANT; margin-bottom: 2px !IMPORTANT; ' class='btn btn-primary btn-danger btn-sm' role='button' disabled></button><br>";
			}
			
			if ($routes){
				echo "<br><br><button class='btn btn-primary btn-danger' type='button' data-toggle='modal' data-target='#myModal2'>delete s2s peer</button>";
				echo "<br><br><button class='btn btn-primary btn-success' type='button' data-toggle='modal' data-target='#editModal'>edit s2s peer</button>";
		
			}else{
				echo "<br><br><button class='btn btn-primary btn-danger' type='button' data-toggle='modal' data-target='#myModal'>delete dialup peer</button>";
			}
			?>


		  
			<div id="myModal" class="modal fade" role="dialog">
			  <div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Peer deletion confirmation</h4>
				  </div>
				  <div class="modal-body">
					The following dialup peer will be deleted:<br>
					<br>
					<p>
						<b><?=$username?></b>
					</p>
					Please note that this will also revoke the associated user certificate and delete all downloadable user files.<br>
					<br>
					Do you really want to continue?
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<a role="button" class="btn btn-default" href="/admin/wizards/rw-remove?clientname=<?=$username?>">Delete</a>

				  </div>
				</div>

			  </div>
			</div>




			<div id="myModal2" class="modal fade" role="dialog">
			  <div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Peer deletion confirmation</h4>
				  </div>
				  <div class="modal-body">
					The following s2s peer will be deleted:<br><br><p><b><?=$username?></b></p>Please note that this will also revoke the associated user certificate and delete all downloadable user files.<br><br>Do you really want to continue?
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<a role="button" class="btn btn-default" href="/admin/wizards/s2s-remove?clientname=<?=$username?>&subnet=<?=$routeArray[0]?>&netmask=<?=$routeArray[1]?>">Delete</a>

				  </div>
				</div>

			  </div>
			</div>











<div class="modal fade" id="editModal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Edit s2s peer "<?=$username?>"
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                
                <form class="form-horizontal" role="form" action="/admin/wizards/edits2s">
                  <div class="form-group">
                    <label  class="col-sm-2 control-label"
                              for="inputSubnet">Subnet</label>
                    <div class="col-sm-10">
<input type="hidden" class="form-control" id="clientname" name="clientname" value="<?=$username?>"/>                        
						<input class="form-control" 
                        id="inputSubnet" placeholder="Subnet" name="subnet" value="<?=$routeArray[0]?>"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"
                          for="inputNetmask" >Netmask</label>
                    <div class="col-sm-10">
                        <input class="form-control"
                            id="inputNetmask" placeholder="Netmask" name="netmask" value="<?=$routeArray[1]?>"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <br><div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-primary pull-right" >Save</button><tab>
					  <button type="cancel" class="btn btn-primary pull-right" style="margin-right: 10px !important;" data-dismiss="modal">Cancel</button><tab>
                      
                    </div>
                  </div>
                </form>
                
                
                
                
                
                
            </div>
            
            <!-- Modal Footer -->
        </div>
    </div>
</div>

















					
			<div id="editModal2" class="modal fade" role="dialog">
			  <div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">

				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Edit s2s peer</h4>
				  </div>
				  <div class="modal-body">
						<b>Edit route details for peer <?=$username?></b><br><br>
						
						<form role="form" action="/admin/vpnusers/edits2s" >			

						<div class="row">
						 
							  <input type="hidden" type="text" class="form-control" name="clientname" value="<?=$username?>">
				
						  
						  <div class="col-lg-4">
								Edit remote subnet:<br>
							  <input type="text" class="form-control" name="subnet" value="<?=$routeArray[0]?>">
				
						  </div>
						  <div class="col-lg-4">
								Edit remote netmask:<br>
							  <input type="text" class="form-control" name="netmask" value="<?=$routeArray[1]?>">
				
						  </div>
						 </div>
	<btton class="btn btn-default" type="submit" >Submit</input>
				
					</form>
					
					
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				  </div>

				</div>

			  </div>
			</div>


		  </div>
		</div>
	</div>
</div>
<br></div>
</div>
	</body>
</html>



