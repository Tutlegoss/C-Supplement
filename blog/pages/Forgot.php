<?php
	function validateEmail()
	{
		if($_POST) {
			global $conn;
			
			/* Check for existing email */
			$emailExists = $conn->prepare("SELECT * FROM Accounts WHERE Email = ?;");
			$emailExists->bindParam(1, $_POST["Email"], PDO::PARAM_STR, 24);
			$emailExists->execute();
			$emailExists = $emailExists->fetch(PDO::FETCH_ASSOC);
			
			/* Process reset password email */
			if($emailExists) {
				
				$ext = bin2hex(random_bytes(16));
				$URL = "https://www.kentcpp.com/Blog/pages/ResetPass.php?ext=" . $ext;
				
				$extInsert = $conn->prepare("UPDATE Accounts SET ResetExt = ? WHERE Email = ?;");
				$extInsert->bindParam(1, $ext, PDO::PARAM_STR, 32);
				$extInsert->bindParam(2, $emailExists['Email'], PDO::PARAM_STR, 24);
				
				/* Database error - stop processing */
				if($extInsert->execute() === FALSE) {
					echo "<p class='ml-4 co-m'>Database cannot be written to. Try again in a few minutes. Sorry.</p>";
					return FALSE;
				/* Send email */
				} else {
					$subject = "Kentcpp Password Reset";
					$message = "<html>";
					$message .= "<head>";
					$message .= "<title>Kentcpp Password Reset</title>";
					$message .= "</head>";
					$message .= "<body>";
					$message .= "<p>Please use the link below to reset your password:</p>";
					$message .= "<a href='$URL'>$URL</a>";
					$message .= "<p>Please do not reply to this message as email is unmonitored.</p>";
					$message .= "</body>";
					$message .= "</html>";
					$headers = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8\r\n";
					$headers .= "From: <DoNotReply@kentcpp.com>\r\n";
					
					mail($emailExists['Email'], $subject, $message, $headers);
					echo "<p class='kentYellow ml-4'>Email has been sent and will arrive shortly.</p>";
					echo "<p class='kentYellow ml-4'>No further action is needed on this page.</p>";
					return TRUE;
				}
			}
			else {
				echo "<p class='kentYellow ml-4'>Email is not associated with an account.</p>";
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}
?>

<!DOCTYPE html>
<html>

<head>
	
	<?php
		$article = "Kpp Forgot PW";
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
								<h3 class="heading">Forgot Password</h3>
								<hr>
								<?php if(validateEmail() === FALSE) { ?>
									<p>Enter your email and a link will be sent to reset your password.</p>
								
									<form action="Forgot.php" method="POST" id="accountTxt">
										<div class="form-group">
											<label class="kentYellow mt-2" for="Email">Email</label>
											<input class="fieldSize" type="email" name="Email" id="Email" placeholder="@kent.edu" required>
											<br>
											<button type="submit" class="btn btnBlue mt-3">Submit</button>
										</div>
									</form>
								<?php } ?>
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