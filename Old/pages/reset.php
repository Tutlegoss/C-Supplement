


<?php
require_once('../inc/header.inc.php');
?>
<br><br><br>
<h2>
	<meta charset="UTF-8">
	<title>Password Reset </title>
	<link rel="stylesheet" href="main.css">
</h2>
<body>
	<div class="content">
		<div class="container d-flex h-100">
			<div class="row justify-content-center align-self-center mx-auto">
				<form class="login-form" action="" method="post">
					<h2 class="form-title">New password</h2>
					<hr>
					<!-- form validation messages -->
					
					<div class="form-group">
						<label class="kentYellow">New password&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
						<input type="password" name="npass" id="npass">
					</div>
					<div class="form-group">
						<label class="kentBlue">Confirm new password    </label>
						<input type="password" name="npassc">
					</div>
					<div class="form-group">
						<button type="submit" name="newpass" class="btn btnKent">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

<?php
function validatePassW($password) {
	   $pattern = "/^.{8,30}$/";
	   if ( preg_match($pattern, $password) ) {
		 return true;
	   }
	   return false;
	}

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("dbconnect2.php");
if(isset($_GET["s"])){
	$ss=$_GET["s"];
	$sql9="Select * from reset where hkey = '$ss'";
	$ress=mysqli_query($conn,$sql9);
	if (!$ress) {
			printf("Error: %s\n", mysqli_error($conn));
			exit();
		}
	$bool=0;
	while($row=mysqli_fetch_array($ress)){
		if($row["hkey"]==$ss){
			$bool=1;
				
		}
	}
	if($bool==0){
		header("Location: login.php?message=fail");
	}

}

if(isset($_POST["npass"])&&isset($_POST["npassc"])){
$new_pass=$_POST["npass"];
$new_passc=$_POST["npassc"];

if($new_pass==$new_passc){
	if(validatePassW($new_pass)===false){
		echo '<p class="red">Your Password is invalid. Must be 8 characters or more.</p>'; 
	}else{
	if(isset($_GET['s'])){
		$s=$_GET['s'];
		$sql="Select * from reset where hkey = '$s'";
		$result=mysqli_query($conn,$sql);
		if (!$result) {
			printf("Error: %s\n", mysqli_error($conn));
			exit();
		}
		$row=mysqli_fetch_array($result);
		$email=$row['Email'];
		
		$_hash=password_hash($new_pass,PASSWORD_BCRYPT);
		$sql2=$conn->prepare("Update Login Set Password = ? where Email='$email'");
		$sql2->bind_param("s",$_hash);
		$result1=$sql2->execute();
		if(false===$result1){
			printf("error:%s\n", mysqli_error($conn));
		}
		if(! $result1 ) {
			die('This account cannot be created. Please try again later.');
		}

		$sql3="Delete from reset where hkey='$s'";
		$result3=mysqli_query($conn,$sql3);
		if (!$result3) {
			printf("Error: %s\n", mysqli_error($conn));
			exit();
		}
		$sql4="Update Login Set FailCount = '0' , Locked = '0' where Email = '$email' ";
		$result4=mysqli_query($conn,$sql4);
		if(false===$result4){
			printf("error:%s\n", mysqli_error($conn));
		}
		if(! $result4 ) {
			die("There's an error.");
		}
		mysqli_close($conn);	
		header("Location: login.php?message=changed");
	}
	}
}else{echo "<p class='red'>Your passwords didn't match. Please try again</p>";}



}

require_once('../inc/footer.inc.php');
?>



</html>








