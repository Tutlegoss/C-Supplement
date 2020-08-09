<?php
require_once('../pdoconfig.php');
if(!isset($_SESSION)) 
			session_start();
// Must be logged in to chat
if (!isset($_SESSION["loggedin"])) {
	header("Location: https://www.kentcpp.com/pages/login.php");
}

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

if ($_SESSION["usertype"] == "Tutor") { // Query student for tutors
	$type = "Student";
}
else { // Query tutors for all other accounts
	$type = "Tutor";
}

$query = "SELECT ID,Username FROM Login WHERE Type='" . $type . "'";
$result = mysqli_query($conn, $query);

require_once('../inc/header.inc.php');
?>
	<div class="content">
		<div class="container mt-5">
			<div class="row justify-content-center mx-auto">
				<div class="col-12">
					<h3>Connect with a <?php echo $type ?></h3>
					<hr>
				</div>
			</div>
			<div class="row justify-content-center mx-auto">
				<div class="col-12">
				<?php
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<p><a id='chatLink' href=\"https://www.kentcpp.com/pages/chat.php?partnerid=" . $row["ID"]
					. "\">" . $row["Username"] . "</a></p>";
				}
				?>
				</div>
			</div>
		</div>
	</div>

<?php require_once('../inc/footer.inc.php'); ?>
