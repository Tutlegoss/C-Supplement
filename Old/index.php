<?php require_once('./inc/header.inc.php'); ?>

	<div class="content">
		<div class="container-fluid rounded-0 banner">
			<span>Kent State's C++ Code Course</span>
		</div>
		
		<div class="container-fluid mt-5 mb-5" id="landing">
			<div class="row">
				<div class="col-cust-img mb-5"> 
					<img src="./img/CSI.png" class="img-view mx-auto d-block" alt="CS_I Word Art">
				</div>
				<div class="col-cust-info mb-5">
					<h5 class="kentYellow text-center">Computer Science I - CS 13001</h5>
					<table class="table text-white">
						<tr>
							<td class="kentBlue">Class Time:</td>
							<td>Tuesday/Thursday</td>
							<td>12:30p - 01:45p</td>
						</tr>
						<tr>
							<td class="kentBlue">Lab Time:</td>
							<td>Friday</td>
							<td>09:00a - 11:00a</td>
						</tr>
						<tr>
							<td class="kentBlue">Tutor:</td>
							<td>Landen</td>
							<td>Lmarchan@kent.edu</td>
						</tr>
						<tr>
							<td class="kentBlue">Next Exam:</td>
							<td>Thursday Oct 1</td>
							<td>12:30p - 01:45p</td>
						</tr>						
					</table>
					<div class="text-center">
						<a href="./pages/topics.php?Class=CSI" class="btn btnKent">CS I Index</a>
					</div>
				</div>
				
				<div class="col-cust-img mb-5"> 
					<img src="./img/CSII.png" class="img-view mx-auto d-block" alt="CS_II Word Art">
				</div>
				<div class="col-cust-info mb-5">
					<h5 class="kentBlue text-center">Computer Science II - CS 23001</h5>				
					<table class="table text-white">
						<tr>
							<td class="kentYellow">Class Time:</td>
							<td>Tuesday/Thursday</td>
							<td>03:30p - 04:45p</td>
						</tr>
						<tr>
							<td class="kentYellow">Lab Time:</td>
							<td>Friday</td>
							<td>11:00a - 01:00p</td>
						</tr>
						<tr>
							<td class="kentYellow">Tutor:</td>
							<td>Landen</td>
							<td>Lmarchan@kent.edu</td>
						</tr>
						<tr>
							<td class="kentYellow">Next Exam:</td>
							<td>Thursday Oct 1</td>
							<td>03:30p - 04:45p</td>
						</tr>						
					</table>
					<div class="text-center">
						<a href="./pages/topics.php?Class=CSII" class="btn btnKent">CS II Index</a>
					</div>
				</div>

				<div class="col-cust-img mb-5"> 
					<img src="./img/CSIII.png" class="img-view mx-auto d-block" alt="CS_III Word Art">
				</div>
				<div class="col-cust-info mb-5">
					<h5 class="text-center">Computer Science III - CS 44001</h5>				
					<table class="table text-white">
						<tr>
							<td class="kentYellow">Class Time:</td>
							<td>Tuesday/Thursday</td>
							<td>05:55p - 08:10p</td>
						</tr>
						<tr>
							<td class="kentYellow">Lab Time:</td>
							<td>Friday</td>
							<td>11:00a - 01:00p</td>
						</tr>
						<tr>
							<td class="kentYellow">Tutor:</td>
							<td>Landen</td>
							<td>Lmarchan@kent.edu</td>
						</tr>
						<tr>
							<td class="kentYellow">Next Exam:</td>
							<td>Thursday Oct 1</td>
							<td>05:55p - 08:10p</td>
						</tr>						
					</table>
					<div class="text-center">
						<a href="./pages/topics.php?Class=CSIII" class="btn btnKent">CS III Index</a>
					</div>
				</div>
				
				<?php if (isset($_SESSION["loggedin"])): ?>
					<div class="col-cust-img mb-5"> 
						<img src="./img/IM.png" class="img-view mx-auto d-block" alt="Chat Word Art">
					</div>
					<div class="col-cust-info mb-5">
						<h5 class="kentYellow text-center">Chat with a Tutor</h5>				
						<table class="table text-white">
							<tr>
								<td class="kentBlue">Landen:</td>
								<td>Monday/Wednesday</td>
								<td>08:00a - 12:00p</td>
							</tr>
							<tr>
								<td class="kentBlue">Trey:</td>
								<td>Tuesday/Thursday</td>
								<td>09:00a - 01:00p</td>
							</tr>
							<tr>
								<td class="kentBlue">Tutor3:</td>
								<td>Friday</td>
								<td>01:00p - 05:00p</td>
							</tr>				
						</table>				
						<div class="text-center">
							<a href="./pages/chatConnect.php" class="btn btnKent">IM Client</a>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	
<?php require_once('./inc/footer.inc.php'); ?>