<?php
require_once('../pdoconfig.php');

// Setup link to database
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

// Find last message
session_start();
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, "SELECT MAX(IMNum) FROM IM WHERE SenderID=? AND ReceiverID=?");
mysqli_stmt_bind_param($stmt, "ii", $_SESSION["partnerid"], $_SESSION["userid"]);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$lastMsgNum = $row["MAX(IMNum)"];

// Check if last message is up to date, skip query if so
if ($lastMsgNum <= $_SESSION["lastmsg"]) {
	goto finish;
}

// Query last message
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, "SELECT IMText,Time FROM IM WHERE ReceiverID=? && SenderID=? && IMNum=?");
mysqli_stmt_bind_param($stmt, "iii", $_SESSION["userid"], $_SESSION["partnerid"], $lastMsgNum);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$data = "<div class='rcvdMsgHead'>" . $_SESSION["partnername"] . " | " . $row["Time"] 
	. "</div><div class='rcvdMsgText'>" . $row["IMText"] . "</div>";	
$_SESSION["lastmsg"] = $lastMsgNum; // Disparity between last message in session and database so update it

// Send event data (if any)
finish:
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
echo "retry: 500\n";
if (isset($data)) {
	$data = str_replace(array("\n", "\r"), '', $data);
	$handle = fopen("test.txt", "w");
	fwrite($handle, $data);
	fclose($handle);
	echo "data: {$data}\n\n";
}
ob_end_flush();
flush();
sleep(0.5);
?>
