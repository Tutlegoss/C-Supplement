<?php
	include 'authLogin.php';

	if (isset($_POST["username"]) && isset($_POST["password"])) {
		$attempt = authLogin($_POST["username"], $_POST["password"]);

		switch ($attempt) {
		case -1: // Bad username 
			{
			$errorMsg = "<br>Invalid username. Try again.<br>";
			break;
			}
		case 0: // Bad password
			{
			
			$user=$_POST["username"];
			require("dbconnect2.php");

	if(!$conn){
		die('Could not connect: ' . mysqli_error($conn));
	}
			$sql=$conn->prepare("Update Login Set FailCount = FailCount +1 where Username= ?");
			$sql->bind_param("s",$user);
			$result=$sql->execute();
			if(false===$result){
				printf("error:%s\n", mysqli_error($conn));
			}
			//$sql0=$conn->prepare("Select * from Login where Username = ?");
			if(!$sql0=$conn->prepare("SELECT * FROM Login WHERE Username = ?")){
				printf("Error: %s.\n", $sql1->error);
				die ('failure');	
			}
			$sql0->bind_param("s",$user);
			$sql0->execute();
			$result1=$sql0->get_result();
			if(false===$result1){
				printf("error:%s\n", mysqli_error($conn));
			}
			if(! $result1) {
				die('Theres an error');
			}
			$row=$result1->fetch_assoc();
			if($row["FailCount"]>=20){
				$sql2=$conn->prepare("Update Login Set Locked = '1' where Username = ? ");
				$sql2->bind_param("s",$user);				
				$check=$sql2->execute();
				if(false===$check){
					printf("error:%s\n", mysqli_error($conn));
			}
			}	
			
			$errorMsg = "<br>Wrong password. Try again.<br>";
			break;
			}
		default: // Match, query row was returned
			{
			
			$user=$_POST["username"];
			require_once("dbconnect2.php");
			
			if ( mysqli_connect_errno() ) {
    				printf("Connect failed: %s\n", mysqli_connect_error());
			}
			if(!$sql2="SELECT * FROM Login"){
				die ('1failure');	
			}
			if(!$sql1=$conn->prepare("SELECT * FROM Login WHERE Username = ?")){
				printf("Error: %s.\n", $sql1->error);
				die ('failure');	
			}	
			$sql1->bind_param("s",$user);
			$sql1->execute();
			$result2=$sql1->get_result();
		
			if(false===$result2){
				printf("error:%s\n", mysqli_error($conn));
			}
			if(! $result2) {
				die('Theres an error');
			}
			$row=$result2->fetch_assoc();
			if($row['Locked']==1){
				$errorMsg =" <br>This account is locked. Please reset your password to unlock your account.<br>";
				break;
			}else{
				$sql3=$conn->prepare("Update Login Set FailCount = '0' where Username = ? ");
				$sql3->bind_param("s",$user);				
				$check=$sql3->execute();
				if(false===$check){
					printf("error:%s\n", mysqli_error($conn));
				}
			}	
			
				
			session_start();
			$_SESSION["loggedin"] = true;
			$_SESSION["username"] = $_POST["username"];
			$_SESSION["userid"] = $attempt["ID"];
			$_SESSION["usertype"] = $attempt["Type"];
			header("Location: https://www.kentcpp.com"); // Redirect to main page
			break;
			}
		}
	}
	require_once('../inc/header.inc.php');
?>
	<div class="content">
		<div class="container d-flex h-100">
			<div class="row justify-content-center align-self-center mx-auto">
				<div class="col-9">
		<?php if(isset($_GET['message'])){
		if($_GET['message']=="sent"){
			echo "<h5>Check your email for a link to reset your password.</h5>";
			}else{
			if($_GET['message']=="fail"){
				echo "<h5>This link has expired. Please try again.</h5>";
			}else{
			if($_GET['message']=="changed"){
				echo "<h5>Your password was successfully changed.</h5>";
			}
			

		}}}?>
					<h3>Sign In</h3>
					<hr>
				</div>
				<form id="forms" action="login.php" method="post">
					<label class="kentYellow" for="username">Username</label>
					<!-- Keep username if just bad password -->
					<input type="text" name="username" 
					<?php if((isset($_POST["username"]))&& (isset($attempt))){if($attempt == 0) echo "value=\"" . $_POST["username"] . "\"";} ?> required><br>
					<label class="kentBlue mt-2" for="password">Password</label>
					<input type="password" name="password" required><br>
					<input class="btn btnKent mt-2" id="btnMv" type="submit" value="Sign In">
					<br><br>
					<a href="resetpassword.php" class="kentYellow">Forgot Password?</a>
					| <a href="./signup.php" class="kentBlue">Sign Up</a>
				</form>
				
				<?php if (isset($errorMsg)) echo $errorMsg; // Error message from attempt ?>
			</div>
		</div>
	</div>
	
<?php require_once('../inc/footer.inc.php'); ?>
