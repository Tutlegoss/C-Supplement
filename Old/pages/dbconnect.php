<?php
	/* Used to open database */
	require_once('../pdoconfig.php');
	error_reporting(-1);
	ini_set("display_errors","0");
	ini_set("log_errors",0);
	ini_set("error_log","dbcon-error.log");
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $database);

	if(!$conn){
		die('Could not connect: ' . mysqli_error($conn));
	}
	//else
	//  echo "Database Connection was successful";
