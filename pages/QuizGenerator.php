<?php 
/* Merge checkBackticks and comment2Code into one file to be shared with articles */
    session_start();
    
    if(!($_SESSION) || empty($_SESSION) || ($_SESSION['Privilege'] == "Student")) 
        header("Location: ../index.php");
    
/* Insert comment - Should this be a function? */
	if(isset($_GET['ID']) && $_GET['ID'] == $headerData['ArticleID'] && 
	         $_SESSION['LoggedIn'] == TRUE && isset($_POST['comment'])) 
    {
		$comment = addslashes($_POST['comment']);
		$timestamp = date("Y-m-d H:i:s");
		$parentNum = ($_POST['parentNum'] == "NULL") ? NULL : $_POST['parentNum'];

		/* Get next EntryNum or do nothing upon failure */
		$entryNumCount = $conn->prepare("SELECT MAX(EntryNum) AS Max FROM Comments WHERE ArticleID = ?;");
		$entryNumCount->bindParam(1, $headerData['ArticleID'], PDO::PARAM_STR, 16);
		$entryNumCount->execute();
		$entryNumCount = $entryNumCount->fetch(PDO::FETCH_ASSOC);
		if($entryNumCount) 
        {
			$entryNum = $entryNumCount['Max'] + 1;

			/* Insert into database */
			$commentInsert = $conn->prepare("INSERT INTO Comments VALUES (?, ?, ?, ?, ?, ?);");
			$commentInsert->execute(array($_SESSION['ID'], $headerData['ArticleID'], $entryNum,
										  $parentNum, $comment, $timestamp)); 
		}
	}
    
/* Check to ensure there are an even emount of opening and closing backticks (multiples of 2) */
	function checkBackticks($comment)
	{
		$numOfBackticks = substr_count($comment, "```");
		if($numOfBackticks % 2 === 0 && $numOfBackticks !== 0)
			return TRUE;
		else
			return FALSE;
	}
	
	function comment2Code($comment)
	{
		/* Sanitize and trim comment */
		$comment = trim($comment);
		$comment = stripslashes($comment);
		$comment = htmlspecialchars($comment, ENT_QUOTES);
		
		/* Check to see if text exists before first ``` */
		if(strpos($comment, "```") !== 0)
			$comment = "<p class='text-white'>" . $comment;
			
		/* Check for opening ``` and closing ``` */
		if(checkBackticks($comment)) 
        {
			/* Comment/Code wrapper */
			$exCodeStart = "<div class='exBoxComment mb-3 mt-2'>"
						  ."<figure class='code'>"
						  ."<pre><table class='table borderless my-auto'>"
						  ."<tr><td><pre class='co-g'>";
			$exCodeEnd   = "</pre></td></tr></table></pre></figure></div>";
			
			/* Insert </p> before <div> */
			/* Encapsulate code with appropriate HTML tags in place of ``` */
			$openOrClose = 0;
			while(($pos = strpos($comment, "```")) !== FALSE) 
            {
				if($openOrClose % 2 === 0) 
                {
					if($pos !== 0)
						$comment = substr_replace($comment, "</p>", $pos, 0);
					$comment = substr_replace($comment, $exCodeStart, strpos($comment, "```"), 3);
				}
				else 
					$comment = substr_replace($comment, $exCodeEnd, strpos($comment, "```"), 3);
				++$openOrClose;
			}
			
			/* Indicate how many code sections there are (will be a multiple of 2) */
			$openOrClose = $openOrClose / 2.0;
			
			/* Insert <p> after </div> */
			$pos = 0;
			while($openOrClose-- > 0.0) 
            {
				$pos = strpos($comment, "</div>", $pos+1);
				$comment = substr_replace($comment, "<p class='text-white'>", $pos + 6, 0);
			}
			$comment .= "</p>";
			
			/* Remove trailing <p> </p> if no text after last code section */
			if(preg_match("/^[\s\S]+<p class='text-white'>[\s]*<\/p>$/m", $comment)) 
            {
				$comment = substr($comment, 0, strrpos($comment, "<p"));
			}
			return $comment;
		}
		else
			return $comment . "</p>";
	}
    
	$article = "Quiz Generator";
	require_once("../inc/header.inc.php"); 
?>
	<title><?php echo $headerData["Title"]; ?></title>
	<meta name="description" content="<?php echo $headerData["Description"]; ?>">
	
</head>

<body>
	
	<?php require_once("../inc/navbar.inc.php"); ?>
	
	<div id="content">
		<div class="container-fluid">
			<div class="row">
				<div id="article" class="col-12">
					<h2 class="heading mt-3 text-center">Quiz Generator - V1.0</h2>
					<br>
                    <div class="row">
                        <h3 class="col-12 pl-5">Question #1</h3>
                    </div>
					<form>
                        <textarea class="form-control sc col-5 ml-3" rows="1"></textarea>
					</form>
                    <br>
                    <button class="btn btn-info ml-3" id="codeToggle">Code</button>
                    <br>
                    <form id="code1">
                        
                    </form>
                    <br>
                    <label for="choiceNum1" style="font-size: 1.3rem;"># of Choices: </label>
                    <select name="choiceNum1" id="choiceNum1">
                        <option value="two">2</option>
                        <option value="three">3</option>
                        <option value="four">4</option>
                        <option value="five">5</option>
                    </select>
                    <br>
                    <br>
                    <br>
					<div class="text-center">
						<button class="btn btn-primary" id="update">Update/Copy</button>
						<button class="btn btn-success" id="add">New Row</button>
						<button class="btn btn-danger" id="del">Del Row</button>
					</div>
					<br>
					<div class="text-center">
						<textarea class="form-control col-6 mx-auto" id="out" rows="3">OUTPUT: </textarea>
					</div>
					<br>
					<br>
					<h3 class="heading ml-4">Instructions</h3>
					<hr style="border-color: #002664;">
					<ul class="inst">
						<li>Code: Whitespace is verbatim

					</ul>
				</div> <!-- End Article -->
			</div>
		</div>
	</div>
	
	<?php
		require_once("../inc/footer.inc.php"); 
	?>
	
</body>
</html>


<script>
	$(document).ready(function() {    
        $(document).on('input', 'textarea', function() {
            $(this).css('height', "45px");
            $(this).css('height', this.scrollHeight + "px");
        });
        
        $('#codeToggle').on('click', function() {
            var numOfCodeEntries = 0;
            
            return function() {
                if(this.innerHTML == "Code") 
                {
                    this.innerHTML = "No Code";
                }
                else
                    this.innerHTML = "Code";
            }
        });
        
        $('.replyLink').on('click', function() {
            if($(this)[0].hasAttribute('disabled'))
                return;  
            else
            {
                $(this).attr('disabled','disabled');
                var parentID = $(this).parent().attr('id');
                var parentEntryNum = parentID.substr(5);
                var actionString = $('#actionString').attr('action');
                var formID = parentID + "form";

                $('#' + parentID).after('<form class="mt-2" id="' + formID + '" action="' + actionString + '" method="POST">');
                $('#' + formID).append('<textarea class="form-control col-12 col-md-8 col-lg-6 commentEntry comment" name="comment"  placeholder="Enter Comment... 4096 max chars" maxlength="4096"></textarea>');
                $('#' + formID).append('<input type="hidden" name="parentNum" value="' + parentEntryNum + '">');
                $('#' + formID).append('<button type="submit" class="btn btnBlue btn-block col-3 col-lg-1 mt-2 mb-2">Submit</button>');
                $('#' + formID).append('</form>');           
            }
        });
    });
</script>