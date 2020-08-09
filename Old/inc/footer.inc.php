<?php
	if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] === "")
		$dir = "./";
	else
		$dir = "../";
?>

	<footer class="container-fluid rounded-0">
		<div class="row">
			<div class="col-2">
				<a href="https://www.gnu.org/licenses/gpl-3.0.en.html">
					<img class="navbar-brand" src="<?php echo $dir; ?>img/LGPLv3_Logo.svg" alt="GNU PL 3">
				</a>
			</div>
			<div class="ml-auto">
				<p><strong class="kentYellow">Made by:</strong> Group2 - Landen, Nathan, Brandon, Ryan</p>
			</div>
		</div>
	</footer>
	
	<!-- Bootstrap documentation jquery and javascript scripts
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
