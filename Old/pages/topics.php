<?php 
	require_once('../inc/header.inc.php'); 
	
	if(isset($_GET['Class']))
		$class = $_GET['Class'];
	else 
		$class = NULL;
?>

	<div class="content">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 mt-5">
					<h1 class="text-center kentYellow"><?php echo $class ?> Topics</h1>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-12 mt-4 text-center links">
					<?php if($class != NULL) include_once("../inc/Topics/".$class.".php"); ?>
				</div>
			</div>
		</div>
	</div>
	
<?php require_once('../inc/footer.inc.php'); ?>
