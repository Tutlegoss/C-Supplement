<?php
require_once('../pdoconfig.php');

// Setup link to database
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
// Insert message
session_start();
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, "INSERT INTO IM (SenderID, ReceiverID, IMText) VALUES (?,?,?)");
mysqli_stmt_bind_param($stmt, "iis", $_SESSION["userid"], $_SESSION["partnerid"], $_GET["text"]);
mysqli_stmt_execute($stmt);
// Find sent message
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, "SELECT MAX(IMNum) FROM IM WHERE SenderID=?");
mysqli_stmt_bind_param($stmt, "i", $_SESSION["userid"]);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$lastMsgNum = $row["MAX(IMNum)"];
// Return sent message
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, "SELECT IMText FROM IM WHERE IMNum=?");
mysqli_stmt_bind_param($stmt, "i", $lastMsgNum);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$text = $_GET["text"];
if ($text != $_GET["text"]) {
	$text = "Failed to send message";
}
echo $_SESSION["username"] . "<br>" . $text;
/*
$fileName = $_SESSION["userid"] . ':' . $_GET["partnerid"];
$file = fopen($fileName);
$fwrite($file, $_GET["text"] . '\n', 'a');
$fclose($file);
 */
?>