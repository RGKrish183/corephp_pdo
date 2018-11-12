<?php
	session_start();
	$_SESSION["RANDER_LOGIN"] = md5(rand(8, 10));
?>
<html>
<title>Loader Core</title>
<head>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" media="all" />
<script type="type/javascript" src="assets/js/jquery.min.js"></script>
<script type="type/javascript" src="assets/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
<h2>Login Details</h2>
<div class="row" >
<div class="col-md-8" >
	<?php 
		if(isset($_SESSION["ERRMSG_LGN"])){
			echo "<h5 style='color:red;'>".$_SESSION["ERRMSG_LGN"]."</h5>";
			unset($_SESSION["ERRMSG_LGN"]);
		}
	?>
	<form method="post" enctype="multipart/form-data" action="login.php">
		<input type="hidden" name="lgn_key" id="lgn_key" value="<?php echo $_SESSION["RANDER_LOGIN"]; ?>" />
		<div class="form-group">
			<label for="user_name">User Name * :</label>
			<input class="form-control" type="text" name="user_name" id="user_name" required />
		</div>
		<div class="form-group">
			<label for="user_pass">User Password * :</label>
			<input class="form-control" type="password" name="user_pass" id="user_pass" required />
		</div>
		<div class="form-group">
			<input class="btn btn-success" type="submit" name="submit_action" id="submit_action" value="Login" />
			<input class="btn btn-danger" type="button" value="Cancel" onclick="window.location.reload();" />
		</div>
	</form>
</div>
</div>
</div>

</body>
</html>