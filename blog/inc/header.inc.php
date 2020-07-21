<?php 
	require_once("pdoconfig.php"); 
	$headerData = $conn->query("SELECT * FROM Headers WHERE Title='$article';");
	$headerData->execute();
	$headerData = $headerData->fetch(PDO::FETCH_ASSOC);
	$conn = null;
?>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<link rel="icon" href="<?php echo $headerData["Path"]; ?>img/K_Ico.png">
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet"> 
	<link href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" rel="stylesheet"/> 

	<!-- Directory relative to article page and not header.inc.php -->
	<script src="<?php echo $headerData["Path"]; ?>inc/jquery-3.5.1.min.js"></script>
	<script src="<?php echo $headerData["Path"]; ?>inc/bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>
	
	<link rel="stylesheet" href="<?php echo $headerData["Path"]; ?>inc/normalize.css">
	<link rel="stylesheet" href="<?php echo $headerData["Path"]; ?>inc/bootstrap-4.5.0-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $headerData["Path"]; ?>css/main.css">