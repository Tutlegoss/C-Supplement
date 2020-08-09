<?php
	require_once('../inc/header.inc.php');

if(empty($_SESSION) || ($_SESSION['usertype'] != "Tutor" && $_SESSION['usertype'] != "Admin")) {
	echo "<p style='margin-top: 70px;'>You cannot access this page. Redirecting to the login page...</p>";
    header('Refresh: 3; URL=http://192.168.86.41/pages/login.php');
}
else {
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	if (isset($_POST["articleTitle"])) {
		class Image
		{
			public $line;
			public $filename;
			public $caption;
			public $alt;
		}

		class CodeSnippet
		{
			public $line;
			public $code;
		}

		function getImageJSON($sect, $body)
		{
			$img = array();
			$i = 0;
			$lastPos = 0;
			$lineCount = 0;
			while ($pos = strpos($body, "[img", $lastPos)) { // Search for position of each image token
				$id = $body[$pos+4]; // Get id of image TODO: (NOTE: will only get id that's under 10... fix this)
				$lineCount += substr_count($body, "\n", $lastPos, $pos-$lastPos); // Find line the token is on
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

		function getCodeJSON($sect, $body)
		{
			$code = array();
			$i = 0;
			$lastPos = 0;
			$lineCount = 0;
			while ($pos = strpos($body, "[code", $lastPos)) { // Search for position of each code token
				$id = $body[$pos+5]; // Get id of image (NOTE: will only get id that's under 10... fix this)
				$lineCount += substr_count($body, "\n", $lastPos, $pos-$lastPos); // Find line the token is on
				$code[$i] = new CodeSnippet();
				$code[$i]->line = $lineCount;
				$code[$i]->text = $_POST[$sect . "CodeText" . $id];
				$i++;
				$lastPos = $pos+1;
			}
			return JSON_encode($code);
		}

		function removeImageTokens($sect, $body)
		{
			$i = 1;
			while (isset($_POST[$sect . "ImgFile$i"])) {
				$body = str_replace("[img$i]", "", $body);
				$i++;
			}
			return $body;
		}

		function removeCodeTokens($sect, $body)
		{
			$i = 1;
			while (isset($_POST[$sect . "CodeText$i"])) {
				$body = str_replace("[code$i]", "", $body);
				$i++;
			}
			return $body;
		}

		require_once('../pdoconfig.php');

		$title = htmlspecialchars($_POST["articleTitle"]);
		$body = $_POST["articleBody"];
		$video = $_POST["articleVideo"];
		$imgJSON = getImageJSON("article", $body);
		$codeJSON = getCodeJSON("article", $body);
		$body = nl2br(htmlspecialchars(removeCodeTokens("article", removeImageTokens("article", $body))));

		// Setup link to database
		$conn = mysqli_connect($servername, $username, $password, $database);
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		//echo "INSERT INTO Article VALUES (NULL,$title,$body,NULL,$imgJSON)\n";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt, "INSERT INTO Article VALUES (NULL,?,?,?,?,?)");
		mysqli_stmt_bind_param($stmt, "sssss", $title, $body, $video, $imgJSON, $codeJSON);
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
			$codeJSON = getCodeJSON("sub$i", $body);
			$body = nl2br(htmlspecialchars(removeCodeTokens("sub$i", removeImageTokens("sub$i", $body))));

			//echo "INSERT INTO Subtopics VALUES ($articleID,$i,$title,$code,$body,$imgJSON)\n";
			$stmt = mysqli_stmt_init($conn);
			mysqli_stmt_prepare($stmt, "INSERT INTO Subtopics VALUES (?,?,?,?,?,?)");
			mysqli_stmt_bind_param($stmt, "iissss", $articleID, $i, $title, $body, $imgJSON, $codeJSON);
			$result = mysqli_stmt_execute($stmt);

			if (!$result) {
				die("Query failed: " .  mysqli_error($conn));
			}

			$i++;
		}
	}


	?>
	<div class="content">
	 <div class="container d-flex h-100">
	  <div class="row justify-content-center align-self-center mx-auto">
	   <div class="col-10">
		<form action="makeArticle.php" method="post">
			<br>
			<?php 
			if (isset($articleID)) {
				echo "<p>Article #$articleID submitted successfully</p>";
			}
			?>
			<div id="sections">
				<div id="article">
					<p>Article Title</p>
					<input type="text" name="articleTitle"><br><br>
					<p class="kentYellow">Article Body</p>
					<textarea name="articleBody" class="body" cols="70" rows="5"></textarea><br><br>
					<label for="articleVideo" class="kentBlue">Video Link:</label>
					<input type="text" name="articleVideo"><br>
				</div>
			</div>
			<div id="articleTaskbar">
				<br><button class="btn btnKent" type="button" id="addSub">Add Subtopic</button>
				<button class="btn btnKent" type="button" id="addImg">Add Image</button>
				<button class="btn btnKent" type="button" id="addCode">Add Code Snippet</button><br><br>
			</div>
			<input class="btn btn-success mb-5" type="submit" id="submit" value="Submit Article">
		</form>
	   </div>
	  </div>
	 </div>
	</div>
	<script src="makeArticle.js"></script>
	<?php require_once('../inc/footer.inc.php');
}?>
