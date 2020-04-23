<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["articleTitle"])) {
	class Image
	{
		public int $line;
		public string $filename;
		public string $caption;
		public string $alt;
	}

	function getImageJSON($sect, $body)
	{
		$img = array();
		$i = 0;
		$lastPos = 0;
		$lineCount = 0;
		while ($pos = strpos($body, "[img", $lastPos)) { // Search for position of each image marker
			$id = $body[$pos+4]; // Get id of image (NOTE: will only get id that's under 10... fix this)
			$lineCount += substr_count($body, "\n", $lastPos, $pos-$lastPos); // Find line the image is on
			$img[$i] = new Image();
			$img[$i]->line = $lineCount;
			$img[$i]->filename = $_POST[$sect . "ImgFile" . $id];
			$img[$i]->caption = $_POST[$sect . "ImgCap" . $id];
			$img[$i]->alt = $_POST[$sect . "ImgAlt" . $id];
			$i++;
			$lastPos = $pos+1;
		}
		return JSON_encode($img);
	}

	function removeImageMarkers($sect, $body)
	{
		$i = 1;
		while (isset($_POST[$sect . "ImgFile$i"])) {
			$body = str_replace("[img$i]", "", $body);
			$i++;
		}
		return $body;
	}

    require_once('../pdoconfig.php');

	$title = htmlspecialchars($_POST["articleTitle"]);
	$body = $_POST["articleBody"];
	$imgJSON = getImageJSON("article", $body);
	$body = nl2br(htmlspecialchars(removeImageMarkers("article", $body)));

    // Setup link to database
    $conn = mysqli_connect($servername, $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

	//echo "INSERT INTO Article VALUES (NULL,$title,$body,NULL,$imgJSON)\n";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, "INSERT INTO Article VALUES (NULL,?,?,NULL,?)");
	mysqli_stmt_bind_param($stmt, "sss", $title, $body, $imgJSON);
	$result = mysqli_stmt_execute($stmt);

	if (!$result) {
		die("Query failed: " .  mysqli_error($conn));
	}
	
	$query = "SELECT Max(TopicID) FROM Article";
	$result = mysqli_query($conn, $query);

	if (!$result) {
		die("Query failed: " .  mysqli_error($conn));
	}

	$articleID = mysqli_fetch_assoc($result)["Max(TopicID)"];

	$i = 1;
	while (isset($_POST["sub$i"."Body"])) {
		$title = htmlspecialchars($_POST["sub$i"."Title"]);
		$body = $_POST["sub$i"."Body"];
		$imgJSON = getImageJSON("sub$i", $body);
		$body = nl2br(htmlspecialchars(removeImageMarkers("sub$i", $body)));

		//echo "INSERT INTO Subtopics VALUES ($articleID,$i,$title,$code,$body,$imgJSON)\n";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt, "INSERT INTO Subtopics VALUES (?,?,?,?,?)");
		mysqli_stmt_bind_param($stmt, "iisss", $articleID, $i, $title, $body, $imgJSON);
		$result = mysqli_stmt_execute($stmt);

		if (!$result) {
			die("Query failed: " .  mysqli_error($conn));
		}

		$i++;
	}
}

require_once('../inc/header.inc.php');
?>
<div class="content">
 <div class="container">
  <div class="row">
   <div class="col-12">
	<form action="makeArticle.php" method="post">
		<br>
		<?php 
		if (isset($articleID)) {
			echo "<p>Article #$articleID submitted successfully</p>";
		}
		?>
		<div id="sections">
			<div id="article">
				<p>Article Title:</p>
				<input type="text" name="articleTitle"><br><br>
				<p>Article Body:</p>
				<textarea name="articleBody" cols="70" rows="5"></textarea><br>
			</div>
		</div>
		<div id="taskbar">
			<br><button type="button" id="addSub">Add SubSection</button>
			<button type="button" id="addImg">Add Image</button>
			<button type="button" id="addCode">Add Code Snippet</button>
			<button type="button" id="addVid">Add Video</button><br><br>
			<input type="submit" id="submit" value="Submit Article">
		</div>
	</form>
   </div>
  </div>
 </div>
</div>
<script src="makeArticle.js"></script>
<?php require_once('../inc/footer.inc.php');?>
