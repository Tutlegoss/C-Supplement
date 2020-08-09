


<?php
require_once('../inc/header.inc.php'); 
require_once("dbconnect.php");

if(isset($_POST['reset'])){
	$_email=$_POST['email'];
	
	$sql =$conn->prepare("select * from Login where Email=?");
		$sql->bind_param("s",$_email);
		$retval=$sql->execute();
	if (false===$retval) {
		printf("Error1: %s\n", mysqli_error($conn));
		exit();
	}
	if(! $retval ) {
		die('Theres an error');
	}
	$row=$sql->get_result();
	$em=$row->fetch_assoc();
	if($em['Email']==null){
	echo "This account doesn't exist. Please try again.";
	}else {
		$sel=bin2hex(random_bytes(8));
		$token=random_bytes(40);
		$url=sprintf('%rKentcpp.com/pages/reset.php?s=%s','ABS_URL',$sel,bin2hex($token));
		$eM=$em['Email'];
		$sql4="Select * from reset";
		$res=mysqli_query($conn,$sql4);
		if(!$res){
			printf("Error2: %s\n", mysqli_error($conn));
				exit();
		}		
		$found="0";
		while($row=mysqli_fetch_array($res)){
			if($row['Email']===$eM){
				$found=1;
			}
		}
		
		if($found===1){
			
			$sql1="Delete from reset where Email = '$eM'";
			$results5= mysqli_query($conn,$sql1);
			if(!$results5){
				printf("Error2: %s\n", mysqli_error($conn));
				exit();
			}
		}
		$hashed=hash('sha256',$token);
		
		$sql2 =$conn->prepare("Insert into reset". "(Email,hkey,token)"."Values"."(?,?,?)");
		$sql2->bind_param("sss",$eM,$sel,$hashed);
		$results4= $sql2->execute();
		if(false===$results4){
			printf("Error4: %s\n", mysqli_error($conn));
			exit();
		}
		if(!$results4){die('Your request cannot be sent at this time. Please try again later.');}


		$send=$em['Email'];
		$subj='Password reset link';
		$mess='<p>Below is a link to reset your password</p>';
		$mess.=sprintf('<a href="%href="%s">%s</a></p>',"",$url,$url);
		$head="From: donotreply@kentcpp.com\r\n";
		$head.="Reply-To: donotreply.KentCpp.com\r\n";
		$head.= "Content-Type: text/html\r\n";
		$sent = mail($send,$subj,$mess,$head);
		header("Location: login.php?message=sent");
	}
}

?>
<body>
<br><br><br>
<div class="container d-flex h-100">
	<div class="row">
	<div class="col-12">
	<h1>Reset Password</h1>
<form method="post">
	<table width = "500" border = "0" cellspacing = "1" cellpadding = "1">
	<tr><td >Input your email</td><td>
	<input name = "email" type = "text" id = "email">
	<td><input name="reset" type = "submit" id="reset" value=" reset password"></td></td></tr></form>
</div></div></div>
</body>
</html>

<?php// require_once('../inc/footer.inc.php'); 
?>
