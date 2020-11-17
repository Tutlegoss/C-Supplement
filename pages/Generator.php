<?php

    session_start();

    if(!($_SESSION) || empty($_SESSION) || ($_SESSION['Privilege'] == "Student"))
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
					<h2 class="heading mt-3 text-center">Code Generator - V2.0</h2>
                    <h5 class="mt-3 text-center">TODO: OUTPUT whitespace/color, toggle output</h5>
					<br>

<div class="exBoxPurple" id="result">
<figure class="code">
<pre><table class="table borderless my-auto">
<tr>
<td><pre id="lineNum" class="co-o">
</pre></td>
<td><pre class="co-g" id="sourceCode">
</pre></td>
</tr></table></pre>
<p class="ml-2 mb-2" id="output"></p>
</figure>
</div>

					<br>
                    <div class="row">
                        <h6 class="col-2 text-center">Ln #</h6>
                        <h6 class="col-9 text-center">Code</h6>
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
                        <li>First field is line number</li>
                        <li>Second field is code</li>
						<li>Code: Whitespace is verbatim</li>
						<li>Update/Copy: Change the example code box (purple border) and copy the code to clipboard</li>
						<li>New Row: Add a new line of code</li>
						<li>Del Row: Delete a row of code (currently deletes the last row per click)</li>
						<li>Colors (can be uppercase or lowercase):
							<ul>
								<li class="co-c">``C is cyan
									<ul>
										<li>Primitive data types</li>
										<li>struct, class, union</li>
										<li>namespace</li>
									</ul>
								</li>
								<li class="co-g">``G is green
									<ul>
										<li>Standard text color (already implemented)</li>
									</ul>
								</li>
								<li class="co-m">``M is magenta
									<ul>
										<li>Literals</li>
									</ul>
								</li>
								<li class="co-o">``O is orange
									<ul>
										<li>Line numbers (already implemented)</li>
									</ul>
								</li>
								<li class="co-r">``R is red
									<ul>
										<li>Labels</li>
										<li>Most keywords</li>
										<li>Flow control (if, switch, for, while)</li>
										<li>using</li>
										<li>continue, break</li>
									</ul>
								</li>
								<li class="co-t">``T is teal
									<ul>
										<li>string</li>
										<li>User-defined types (e.g. class name)</li>
									</ul>
								</li>
								<li class="co-w">``W is white
									<ul>
										<li>Comments</li>
									</ul>
								</li>
								<li class="co-y">``Y is yellow
									<ul>
										<li>Operators</li>
									</ul>
								</li>
								<li>`~ is &lt;/span&gt; (e.g. end current color)</li>
							</ul>
						</li>
                    </ul>
                    <p class="text-justify ml-2 mr-2 mt-3 inst">
						EX) ``Cint`~ x = ``M1`~; <em>produces</em> <br> &emsp;&emsp; <span class="co-g"><span class="co-c">int</span> x = <span class="co-m">1</span>;</span><br>
					</p>
                    <ul class="inst">
						<li>OUTPUT: Results of the program
                            <ul>
                                <li>``N is a newline for multi-line output</li>
                                <li>Output is by default white and has no additional colors</li>
                            </ul>
                        </li>
					</ul>
					<p class="text-justify ml-2 mr-2 mt-3 inst">
                        EX) OUTPUT: ``N 1 ``N 2 ``N 3 <em>produces</em> <br> &ensp; &ensp; OUTPUT:<br> &ensp; &ensp; 1<br> &ensp; &ensp; 2<br> &ensp; &ensp; 3
					</p>
				</div> <!-- End Article -->
			</div>
		</div>
	</div>

	<?php
		require_once("../inc/footer.inc.php");
	?>

<script src="../inc/code.js"></script>

</body>
</html>
