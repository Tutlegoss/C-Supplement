<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function compileErrorFeedback($compileError, $conn)
{
	$query = "SELECT * FROM CompileFeedback";
	$result = mysqli_query($conn, $query);

	while ($row = mysqli_fetch_assoc($result)) {
		if (strpos($compileError, $row["Target"])) {
			return $row["Feedback"];
		}
	}

	return NULL;
}

function outputFeedback($i, $output, $conn)
{
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, "SELECT Input,Output FROM ProgQuiz WHERE ID=?");
	mysqli_stmt_bind_param($stmt, "i", $_GET["ID"]);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$row = mysqli_fetch_assoc($result);
	$curInput = json_decode($row["Input"], true);
	$curOutput = json_decode($row["Output"], true);

	$i = 1;
	while ($curOutput[$i]) {
		if ($output == $correctOutput[$i]) {
			return "Correct.<br><br>Your output:<br>$output"; 
		}
		$i++;
	}

	return "Incorrect output. Try again.<br><br>Your output:<br>$output <br>Expected output:<br>$correctOutput[1]"; 
}
/*
// Write received program to cpp file and compile it
$file = fopen("input.cpp", "w") or die("Failed to open file");
$text = $_GET["text"];
fwrite($file, $text);
$compileError = shell_exec('PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/games:/usr/local/games:/snap/bin g++ input.cpp 2>&1');

// Clear file
$text = "\n";
fwrite($file, $text);
fclose($file);
*/
// Send code to compile server, store output
ob_start();
include("http://ec2-54-81-32-152.compute-1.amazonaws.com/compile.php?text=" . urlencode($_GET["text"]));
$compileError = ob_get_clean();

require_once("../pdoconfig.php");

// Setup link to database
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

// Check for compile error and try to return feedback to page
if ($compileError) {
	$feedback = compileErrorFeedback($compileError, $conn);
	echo "COMPILE ERROR:<br>$compileError<br><br>";
	echo $feedback ? "Feedback:<br>$feedback" : "No feedback found. If you're confused about this error, please discuss it with a tutor.";
}
// Check for correctness of output and return feedback
else {
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, "SELECT Input,Output FROM ProgQuiz WHERE ID=?");
	mysqli_stmt_bind_param($stmt, "i", $_GET["ID"]);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$row = mysqli_fetch_assoc($result);
	$curInput = json_decode($row["Input"], true);
	$curOutput = json_decode($row["Output"], true);

	$i = 1;
	$finalOutput = "";
	while (isset($curOutput[$i])) {
		// Send exec command to compile server to run file and get output
		$input = $curInput[$i];
		$exec = $input ? " echo '$input' | ./a.out 2>&1" : "./a.out 2>&1";
		ob_start();
		include("http://ec2-54-81-32-152.compute-1.amazonaws.com/exec.php?text=" . urlencode($exec));
		$output = ob_get_clean();

		if ($output == $curOutput[$i]) {
			$finalOutput = $finalOutput . "Input: $input<br>Your output: $output<br>"; 
		}
		else {
			die("Incorrect output. Try again.<br><br>Input: $input<br>Your output: $output<br>Expected output: " . $curOutput[$i]); 
		}

		$i++;
	}

	echo "Correct!<br><br>";
	echo $finalOutput;
}
?> 
