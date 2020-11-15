<?php

    session_start();

	$article = "Kpp Main Page";
	require_once("./inc/header.inc.php");
?>
	<title><?php echo $headerData["Title"]; ?></title>
	<meta name="description" content="<?php echo $headerData["Description"]; ?>">

</head>

<body>

	<?php require_once("./inc/navbar.inc.php"); ?>

	<div id="content">
		<div class="container-fluid">
			<div class="row">
				<div id="article" class="col-12">
					<div class="rounded-0" id="banner">
						<p class="my-auto">Kent State - Stark's C++ Supplement</p>
					</div>
					<div class="row d-flex align-items-center">
                        <div class="col-12 text-center mt-3">
                            <h5 class="kentYellow">This website is not complete and is an ongoing project. The souce code is on github at
                            <a href="https://github.com/Tutlegoss/C-Supplement">Kentcpp Github</a>.</h5>
                        </div>
						<div class="col-12 col-md-5 mt-5 text-center img-size">
							<img class="img-fluid" src="./img/CSI.png" alt="CS I Word Art">
						</div>
						<div class="col-12 col-md-7">
							<h5 class="kentYellow text-center mt-3 mt-md-5">Computer Science I - CS 13001</h5>
							<table class="table text-white">
								<tr>
									<td class="kentYellow">Class Time:</td>
									<td>Tuesday &amp; Thursday</td>
									<td>12:30p - 01:45p</td>
								</tr>
								<tr>
									<td class="kentBlue">Lab Time:</td>
									<td>Friday</td>
									<td>10:00a - 12:00p</td>
								</tr>
								<tr>
									<td class="kentYellow">Tutor:</td>
									<td>Landen</td>
									<td>Lmarchan@kent.edu</td>
								</tr>
							</table>
						</div>
					</div>
					<div class="row d-flex align-items-center">
						<div class="col-12 col-md-5 mt-5 text-center img-size">
							<img class="img-fluid" src="./img/CSII.png" alt="CS II Word Art">
						</div>
						<div class="col-12 col-md-7">
							<h5 class="kentBlue text-center mt-3 mt-md-5">Computer Science II - CS 23001</h5>
							<table class="table text-white">
								<tr>
									<td class="kentBlue">Class Time:</td>
									<td>Tuesday &amp; Thursday</td>
									<td>03:30p - 04:45p</td>
								</tr>
								<tr>
									<td class="kentYellow">Lab Time:</td>
									<td>Friday</td>
									<td>12:00p - 02:00p</td>
								</tr>
								<tr>
									<td class="kentBlue">Tutor:</td>
									<td>Landen</td>
									<td>Lmarchan@kent.edu</td>
								</tr>
							</table>
						</div>
					</div>
					<div class="row d-flex align-items-center">
						<div class="col-12 col-md-5 mt-5 text-center img-size">
							<img class="img-fluid" src="./img/CSIII.png" alt="CS III Word Art">
						</div>
						<div class="col-12 col-md-7 mt-3 mt-md-5">
							<h5 class="text-center">Computer Science III - CS 44001</h5>
							<table class="table text-white">
								<tr>
									<td class="kentYellow">Class Time:</td>
									<td>Tuesday &amp; Thursday</td>
									<td>05:30p - 06:45p</td>
								</tr>
								<tr>
									<td class="kentBlue">Lab Time:</td>
									<td>Tuesday &amp; Thursday</td>
									<td>06:50p - 07:50p</td>
								</tr>
								<tr>
									<td class="kentYellow">Tutor:</td>
									<td>Landen</td>
									<td>Lmarchan@kent.edu</td>
								</tr>
							</table>
						</div>
					</div>
					<div class="row mb-5 d-flex align-items-center">
						<div class="col-12 col-md-5 mt-5 text-center img-size">
							<img class="img-fluid" src="./img/Blog.png" alt="Blog Word Art">
						</div>
					</div>
				</div> <!-- End Article -->
			</div>
		</div>
	</div>

	<?php
		require_once("./inc/footer.inc.php");
	?>

</body>
</html>
