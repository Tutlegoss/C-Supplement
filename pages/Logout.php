<?php
	function logout() 
	{ 
		if(isset($_SESSION['LoggedIn']) && $_SESSION == TRUE) {
			echo "<h3 class='heading'>Logging Out</h3>";
			echo "<hr>";
			echo "<p class='kentYellow'>Logging out of session. Redirecting to the home page...";
			session_destroy(); 
		}
		else {
			echo "<h3 class='heading'>Not Signed In</h3>";
			echo "<hr>";
			echo "<p class='kentYellow'>You aren't currently signed in. Redirecting to the home page...";
		}
	}

	$article = "Kpp Logout";
	require_once("../inc/header.inc.php"); 
?>
	<title><?php echo $headerData["Title"]; ?></title>
	<meta name="description" content="<?php echo $headerData["Description"]; ?>">

</head>

<body>
	<?php require_once("../inc/navbar.inc.php"); ?>
	
	<div id="content">
		<div class="container-fluid">
			<div class="row">
				<div id="article" class="col-12">
					<div class="container d-flex h-100">
						<div class="row justify-content-center align-self-center mx-auto">
							<div class="col-12" id="accountTxt">
								<?php logout() ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php
		require_once("../inc/footer.inc.php"); 
		header("refresh: 3; url='../index.php'");
	?>
		
</body>
</html>