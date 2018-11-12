<?php

	$con = new MongoClient();
	// $con = new MongoDB\Driver\Manager("mongodb://localhost:27017");

	$db = $con->quickbook;
	
	$col = $db->users;
	
	$insert = array(
	
				"username" => "admin", 
				"password" => "0192023a7bbd73250516f069df18b500", 
				"first_name" => "Arun", 
				"last_name" => "Lakshmanan", 
				"email" => "hotmailabc@gmail.com"
				
			);
	$col->insert($insert);
	


?>
