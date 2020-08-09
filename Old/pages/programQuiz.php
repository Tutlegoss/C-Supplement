<?php 
require_once("../pdoconfig.php");

if ($_GET["ID"]) {
	// Setup link to database
	require_once("dbconnect2.php");

	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, "SELECT Descr,Tips FROM ProgQuiz WHERE ID=?");
	mysqli_stmt_bind_param($stmt, "i", $_GET["ID"]);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	if (!$result) {
		die("Query failed: " .  mysqli_error($conn));
	}

	$row = mysqli_fetch_assoc($result);
}
else {
	require_once("dbconnect2.php");
	$query = "SELECT ID, Descr FROM ProgQuiz";
	$result = mysqli_query($conn, $query);

	if (!$result) {
		die("Query failed: " .  mysqli_error($conn));
	}

	require_once('../inc/header.inc.php');
	echo '
	<div class="content">
	 <div class="container">
	  <div class="row">
		<div class="col-12">
			<p><br>Select a programming quiz:</p>';
			while ($row = mysqli_fetch_assoc($result)) {
				$rowid = $row['ID'];
				$desc = $row['Descr'];
				echo "<p>$rowid - <a href='programQuiz.php?ID=$rowid'>$desc</a></p>";
			}
	echo '
		</div>
	  </div>
	 </div>
	</div>';
	require_once('../inc/footer.inc.php');
	return;
}

require_once('../inc/header.inc.php');
?>
<div class="content">
 <div class="container">
  <div class="row">
	<div class="col-12">
		<br><p><?php if ($row["Descr"]) { echo $row["Descr"]; } ?></p>
		<div id="textBox" style="background-color: Black" class="lang-clike"><code></code></div>
		<input type="button" id="send" value="Send"><br><br>
		<p id="result"></p>
		<button type="button" id="showTip">Request a Tip</button><br><br>
		<?php
		$tips = json_decode($row["Tips"], true);
		$i = 1;
		while ($tips[$i]) {
			$tip = $tips[$i];
			echo "<p id='tip$i' hidden>Tip $i: $tip</p>";
			$i++;
		}
		?>
	</div>
  </div>
 </div>
</div>
<script src="prism.js"></script>
<link href="../css/prism.css" rel="stylesheet" />
<script src="programQuiz.js"></script>
<script type="module">
	import {CodeJar} from '../node_modules/@medv/codejar/codejar.js';
	let jar = new CodeJar(document.querySelector('#textBox'), Prism.highlightElement);
	jar.updateCode("\n\n");
</script>
<?php require_once('../inc/footer.inc.php');?>
