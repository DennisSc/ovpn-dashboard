
<?php $pageTitle = "Restore configuration";

$hostname = shell_exec('hostname');
$date = shell_exec('date "+%A %W %Y %X"');
#	<meta http-equiv="refresh" content="8;url=/admin/vpnconfig/restoreconf.php" />

?>

<html>
<head>


		<?php include '../header.php'; ?>

</head>



<body style='overflow: scroll !important;'>
<?php include '../navbar.php'; ?>
	<div class="jumbotron col-md-12"">
		<br>
		<h3 style="text-align: center;"><?=$pageTitle;?></h3>
		<br>
		<div class="panel panel-default col-md-offset-2 col-md-8">
		  <div class="panel-body" >
						 <br><p><a class="btn btn-primary btn-lg" href="javascript:history.go(-1)" role="button">back</a><tab>
						<a class="btn btn-primary btn-lg" style="margin-left: 12px !IMPORTANT;" href="/admin/vpnconfig/restoreconf" role="button">upload another file</a><tab>
						<a class="btn btn-primary btn-lg" style="margin-left: 12px !IMPORTANT;" href="/admin/vpnconfig/cleanup" role="button">Cleanup upload folder</a>
</p>
<br>

			<br><div class="col-md-12 text-center">


				<?php
				$success = 0;
				$target_dir = "/var/www/html/restore/";
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// Check if image file is a actual image or fake image
				if(isset($_POST["submit"])) {
				/*    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
					if($check !== false) {
						echo "File is an image - " . $check["mime"] . ".";
						$uploadOk = 1;
					} else {
						echo "File is not an image.";
						$uploadOk = 0;
					}*/
				}
				// Check if file already exists
				if (file_exists($target_file)) {
					echo "File already exists. ";
					$uploadOk = 0;
				}
				// Check file size
				if ($_FILES["fileToUpload"]["size"] > 500000) {
					echo "Sorry, your file is too large.";
					$uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" && $imageFileType != "conf" ) {
					echo "Sorry, only configuration files are allowed. ";
					$uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					echo "Pattern mismatch. File was not uploaded. ";
				// if everything is ok, try to upload file
				} else {
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
						echo "The file \"". basename( $_FILES["fileToUpload"]["name"]). "\" has been uploaded successfully.";
						$success = 1;
					} else {
						echo "Sorry, there was an error uploading your file.";
					}
				}

				if ($success)
				{
					echo "<br><br>This is your uploaded backup file. Please examine it carefully before applying it to the live configuration.<br><br>";
					$copyresult = shell_exec('cat '.$target_file);
					echo "<pre class='text-left'>".$copyresult."</pre><br>";
					echo '<p><a class="btn btn-primary btn-lg" href="javascript:history.go(-1)" role="button">Cancel</a><tab>';
					echo'<a class="btn btn-primary btn-lg" style="margin-left: 6px !IMPORTANT;" href="/admin/vpnconfig/applyconf?confname='.basename( $_FILES["fileToUpload"]["name"]).'" role="button">Apply</a></p>';
				}

				?>

<br><br></div><br><br>
<br><br>			
</div>
</div>
</div>	

</body>
</html>
