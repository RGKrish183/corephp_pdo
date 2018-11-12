<?php
	include("config.php");
	session_start();
	
	if(isset($_SESSION["SES_ID"]) && ($_GET["token"] != $_SESSION["SES_TOKEN"])) {
		header('Location:index.php');
	}
?>
<html>
<title>Loader Core</title>
<head>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" media="all" />
<link rel="stylesheet" href="assets/css/jquery.dataTables.min.css" type="text/css" media="all" />
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<div class="row" >
<?php main(); ?>
</div>
</div>
</body>
</html>