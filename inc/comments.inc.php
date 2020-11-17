<?php

    /* Insert comment */
	function insertNewComment($articleID)
	{
		global $conn;

		/* Prevent empty comment */
		if(empty($_POST['comment']))
		{
			return array("message" => "Empty comment - comment failed to be inserted.",
						 "comment" => $_POST['comment'], "parentNum" => strtolower($_POST['parentNum']));
		}
		/* Prevent duplicate inserton */
        if(isset($_SESSION['SameText']) && isset($_SESSION['SameParent']))
        {
            if(($_SESSION['SameText'] == $_POST['comment']) && ($_SESSION['SameParent'] == $_POST['parentNum']))
                return array("message" => "Duplicate comment - comment failed to be inserted.",
				             "comment" => $_POST['comment'], "parentNum" => strtolower($_POST['parentNum']));
        }

		/* Prevent too large of a comment */

		$comment = addslashes($_POST['comment']);
		if(strlen($comment) > 4096)
		{
			return array("message" => "Comment is too large. Please keep it &lt;= 4096 characters.",
						 "comment" => $_POST['comment'], "parentNum" => strtolower($_POST['parentNum']));
		}

		$timestamp = date("Y-m-d H:i:s");
		$parentNum = ($_POST['parentNum'] == "NULL") ? NULL : $_POST['parentNum'];

		/* Get next EntryNum or return error message */
		$entryNumCount = $conn->prepare("SELECT MAX(EntryNum) AS Max FROM Comments WHERE ArticleID = ?;");
		$entryNumCount->bindParam(1, $articleID, PDO::PARAM_STR, 16);
		$entryNumCount->execute();
		$entryNumCount = $entryNumCount->fetch(PDO::FETCH_ASSOC);

        /* This is true if SELECT statement was successful, not the result of MAX() */
		if($entryNumCount)
        {
			$entryNum = $entryNumCount['Max'] + 1;

			/* Insert into database */
			$commentInsert = $conn->prepare("INSERT INTO Comments VALUES (?, ?, ?, ?, ?, ?);");
			$commentInsert->execute(array($_SESSION['ID'], $articleID, $entryNum,
										  $parentNum, $comment, $timestamp));
		}
		else
		{
			return array("message" => "Comment unable to be entered into the database. Try again later.",
						 "comment" => $_POST['comment'], "parentNum" => strtolower($_POST['parentNum']));
		}

        /* Prevent duplication of insertion */
        $_SESSION['SameText'] = $_POST['comment'];
        $_SESSION['SameParent'] = $_POST['parentNum'];

		return array();
	}

	/* Check to ensure there are an even amount of opening and closing backticks (multiples of 2) */
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
        /* ENT_QUOTES convers both ' and " */
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

	function originalComments($articleID)
	{
		global $conn;

		$origComments = $conn->prepare("SELECT * FROM Comments WHERE ArticleID = ? AND ISNULL(ParentEntryNum)
										ORDER BY EntryNum ASC;");
		$origComments->bindParam(1, $articleID, PDO::PARAM_STR, 16);
		$origComments->execute();

		/* No comments to display */
		if(!$origComments)
        {
			echo "<p>There are currently no comments for this article.</p>";
			return;
		}
		else {
			$parent = [];
			while($parent = $origComments->fetch(PDO::FETCH_ASSOC)) {
				/* Get user's username for display */
				$user = $conn->prepare("SELECT Username FROM Accounts WHERE ID = ?;");
				$user->bindParam(1, $parent['ID'], PDO::PARAM_STR, 16);
				$user->execute();

				/* No ID Found */
				if(!$user)
                {
					$user = [];
					$user['Username'] = "Unknown User";
				}
                else
                    $user = $user->fetch(PDO::FETCH_ASSOC);

				/* Create comment display area */
				echo  "<div class='col-12 mt-5 commentBorder'>"
					 ."<p class='kentYellow'>$user[Username]</p>";
				echo  comment2Code($parent['Text']);
				echo  "<span id='reply$parent[EntryNum]' class='kentBlue'>$parent[Time] "
				     ."<span class='kentYellow'>|</span> Post #$parent[EntryNum] "
				     ."<span class='kentYellow'>|</span> ";

			    /* Prevent viewers with no account from using a broken form */
				if(isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] == TRUE)
					echo "<span class='replyLink'><i class='far fa-comment-dots' title='Reply'></i></span></span>";

				echo "</div>";

				/* See if original comment has any replies */
				hasReply($parent, $user);
			}
		}
	}

	function hasReply($replied, $user)
	{
		global $conn;

		$replies = $conn->prepare("SELECT * FROM Comments WHERE ArticleID = ? AND ParentEntryNum = ?
			                       ORDER BY EntryNum ASC;");
		$replies->bindParam(1, $replied['ArticleID'], PDO::PARAM_STR, 16);
		$replies->bindParam(2, $replied['EntryNum'], PDO::PARAM_INT);
		$replies->execute();

		if(!$replies)
			return;

		if($replies->rowCount() > 0)
			replyComments($replies, $user['Username'], $replied['EntryNum']);
	}

	function replyComments($children, $repliedUsername, $repliedPost)
	{
		global $conn;

		while($child = $children->fetch(PDO::FETCH_ASSOC)) {
			/* Get user's username for display */
			$user = $conn->prepare("SELECT Username FROM Accounts WHERE ID = ?;");
			$user->bindParam(1, $child['ID'], PDO::PARAM_STR, 16);
			$user->execute();

			/* No ID Found */
			if(!$user)
            {
				$user = [];
				$user['Username'] = "Unknown User";
			}
            else
                $user = $user->fetch(PDO::FETCH_ASSOC);

			echo  "<div class='col-11 mt-5 ml-auto'>"
				 ."<p class='kentYellow'>$user[Username] <span class='kentBlue'>-</span> "
				 ."Reply to $repliedUsername #$repliedPost</p>";
			echo  comment2Code($child['Text']);
			echo  "<span id='reply$child[EntryNum]' class='kentBlue'>$child[Time] <span class='kentYellow'>|</span> "
			     ."Post #$child[EntryNum] <span class='kentYellow'>|</span> ";

			 /* Prevent viewers with no account from using a broken form */
			 if(isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] == TRUE)
			     echo "<span class='replyLink'><i class='far fa-comment-dots' title='Reply'></i></span></span>";

            echo "</div>";

			/* See if child comment has any replies */
			hasReply($child, $user);
		}
	}

