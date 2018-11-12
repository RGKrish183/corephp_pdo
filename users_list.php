<?php
	function main() {
		include "config.php";
		
		$pdo = new PDO("mysql:hostname=$db_hostname;dbname=$db_database", $db_username, $db_password);
		$qry_users = "select * from users";
		$st_users = $pdo->query($qry_users);
?>
	<div class="col-md-12" >
		<a href="users_add.php?token=<?php echo $_SESSION["SES_TOKEN"]; ?>" class="btn btn-warning float-right" >ADD</a>
	</div>
	<div class="col-md-12" >
		<h2>Users List</h2>
	</div>
	<div class="col-md-12" >
	<?php 
		if(isset($_SESSION["USERSFLASH_MSG"])){
			echo "<h5 style='color:red;'>".$_SESSION["USERSFLASH_MSG"]."</h5><br/>";
			unset($_SESSION["USERSFLASH_MSG"]);
		}
	?>	
	</div>
	
	<div class="col-md-12" >
		<table id="tbl_users" class="table">
			<thead>
				<tr>
					<th>Name</th>
					<th>User Name</th>
					<th>User Photo</th>
					<th>Created Date</th>
					<th>Action</th>
				</tr>
			<thead>
			<tbody>
			<?php
				if($st_users->rowCount() > 0) {
					$rtn_users = $st_users->fetchAll();
					foreach($rtn_users as $users){
			?>
				<tr>
					<td><?php echo $users["u_name"]; ?></td>
					<td><?php echo $users["u_login"]; ?></td>
					<td><?php echo $users["u_photo"]; ?></td>
					<td><?php echo date('d-m-Y H:i:s', strtotime($users["u_cd"])); ?></td>
					<td>
					<a href="users_edit.php?token=<?php echo $_SESSION["SES_TOKEN"]; ?>&id=<?php echo $users['id'];?>" class="btn btn-warning" >U</a>
					&nbsp;&nbsp;
					<a href="users.php?submit_action=delete&token=<?php echo $_SESSION["SES_TOKEN"]; ?>&id=<?php echo $users['id'];?>" class="btn btn-danger" onclick="return confirm('Are you sure wants to remove this record?');" >D</a>
					</td>
				</tr>
			<?php
					}
				}
			?>
			<tbody>
		</table>
	</div>
	<script>
		$(document).ready( function () {
			$('#tbl_users').DataTable();
		});	
	</script>
	
<?php } include("template.php"); ?>