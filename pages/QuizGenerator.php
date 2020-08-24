<?php 

    session_start();
    
    if(isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] == TRUE && $_SESSION['Privilege'] == "Student") 
        header("Location: ../index.php");
    
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
                        <h3 class="col-2 text-center">Answer</h3>
                        <h3 class="col-9 text-center">Question</h3>
                    </div>
					<form>
						<div class="form-group form-row justify-content-center">
							<textarea class="form-control ln col-1" rows="1"></textarea>
							<textarea class="form-control sc col-10 ml-3" rows="1"></textarea>
						</div>
					</form>
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
						<li>Update/Copy: Change the example code box (purple border) and copy the code to clipboard</li>
						<li>New Row: Add a new line of code</li>
						<li>Del Row: Delete a row of code (currently deletes the last row per click)</li>
						<li>Colors (can be uppercase or lowercase):
							<ul>
								<li class="co-c">@@C is cyan
									<ul>
										<li>Primitive data types</li>
										<li>struct, class, union</li>
										<li>namespace</li>
									</ul>
								</li>
								<li class="co-g">@@G is green
									<ul>
										<li>Standard text color (already implemented)</li>
									</ul>
								</li>
								<li class="co-m">@@M is magenta
									<ul>
										<li>Literals</li>
									</ul>
								</li>
								<li class="co-o">@@O is orange
									<ul>
										<li>Line numbers (already implemented)</li>
									</ul>
								</li>
								<li class="co-r">@@R is red
									<ul>
										<li>Labels</li>
										<li>Most keywords</li>
										<li>Flow control (if, switch, for, while)</li>
										<li>using</li>
										<li>continue, break</li>
									</ul>
								</li>
								<li class="co-t">@@T is teal
									<ul>
										<li>string</li>
										<li>User-defined types (e.g. class name)</li>
									</ul>
								</li>
								<li class="co-w">@@W is white
									<ul>
										<li>Comments</li>
									</ul>
								</li>
								<li class="co-y">@@Y is yellow
									<ul>
										<li>Operators</li>
									</ul>
								</li>
								<li>$$ is &lt;/span&gt;</li>
							</ul>
						</li>
						<li>OUTPUT: Results of the program (currently one line only)
					</ul>
					<p class="text-justify ml-2 mr-2 mt-3 inst">
						EX) @@Cint$$ x = @@M1$$; produces <span class="co-g"><span class="co-c">int</span> x = <span class="co-m">1</span>;</span>
					</p>
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