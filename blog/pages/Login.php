<?php

?>

<!DOCTYPE html>
<html>

<head>
	
	<?php
		$article = "Kpp Login";
		require_once("../inc/header.inc.php"); 
	?>
	<title><?php echo $headerData["Title"]; ?></title>
	<meta name="description" content="<?php echo $headerData["Description"]; ?>">

</head>

<body>
	<?php require_once("../inc/navbar.php"); ?>
	
	<div id="content">
		<div class="container-fluid">
			<div class="row">
				<div id="article" class="col-12">
					<div class="container d-flex h-100">
						<div class="row justify-content-center align-self-center mx-auto">
							<div class="col-12">
								<h3 class="heading">Sign In</h3>
								<hr>
								<form action="Login.php" method="POST" id="accountTxt">
									<div class="form-group">
										<label class="kentBlue" for="Username">Username</label>
										<input class="fieldSize mb-2" type="text" name="Username" id="Username" required>
										<br>
										<label class="kentYellow" for="Password">Password</label>
										<input class="fieldSize" type="password" name="Password" id="Password" required>
										<br>
										<button type="submit" class="btn btnBlue mt-3">Submit</button>
										<br>
										<br>
										<a href="#">Forgot Password?</a><span class="kentYellow"> | </span> 
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