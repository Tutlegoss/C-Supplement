	<nav class="navbar navbar-dark navbar-expand-md">
		<a class="navbar-brand" href="<?php echo $headerData["Path"]; ?>index.php"><img src="<?php echo $headerData["Path"]; ?>img/Kpp.png" alt="Kent C++"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar"
				aria-controls="collapsibleNavbar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<!-- style="" in first a tags and input tag --> 
		<div class="collapse navbar-collapse" id="collapsibleNavbar">
			<ul class="navbar-nav nav mr-auto mt-2 mt-md-0">	
				<li class="nav-item">
					<a class="nav-link mr-2" style="color: #F8EB61;" href="<?php echo $headerData["Path"]; ?>pages/CSI_Topics.php">CS I</a>
				</li>
				<li class="nav-item">
					<a class="nav-link mr-2" style="color: #4994CB;" href="#">CS II</a>
				</li>
				<li class="nav-item">
					<a class="nav-link mr-2 text-white" href="#">CS III</a>
				</li>
				<li class="nav-item">
					<a class="nav-link mb-2 mb-md-0" style="color: #F8EB61;" href="<?php echo $headerData["Path"]; ?>pages/OP_OOE.php">Blog</a>
				</li>  	  
			</ul>
			<form action="#" class="form-inline my-auto ml-auto mr-2" method="GET" >
				<label for="search"></label>
				<input class="form-control" style="border-radius: 0;" name="search" id="search" type="search"  placeholder="Search" aria-label="Search">
				<button class="btn text-white" type="submit"><i class="fas fa-search"></i></button>
			</form>
			<ul class="navbar-nav nav mt-2 mt-md-0">	
				<li class="nav-item">
					<a class="nav-link mr-2 text-white" <?php if(isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'] == TRUE)
																		echo "href='$headerData[Path]pages/Logout.php'>Logout";
															  else 
																		echo "href='$headerData[Path]pages/Login.php'>Login";
														?></a>
				</li> 	  
			</ul>
		</div>  
	</nav>