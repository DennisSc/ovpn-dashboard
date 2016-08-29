  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script type="text/javascript"> 
		function logout() {
			// To invalidate a basic auth login:
			// 
			// 	1. Call this logout function.
			//	2. It makes a GET request to an URL with false Basic Auth credentials
			//	3. The URL returns a 401 Unauthorized
			// 	4. Forward to some "you-are-logged-out"-page
			// 	5. Done, the Basic Auth header is invalid now
		 
			jQuery.ajax({
				    type: "GET",
				    url: "/admin/",
				    async: false,
				    username: "logmeout",
				    password: "123456",
				    headers: { "Authorization": "Basic xxx" }
			})

			.done(function(){
				// If we don't get an error, we actually got an error as we expect an 401!
			})

			.fail(function(){
				// We expect to get an 401 Unauthorized error! In this case we are successfully 
				    // logged out and we redirect the user.
				window.location = "/logoff.php";
			});


			return false;

		}

 </script>
 
 <?php $date = shell_exec('date "+%A %d %b %Y %T"'); ?>
