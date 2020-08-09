<?php require_once('../inc/header.inc.php'); ?>

	<div class="content">
		<div class="container">
			<div class="row">
				<?php
				if (isset($_SESSION["loggedin"])) {
					echo "<br>Logging out...<br>";
					session_destroy();
				}
				else {
					echo "<br>User is already logged out.<br>";
				}
				?>
				<!-- Redirect to homepage -->
				<meta http-equiv="Refresh" content="0; url=https://www.kentcpp.com" />
			</div>
		</div>
	</div>
		
<?php require_once('../inc/footer.inc.php'); ?>

