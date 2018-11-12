<?php
	include("config.php");	
	session_start();
	
	if( isset($_GET["submit_action"]) && $_GET["submit_action"]== "delete" ) {

		if( isset($_GET["token"]) && $_GET["token"] == $_SESSION["SES_TOKEN"] && isset($_GET['id']) && ($_GET['id'] > 0) ) {
			$id = (int) $_GET["id"];
			$pdo = new PDO("mysql:hostname=$db_hostname;dbname=$db_database", $db_username, $db_password);
			echo $qry_users = "delete from users where id='".$id."' ";
			$st_users = $pdo->query($qry_users);
			$_SESSION["USERSFLASH_MSG"] = "Users details removed successfully";
			header('Location:users_list.php?token='.$_SESSION["SES_TOKEN"]);
			exit();
		} else {
			$_SESSION["USERSFLASH_MSG"] = "Malform action issue, Kindly check it.";
			header('Location:users_list.php?token='.$_GET["token"]);
			exit();
		}
	} else if( isset($_POST["submit_action"]) && $_POST["submit_action"]== "Add" ) {
		if( isset($_POST["users_key"]) && $_POST["users_key"] == $_SESSION["RANDER_USERSADD"]) {
			
			$u_name = $_POST["u_name"];
			$u_login = $_POST["u_login"];
			$u_pass = $_POST["u_pass"];
			$u_photo = $_FILES["u_photo"];
			
			if(isset($u_login) && isset($u_pass)) { 
				$pdo = new PDO("mysql:hostname=$db_hostname;dbname=$db_database", $db_username, $db_password);
				
				$u_photo_name = "";
				if(isset($u_photo)) {
					$u_photo_name = time()."-".basename($u_photo["name"]);
					move_uploaded_file($u_photo["tmp_name"], "upload/".$u_photo_name);
				}
				
				$qry_users = "insert into users set u_name='".$u_name."', u_login='".$u_login."', u_pass='".md5($u_pass)."', u_photo='".$u_photo_name."', u_cd=now()";
				$st_users = $pdo->query($qry_users);
				$_SESSION["USERSFLASH_MSG"] = "Users details added successfully";
				header('Location:users_list.php?token='.$_SESSION["SES_TOKEN"]);
				exit();
			} else {
				$_SESSION["USERSFLASH_MSG"] = "Users details notfound";
				header('Location:users_list.php?token='.$_SESSION["SES_TOKEN"]);
				exit();
			}
		} else {
			$_SESSION["USERSFLASH_MSG"] = "Malform action issue, Kindly check it.";
			header('Location:users_list.php?token='.$_SESSION["token"]);
			exit();
		}
	} else if( isset($_POST["submit_action"]) && $_POST["submit_action"]== "Update" ) {
		if( isset($_POST["users_key"]) && $_POST["users_key"] == $_SESSION["RANDER_USERSEDIT"]) {
			
			$id = $_POST["id"];
			$u_name = $_POST["u_name"];
			$u_login = $_POST["u_login"];
			$u_photo = $_FILES["u_photo"];
			
			if(isset($u_login) && isset($id)) { 
				$pdo = new PDO("mysql:hostname=$db_hostname;dbname=$db_database", $db_username, $db_password);
				
				$u_photo_name = "";
				if($u_photo["size"] > 0) {
					$u_photo_name = time()."-".basename($u_photo["name"]);
					move_uploaded_file($u_photo["tmp_name"], "upload/".$u_photo_name);
				}
				
				$qry_users = "update users set u_name='".$u_name."', u_login='".$u_login."', u_photo='".$u_photo_name."', u_md=now() where id ='".$id."'";
				$st_users = $pdo->query($qry_users);
				$_SESSION["USERSFLASH_MSG"] = "Users details updated successfully";
				header('Location:users_list.php?token='.$_SESSION["SES_TOKEN"]);
				exit();
			} else {
				$_SESSION["USERSFLASH_MSG"] = "Users details notfound";
				header('Location:users_list.php?token='.$_SESSION["SES_TOKEN"]);
				exit();
			}
		} else {
			$_SESSION["USERSFLASH_MSG"] = "Malform action issue, Kindly check it.";
			header('Location:users_list.php?token='.$_SESSION["token"]);
			exit();
		}
	} else {
		$_SESSION["USERSFLASH_MSG"] = "Somthing went wrong, Kindly check it0000000000";
		header('Location:users_list.php?token='.$_SESSION["token"]);
		exit();
	}
?>