<?php

if (isset($_POST["target"])) {
    require_once('../pdoconfig.php');

	$target = htmlspecialchars($_POST["target"]);
	$target = nl2br($target);
	$feedback = nl2br(htmlspecialchars($_POST["feedback"]));

    // Setup link to database
    $conn = mysqli_connect($servername, $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, "INSERT INTO CompileFeedback VALUES (NULL,?,?)");
	mysqli_stmt_bind_param($stmt, "ss", $target, $feedback);
	$result = mysqli_stmt_execute($stmt);

	if (!$result) {
		die("Query failed: " .  mysqli_error($conn));
	}
	
	$submitMsg = "Feedback message submitted.";
}
 
require_once('../inc/header.inc.php');
?>
<div class="content">
 <div class="container d-flex h-100">
  <div class="row justify-content-center align-self-center mx-auto">
   <div class="col-12">
	<?php if (isset($submitMsg)) { echo "<p>$submitMsg</p>"; } ?>
	<form action="addCompileFeedback.php" method="post">
		<p class="kentYellow">Enter the string to identify the compile error:</p>
		<textarea name="target" cols="70" rows="5"></textarea>
		<p class="kentBlue mt-3">Enter the feedback message to be received by the student:</p>
		<textarea name="feedback" cols="70" rows="5"></textarea>
		<br><input class="btn btnKent" type="submit" value="Submit">
	</form>
   </div>
  </div>
 </div>
</div>
<?php require_once('../inc/footer.inc.php');?>