/* ----- Code for comments ----- */

/* If error inserting a comment, this executes */
$replaceText = FALSE;
if(isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] == TRUE && isset($_POST['comment']))
{
    /* Return value is in comments.inc.php as array(ErrorMessage, OriginalComment, ParentNum) */
    $commentProblem = [];
    $commentProblem = insertNewComment($headerData['ArticleID']);

    /* There is a problem; notifies user above original comment box */
    if(!empty($commentProblem))
    {
        echo "<p class='co-m'>$commentProblem[message]</p>";
		/* Don't reopen reply area if duplicate error */
		if(substr($commentProblem['message'], 0, 9) !== "Duplicate")
        	$replaceText = TRUE;
    }
}

/* Sets up action for comment submission */
if(isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] == TRUE)
{
    if($headerData['ArticleID'] != NULL)
		$actionString = "OP_OOE.php#commentArea";
	else
		$actionString = "";

	echo "<form id='actionString' action='$actionString' method='POST'>"
		 ."<textarea class='form-control col-12 col-md-8 col-lg-6 commentEntry comment' name='comment' "
		 ."placeholder='Enter Comment... 4096 max chars' maxlength='4096'></textarea>"
		 ."<input type='hidden' name='parentNum' value='NULL'>"
		 ."<button type='submit' class='btn btnBlue btn-block col-3 col-lg-1 mt-2'>Submit</button>"
	     ."</form>";
}
else
	echo "<p style='font-size: 1.2rem;' class='kentYellow text-center'>Please sign in to comment. Thank you.</p>";

/* Display comments */
if($headerData['ArticleID'] != NULL)
    originalComments($headerData['ArticleID']);
