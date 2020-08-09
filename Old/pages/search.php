
<!-- Prototype for search page-->

<!DOCTYPE html>

<?php


require_once('../inc/header.inc.php'); 
require_once("dbconnect.php");
$search="";
echo "<div class='content'>";
echo "<h2 class='mt-5' style='text-align: center'>Search Results</h2><hr>";
echo "<div class='container  h-100' style='overflow-y:auto'>";
echo '<div class="row justify-content-center align-self-center mx-auto">';


if(isset($_GET['search'])){
	$received=0;
$s="%{$_GET['search']}%";

$sql=$conn->prepare("Select * from Article where TopicName LIKE ? OR Text LIKE ?");
$sql->bind_param("ss",$s,$s);
$sql->execute();
$results=$sql->get_result();
if(!$results){
	printf("Error1: %s\n",mysqli_error($conn));
	exit();
}


	while($row=mysqli_fetch_array($results)){
		$received=1;
		$x="";
		$x=$row['TopicName'];
		$r=$row['TopicID'];
		echo "<p align=left><a href='article2.php?ID=$r' class='kentBlue' style='text-decoration: underline; font-size: 1.4rem;'>".$x."<br></a></p>";
		$str=$row['Text'];
		echo "<p class='kentYellow'>".substr($str,0,500)."...<br></p>";
		
	}
	$sql=$conn->prepare("Select * from Subtopics where SubName LIKE ? OR Text LIKE ?");
	$sql->bind_param("ss",$s,$s);
	$sql->execute();
	$results=$sql->get_result();
	if(!$results){
		printf("Error1: %s\n",mysqli_error($conn));
		exit();
	}
	
		while($row=mysqli_fetch_array($results)){
			$received=1;
			$x="";
			$x=$row['SubName'];
			$r=$row['TopicID'];
			echo "<p align=left><a href='article2.php?ID=$r' class='kentBlue' style='text-decoration: underline; font-size: 1.4rem;'>".$x."<br></a></p>";
			$str=$row['Text'];
			echo "<p class='kentYellow'>".substr($str,0,500)."...<br></p>";
			
		}
if($received==0){
	echo "<p>There were no results. Please try again.</p>";
}
mysqli_close($conn);

}else{header("Location: https://www.kentcpp.com");}
echo "</div></div></div>";
require_once('../inc/footer.inc.php'); 


?>

	
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
