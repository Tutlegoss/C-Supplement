<?php
require_once("../pdoconfig.php");

// Setup link to database
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
}

session_start();
$_SESSION["partnerid"] = $_GET["partnerid"];

// Query chat partner's username
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, "SELECT Username FROM Login WHERE ID=?");
mysqli_stmt_bind_param($stmt, "i", $_GET["partnerid"]);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$_SESSION["partnername"] = $row["Username"];

// Query message history
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, "SELECT * FROM IM WHERE SenderID=? AND ReceiverID=? OR ReceiverID=? AND SenderID=?");
mysqli_stmt_bind_param($stmt, "iiii", $_SESSION["userid"], $_GET["partnerid"], $_SESSION["userid"], $_GET["partnerid"]);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

require_once('../inc/header.inc.php');
?>
<head>
	<meta charset="utf-8">
	<script src="chat.js"></script>
</head>
<div class="content">
 <div class="container">
  <div class="row">
	<div class="col-12" id="msgList">
	<p></p>
		<?php
		while($row = mysqli_fetch_assoc($result)) {
			if ($row["SenderID"] == $_SESSION["userid"]) {
				$displayName = $_SESSION["username"];
			}
			else {
				$displayName = $_SESSION["partnername"];
			}
			echo "<p>" . $displayName . "<br>" . $row["IMText"] . "</p>";
			$_SESSION["lastmsg"] = $row["IMNum"];
		}
		?>
	</div>
	<div class="col-12" id="msgInput">
		<textarea id="msgBox" cols="70" rows="2"></textarea>
		<input type="button" id="send" value="Send">
	</div>
  </div>
 </div>
</div>
<?php require_once('../inc/footer.inc.php');?>
