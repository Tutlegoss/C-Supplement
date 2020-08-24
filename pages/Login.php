<?php
	
    session_start();
    
	function loggedIn() 
	{
		if(isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] == TRUE) 
			header("Location: ../index.php");
	}
	
	function validateLogin()
	{
		if($_POST) {
			global $conn;

			/* See if username exists and verify password */
			$accountCheck = $conn->prepare("SELECT * FROM Accounts WHERE Username = ?;");
			$accountCheck->bindParam(1, $_POST["Username"], PDO::PARAM_STR, 16);
			$accountCheck->execute();
			$accountCheck = $accountCheck->fetch(PDO::FETCH_ASSOC);
			/* Retry login */
			if(!$accountCheck || !password_verify($_POST['Password'],$accountCheck['Password'])) 
            {
				echo "<p class='kentYellow ml-4'>There is an issue with Username and/or Password.</p>";
				return FALSE;
			}
			/* Populate $_SESSION - session_start() in header.inc.php */
			else {
				$_SESSION['LoggedIn']  = 1;
				$_SESSION['Username']  = $accountCheck['Username'];
				$_SESSION['Privilege'] = $accountCheck['Privilege'];
				$_SESSION['ID']        = $accountCheck['ID'];
				header("Location: ../index.php");
			}
		}
	}

	$article = "Kpp Login";
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
								<h3 class="heading">Log In</h3>
								<hr style="border-color: #002664;">
								<?php loggedIn(); validateLogin(); ?>
								<form action="Login.php" method="POST">
									<div class="form-group">
										<table>
											<tr>
												<td>
													<label class="mt-2 kentBlue" for="Username">Username</label>
												</td>
												<td class="pl-4">
													<input class="fieldSize" type="text" name="Username" id="Username" required>
												</td>
											</tr>
											<tr>
												<td>
													<label class="mt-2 kentYellow" for="Password">Password</label>
												</td>
												<td class="pl-4">
													<input class="fieldSize" type="password" name="Password" id="Password" pattern=".{8,30}" required>
												</td>
											</tr>
										</table>
										<button type="submit" class="btn btnBlue mt-3">Submit</button>
										<br>
										<br>
										<a href="./Forgot.php">Forgot Password?</a><span class="kentYellow"> | </span> 
										<a href="./Signup.php">Sign Up</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php
		require_once("../inc/footer.inc.php"); 
	?>
		
</body>
</html>

<script>
/* https://stackoverflow.com/questions/14236873/disable-spaces-in-input-and-allow-back-arrow */
	$(document).ready(function() {
		$('#Username').on({
			keydown: function(e) {
				if(e.which === 32)
					return false;
			},
			change: function() {
				this.value = this.value.replace(/\s/g, "");
			}
		});
	});
</script>