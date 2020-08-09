<?php
	function retryLink()
	{
		echo "<p class='ml-4 kentYellow'>URL is malformed. Please click the link from your email again.</p>";
		echo "<p class='ml-4 kentYellow'>If this message appears again, please request a new email here:</p>";
		echo "<a class='ml-4' href='./Forgot.php'>Forgot Password</a>";	
	}

	/* 
		Return FALSE to keep form (password wasn't successfully reset / minor error)
	    Return TRUE  to erase form (password reset successful / major error)
		TODO: Maybe re-evaluate the return values as the logic is awkward
	*/
	function resetPassword()
	{
		if($_POST) {
			global $conn;
			
			/* URL contains ext argument */
			if(isset($_POST['ext']) && !empty($_POST['ext'])) {
				/* Compare password fields */
				if($_POST['Password'] === $_POST['PasswordVerify']) {
					/* Verify ext matches user's ID */
					$extMatch = $conn->prepare("SELECT * FROM ForgotPass WHERE ResetExt = ?;");
					$extMatch->bindParam(1, $_POST['ext'], PDO::PARAM_STR, 32);
					$extMatch->execute();
					$extMatch = $extMatch->fetch(PDO::FETCH_ASSOC);
					
					if($extMatch) {
						/* Update user account */
						$argonHash = password_hash($_POST['Password'], PASSWORD_ARGON2ID);
						
						$updateAccount = $conn->prepare("UPDATE Accounts SET Password = ? WHERE ID = ?;");
						$updateAccount->bindParam(1, $argonHash, PDO::PARAM_STR, 128);
						$updateAccount->bindParam(2, $extMatch['ID'], PDO::PARAM_STR, 128);
						if($updateAccount->execute()) {
							/* Delete ForgotPass record */
							$delExt = $conn->prepare("DELETE FROM ForgotPass WHERE ResetExt = ?;");
							$delExt->bindParam(1, $_POST['ext'], PDO::PARAM_STR, 32);
							if($delExt->execute()) {
								echo "<p class='ml-4 kentYellow'>Password updated!</p>";
								echo "<a class='ml-4' href='./Login.php'>Login</a>";
								return TRUE;
							}
							/* Password updated but record not deleted from ForgotPass - Delete manually */
							else {
								error_log("$extMatch[ID] changed password but ForgotPass record not deleted!", 1, "Lmarchan@kent.edu"); 
								echo "<p class='ml-4 kentBlue'>Password updated! Redirecting to login...</p>";
								echo "<a href='./Login.php'>Login</a>";
								return TRUE;
							}
						}
						/* Could not update password */
						else {
							retryLink();
							return TRUE;
						}
					}
					/* No ext match */
					else {
						retryLink();
						return TRUE;
					}
				}
				/* Passwords do not match */
				else {
					echo "<p class='ml-4 kentYellow'>Passwords do not match. Please retry.</p>";
					return FALSE;
				}
			}
			/* Malformed URL */
			else {
				retryLink();
				return TRUE;
			}
		} 
		else {
			return FALSE;
		}
	}
?>

<!DOCTYPE html>
<html>

<head>
	
	<?php
		$article = "Kpp Reset PW";
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
							<div class="col-12" id="accountTxt">
								<h3 class="heading">Reset Password</h3>
								<hr>
								<?php if(resetPassword() === FALSE) { ?>
									<p>Enter your new password, please.</p>
								
									<form action="ResetPass.php" method="POST">
										<div class="form-group">
											<table>
												<tr>
													<td>
														<label class="mt-2 kentYellow" for="Password">New Password</label>
													</td>
													<td class="pl-4">
														<input class="fieldSize" type="password" name="Password" id="Password" pattern=".{8,30}" placeholder="8-30 Chars" required>
													</td>
												</tr>
												<tr>
													<td>
														<label class="mt-2 kentBlue" for="PasswordVerify">Re-Enter Password</label>
													</td>
													<td class="pl-4">
														<input class="fieldSize" type="password" name="PasswordVerify" id="PasswordVerify" pattern=".{8,30}" required>
													</td>
												</tr>
											</table>
											<input type="hidden" id="ext" name="ext" value="<?php 
																						if(isset($_GET['ext']))
																							echo $_GET['ext'];
																						else 
																							echo ""; ?>">
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