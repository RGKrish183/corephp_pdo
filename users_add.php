<?php
	function main() {
		include "config.php";
		$_SESSION["RANDER_USERSADD"] = md5(rand(8, 10));
?>
	<h2>Users Add :</h2>
	<div class="col-md-12" >
	<form method="post" enctype="multipart/form-data" action="users.php">
		<input type="hidden" name="users_key" id="users_key" value="<?php echo $_SESSION["RANDER_USERSADD"]; ?>" />
		<div class="form-group">
			<label for="u_name">Name * :</label>
			<input class="form-control" type="text" name="u_name" id="u_name" required />
		</div>
		<div class="form-group">
			<label for="u_login">User Name * :</label>
			<input class="form-control" type="text" name="u_login" id="u_login" required />
		</div>
		<div class="form-group">
			<label for="u_pass">User Password * :</label>
			<input class="form-control" type="password" name="u_pass" id="u_pass" required />
		</div>
		<div class="form-group">
			<label for="u_photo">User Photo :</label>
			<input class="form-control" type="file" name="u_photo" id="u_photo" />
		</div>
		<div class="form-group">
			<input class="btn btn-success" type="submit" name="submit_action" id="submit_action" value="Add" />
			<input class="btn btn-danger" type="button" value="Cancel" onclick="history.back();" />
		</div>
	</form>
	</div>
	
<?php } include("template.php"); ?>