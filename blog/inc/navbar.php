	<nav class="navbar navbar-dark navbar-expand-md">
		<a class="navbar-brand" href="https://www.kentcpp.com"><img src="../img/Kpp.png" alt="Kent C++"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
		</button>
		<!-- style="" in first a tags and input tag --> 
		<div class="collapse navbar-collapse" id="collapsibleNavbar">
			<ul class="navbar-nav nav nav-pills mr-auto mt-2 mt-md-0">	
				<li class="nav-item">
					<a class="nav-link mr-2" style="color: #F8EB61;" href="#">CS I</a>
				</li>
				<li class="nav-item">
					<a class="nav-link mr-2" style="color: #4994CB;" href="#">CS II</a>
				</li>
				<li class="nav-item">
					<a class="nav-link mr-2 text-white" href="#">CS III</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" style="color: #F8EB61;" href="#">Blog</a>
				</li>  	  
			</ul>
			<form action="#" class="form-inline my-auto ml-auto mr-2" method="GET" >
				<label for="search"></label>
				<input class="form-control" style="border-radius: 0;" name="search" id="search" type="search"  placeholder="Search">
				<button class="btn text-white" type="submit"><i class="fas fa-search"></i></button>
			</form>
		
			<form action="../pages/Login.php" class="my-auto">
				<button class="btn mr-2 btn_mgn text-white padLogin" type="submit">Login</button>
			</form>
		</div>  
	</nav>