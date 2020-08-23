<?php
    if(isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] == TRUE && $_SESSION['Privilege'] == "Student") 
        header("Location: ../index.php");
    
	$article = "Code Generator";
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
					<h2 class="heading mt-3 text-center">Code Generator - V1.0</h2>
					<br>
					
<!-- I don't know how to make this look nice without commenting out the lhs of each line -->					
<div class="exBoxPurple" id="result">
<figure class="code">
<pre><table class="table borderless my-auto">
<tr>
<td><pre id="lineNum" class="co-o">
</pre></td>
<td><pre  class="co-g" id="sourceCode">
</pre></td>
</tr></table></pre>
<p class="ml-2 mb-2" id="output"></p>
</figure>
</div>

					<br>
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
					<hr>
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
/* Source for clipboard - https://techoverflow.net/2018/03/30/copying-strings-to-the-clipboard-using-pure-javascript/ */
	$(document).ready(function() {
		$('#add').click(function() {
			$('.form-group').append('<br>');
			$('.form-group').append('<textarea class="form-control ln col-1" rows="1"></textarea> \
			<textarea class="form-control sc col-10 ml-3" rows="1"></textarea>');
		});
		
		$('#del').click(function() {
			$('.form-group').children().last().remove();
			$('.form-group').children().last().remove();
			$('.form-group').children().last().remove();
		});
		
		$('#update').click(function() {
			var lineNums = "";
			var source   = "";
			var output   = $("#out")[0].value;
			
			$(".ln").each(function(){lineNums += this.value + '\n';});
			$(".sc").each(function(){source += this.value + '\n';});
			
			lineNums = $.trim(lineNums);
			
			/* Sanitize user input */
			source = source.replace(/&/g, '&amp;')
						   .replace(/</g, '&lt;')
						   .replace(/>/g, '&gt;')
						   .replace(/'/g, '&apos;')
						   .replace(/"/g, '&quot;');
			/* Actual HTML to be displayed */
			source = source.replace(/@@C/gi, '<span class="co-c">')
			               .replace(/@@M/gi, '<span class="co-m">')
						   .replace(/@@R/gi, '<span class="co-r">')
						   .replace(/@@T/gi, '<span class="co-t">')
						   .replace(/@@W/gi, '<span class="co-w">')
						   .replace(/@@Y/gi, '<span class="co-y">')
						   .replace(/\$\$/gi, '</span>');
						   
			$("#lineNum").empty();
			$("#sourceCode").empty();
			$("#output").empty();
			
			$("#lineNum").html(lineNums);
			$("#sourceCode").html(source);
			$("#output").html(output);
			
			// Create new element
		    var code = document.createElement('textarea');
			code.value = $('#result').prop('outerHTML');
			// Set non-editable to avoid focus and move outside of view
			code.setAttribute('readonly', '');
			code.style = {position: 'absolute', left: '-9999px'};
			document.body.appendChild(code);
			// Select text inside element
			code.select();
			// Copy text to clipboard
			document.execCommand('copy');
			// Remove temporary element
			document.body.removeChild(code);
		});
	});
</script>