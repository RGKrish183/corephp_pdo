<?php
	include("config.php");	
	session_start();
	
	if( isset($_POST["submit_action"]) && $_POST["submit_action"]== "Login" ) {
		if( isset($_POST["lgn_key"]) && ($_POST["lgn_key"]== $_SESSION["RANDER_LOGIN"]) ) {

			$login_username = $_POST["user_name"];
			$login_userpass = md5($_POST["user_pass"]);
		
			$pdo = new PDO("mysql:hostname=$db_hostname;dbname=$db_database", $db_username, $db_password);
			$qry_login = "select * from users where u_login='".$login_username."' ";
			$st_login = $pdo->query($qry_login);
			
			if($st_login->rowCount() > 0) {
				$rtn_login = $st_login->fetch();
				if($rtn_login["u_pass"]==$login_userpass) {
					$_SESSION["SES_ID"] = $rtn_login["id"];
					$_SESSION["SES_NAME"] = $rtn_login["u_name"];
					$_SESSION["SES_USERNAME"] = $rtn_login["u_login"];
					$_SESSION["SES_PHOTO"] = $rtn_login["u_photo"];
					$_SESSION["SES_TOKEN"] = md5(rand(8, 10));
					header('Location:users_list.php?token='.$_SESSION["SES_TOKEN"]);
				} else {
					$_SESSION["ERRMSG_LGN"] = "Passowrd not matched, Kindly check it.";
					header('Location:index.php');
				}
			} else {
				$_SESSION["ERRMSG_LGN"] = "Username not found, Kindly check it.";
				header('Location:index.php');
			}
		} else {
			$_SESSION["ERRMSG_LGN"] = "Malform action issue, Kindly check it.";
			header('Location:index.php');
		}
	} else {
		$_SESSION["ERRMSG_LGN"] = "Somthing went wrong, Kindly check it";
		header('Location:index.php');
	}
?>