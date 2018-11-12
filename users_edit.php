<?php
	function main() {
		include "config.php";
		$_SESSION["RANDER_USERSEDIT"] = md5(rand(8, 10));
		
		if( isset($_GET["token"]) && $_GET["token"] == $_SESSION["SES_TOKEN"] && isset($_GET['id']) && ($_GET['id'] > 0) ) {
			$id = (int) $_GET["id"];
			$pdo = new PDO("mysql:hostname=$db_hostname;dbname=$db_database", $db_username, $db_password);
			$qry_users = "select * from users where id='".$id."'";
			$st_users = $pdo->query($qry_users);		
			if($st_users->rowCount() > 0) {
				$rtn_login = $st_users->fetch();
				$id = $rtn_login["id"];
				$u_name = $rtn_login["u_name"];
				$u_login = $rtn_login["u_login"];
				$u_photo = $rtn_login["u_photo"];
			} else {
				header('Location:users_list.php?token='.$_GET["token"]);
			}
		} else {
			header('Location:users_list.php?token='.$_GET["token"]);
		}
		
?>
	<h2>Users Add :</h2>
	<div class="col-md-12" >
	<form method="post" enctype="multipart/form-data" action="users.php">
		<input type="hidden" name="users_key" id="users_key" value="<?php echo $_SESSION["RANDER_USERSEDIT"]; ?>" />
		<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
		<div class="form-group">
			<label for="u_name">Name * :</label>
			<input class="form-control" type="text" name="u_name" id="u_name" required value="<?php echo $u_name; ?>"  />
		</div>
		<div class="form-group">
			<label for="u_login">User Name * :</label>
			<input class="form-control" type="text" name="u_login" id="u_login" required value="<?php echo $u_login; ?>"  />
		</div>
		<div class="form-group">
			<label for="u_photo">User Photo :</label>
			<input class="form-control" type="file" name="u_photo" id="u_photo" />
		</div>
		<div class="form-group">
			<input class="btn btn-success" type="submit" name="submit_action" id="submit_action" value="Update" />
			<input class="btn btn-danger" type="button" value="Cancel" onclick="history.back();" />
		</div>
	</form>
	</div>
	
<?php } include("template.php"); ?>