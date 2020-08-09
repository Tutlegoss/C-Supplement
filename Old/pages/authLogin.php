<?php
/* Authenticates login given a username and password
 * Return values: bad username = -1, bad password = 0, match = user ID
 * NOTE: args must start in caps or they will overlap with variables from pdoconfig
 */
function authLogin($Username, $Password)
{
	require_once('../pdoconfig.php');

	// Setup link to database
	$conn = mysqli_connect($servername, $username, $password, $database);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	// Query username
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, "SELECT ID,Password,Type FROM Login WHERE Username=?");
	mysqli_stmt_bind_param($stmt, "s", $Username);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	// Should only have one match for unique username
	if (mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_assoc($result);
		$hash = $row["Password"];
		if (password_verify($Password, $hash)) {
			return $row; // Match
		}
		return 0; // Bad password
	}

	return -1; // Bad username
}
?>
