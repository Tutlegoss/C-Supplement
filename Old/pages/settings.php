
<script>
	function buttonassign(vari){
		//form.elements["click"].value=vari;
		document.getElementById('assign').value=vari;
		return false;


	}



</script>
<?php require_once('../inc/header.inc.php'); ?>
	<div class="content">
		<div class="container d-flex h-100">
			<div class="row justify-content-center align-self-center mx-auto">
			     <div class="col">
				<?php
				//Checks if user is signned in
				if(isset($_SESSION["loggedin"])==true){
				echo "<h2 align=center class='kentBlue'><br>Welcome  ".$_SESSION["username"] ."! <br></h2>"; 
					echo "<body>";
					//if user is an administrator print list and allow reassignment
					if(isset($_SESSION["usertype"])){
						if($_SESSION["usertype"] != "Student")
							echo '<h4 class="mt-3 text-center">
						              <a href="./makeArticle.php" class="kentYellow"  style="text-decoration: underline">Make Article</a></h4>';
						if($_SESSION["usertype"]=="Admin"){
						
						echo "<h4 align=center class='mt-5'>Reassign user below</h4>";
						require_once("dbconnect.php");
						if ( mysqli_connect_errno() ) {
						printf("Connect failed: %s\n", mysqli_connect_error());
						}

						//handles reassignment
						if(isset($_POST['submit'])){
							if(isset($_POST['assign'])){
							$user=$_POST['assign'];

							$sql1=$conn->prepare("Select * from Login where username = ?");
							$sql1->bind_param("s",$user);
							$sql1->execute();
							$result=$sql1->get_result();
							if(false===$result){
								printf("Error1: %s\n", mysqli_error($conn));
								die("Cannot reassign user");
							}
							$type="";
							$row=$result->fetch_assoc();
							if($row['Type']=="Tutor"){
								$type="Student";
							}else{$type="Tutor";}
							$id=$row['ID'];
							$sql2="Update Login Set Type= '$type' Where ID=$id";
							$res=mysqli_query($conn,$sql2);
							if(!$res){
								printf("Error2 :%s\n",mysqli_error($conn));
								exit();
							}
						}
					}
						//prints user list
						$sql="Select * from Login";
						$results=mysqli_query($conn,$sql);
						if(!$results){
							printf("Error:3 %s\n", mysqli_error($conn));
							exit();
						}
						$resultarr=array();
						$c_arr=array();
						$count=0;
						while($row=mysqli_fetch_array($results)){
							$resultarr[]=$row;
							$c_arr[]=$count;
							$count++;
						}
						//form to reassign user
						echo "<form class='text-center mt-3' align='center' action='' method='post'>
								<input type='text' placeholder='username' name='assign' id='assign'>
								<input class='btn btnKent' type='submit' id='submit' name='submit' value='Reassign user'>
								</form>";
						//list of users
						echo "<br><br><br><h5 align=center>List of users</h5>";
						echo "<div class='row' align=center><table align=justify>";
						$list=array();
						$count=0;
						foreach($resultarr as $row){
							$assign="";
							if($row['Type']=="Student"){$assign="Assign as Tutor";}else {$assign="Assign as Student";}
							if($row['Type']!="Admin"){
								$list[]="<tr><th align=left style='padding: 36px;'>".$row['Username']."</th>&nbsp&nbsp&nbsp&nbsp<th class='kentBlue' align=center style='padding: 36px;'>". $row['Email']."</th>   <th class='kentYellow' align =center style='padding: 36px;'>".$row['Type']."</th><th></tr><br>";
							$count++;
							}
							
						}
						$count=0;
						foreach($list as $line){
							echo $line;
							$count++;
						}
						echo "</table></div>";
					}
				}
				}else{header("index.php");}
?>              </div>
			</div>
		</div>
	</div>
<?php require_once('../inc/footer.inc.php'); ?>