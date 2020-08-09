<?php

if (isset($_POST["desc"])) {
    require_once('../pdoconfig.php');

	$title = htmlspecialchars($_POST["title"]);
	$desc = htmlspecialchars($_POST["desc"]);

	$i = 1;
	$input = Array();
	$output = Array();
	while (isset($_POST["output$i"])) {
		$input[$i] = htmlspecialchars($_POST["input$i"]);
		$output[$i] = htmlspecialchars($_POST["output$i"]);
		$i++;
	}

	$i = 1;
	$tips = Array();
	while (isset($_POST["tip$i"])) {
		$tips[$i] = nl2br(htmlspecialchars($_POST["tip$i"]));
		$i++;
	}

	$input = json_encode($input);
	$output = json_encode($output);
	$tips = json_encode($tips);

    require_once("dbconnect2.php");

	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, "INSERT INTO ProgQuiz VALUES (NULL,?,?,?,?,?)");
	mysqli_stmt_bind_param($stmt, "sssss", $title, $desc, $input, $output, $tips);
	$result = mysqli_stmt_execute($stmt);

	if (!$result) {
		die("Query failed: " .  mysqli_error($conn));
	}
}
 
require_once('../inc/header.inc.php');
?>
<div class="content">
 <div class="container">
  <div class="row">
   <div class="col-12">
	<form action="makePrgQuiz.php" method="post">
		<br>
		<?php 
		if ($result) {
			echo "<p>Quiz submitted successfully</p>";
		}
		?>
		<p>Quiz Title:</p>
		<input type="text" name"title">
		<p><br>Description:</p>
		<textarea name="desc" cols="70" rows="5"></textarea>
		<p><br>Enter each input to be received by the program's standard input (leave blank for no input).</p>
		<p>Then enter the correct output for the given input.</p>
		<div id="outputList">
			<label for="input1">Input 1:</label>
			<input type="text" id="input1" name="input1">
			<p><br>Output 1:</p>
			<textarea name="output1" cols="50" rows="3"></textarea>
		</div>
		<button type="button" id="addOutput">Add Output</button><br><br>
		<p>Add a tip to be shown each time the student misses.</p>
		<div id="tipList">
			<p>Tip 1:</p>	
			<textarea name="tip1" cols="50" rows="3"></textarea>
		</div>
		<button type="button" id="addTip">Add Tip</button><br>
		<br><input type="submit" id="submit" value="Submit Quiz">
	</form>
   </div>
  </div>
 </div>
</div>
<script src="makePrgQuiz.js"></script>
<?php require_once('../inc/footer.inc.php');?>
