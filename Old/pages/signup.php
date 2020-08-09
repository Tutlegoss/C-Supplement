<?php
	function validateEmail($email) {
	   $pattern = '/^[\-0-9a-zA-Z\.\+_]+@[\-0-9a-zA-Z\.\+_]+\.[a-zA-Z\.]{2,5}$/';
	   if ( preg_match($pattern, $email) ) {
		 return true;
	   }
	   return false;
	}

	function validatePassW($password) {
	   $pattern = "/^.{8,30}$/";
	   if ( preg_match($pattern, $password) ) {
		 return true;
	   }
	   return false;
	}


	
	/* session_start(); - This is now invoked in header.inc.php */
	
	function displayFormErrors()
	{
		require_once("dbconnect.php");
		if ( mysqli_connect_errno() ) {
    			printf("Connect failed: %s\n", mysqli_connect_error());
		}
		
		if(isset($_POST['create'])) {
			$_email = $_POST['_email'];
			$_username = $_POST['_username'];
			$_password = $_POST['_password'];
			$_type="Student";
			
			$_randomID=mt_rand();
			$sql1="select ID from Login";
			$results= mysqli_query($conn,$sql1);
			if (!$results) {
					printf("Error: %s\n", mysqli_error($conn));
				 exit();
			}
			$resultarr=array();
			while($row=mysqli_fetch_array($results)){
				$resultarr[]=$row;
			}
			$bool=0;
			
			while($bool==0){
				$bool=1;
				foreach($resultarr as $row){
					if($_randomID==$row){
						
						$_randomID=mt_rand();
						$bool=0;
					}
				}
			}
			
			$_type="student";
			$error="";
			if(validateEmail($_email)===false){
				$error='<p class="red">Your email is invalid. Please try again.</p>';
			}

			if(validatePassW($_password)===false){
				$error= $error . '<p class="red">Your Password is invalid. Must be 8 characters or more.</p>'; 
			}

			if($error!=""){
				echo '<p class="red">'.$error.'</p>';
			}else{

				$_hash=password_hash($_password,PASSWORD_BCRYPT);
	   
				$sql =$conn->prepare("INSERT INTO Login ".
				"(Username, Password,ID,Email, Type ) "."VALUES ".
				"(?,?,?,?,?)");
		
				$sql->bind_param("ssiss",$_username,$_hash,$_randomID,$_email,$_type);
				$retval=$sql->execute();
	 
				if(false===$retval){
					printf("error:%s\n", mysqli_error($conn));
				}

				if(! $retval ) {
					die('This account cannot be created. Please try again later.');
				}
				mysqli_close($conn);
				
				header("Location: https://www.kentcpp.com/pages/login.php");		
			}
		}
	}
	
	require_once('../inc/header.inc.php'); 
?><!--Form for user to sign up-->
	<div class="content">
		<div class="container d-flex h-100">
			<div class="row justify-content-center align-self-center mx-auto">
				<div class="col-9">
					<h3> Sign Up</h3>
					<hr>
					<p> Please enter your email address, your username, and password </p>
					<?php displayFormErrors(); ?>
				</div>
				<div class="col-12 col-md-8 col-lg-6">
					<form method = "post" id="forms">
						<table width = "400" border = "0" cellspacing = "1" cellpadding = "2">
							<tr>
							   <td width = "250" class="kentYellow">Username</td>
							   <td>
								  <input name = "_username" type = "text" id = "_username">
							   </td></tr>
						 
							<tr>
							   <td width = "200" class="kentBlue">Email Address</td>
							   <td>
								  <input name = "_email" type = "text" id = "_email" placeholder="@kent.edu">
							   </td></tr>
						 
							<tr>
							   <td width = "200">Password</td>
							   <td>
								  <input name = "_password" type = "password" id = "_password" placeholder="8-30 Chars">
							   </td></tr>

							<tr>
							   <td width = "200"> </td>
							   <td>
								  <input class="btn btnKent" name = "create" type = "submit" id = "create"  value = "Create account">
							   </td>
							</tr>		
						</table> 
					</form>
				</div>
			</div>
		</div>
	</div><?php require_once('../inc/footer.inc.php'); ?>
