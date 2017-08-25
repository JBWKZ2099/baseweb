<nav class="navbar navbar-expand-md navbar-light bg-light">
	<div class="container">
		<a class="navbar-brand" href="#">
			<!-- <img src="http://placehold.it/200x50.jpg&text=200x50" alt="Brand" class="img-responsive"> -->
			<img src="#" alt="Brand" class="img-responsive">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item <?php if( $active=="index" ) echo 'active'; ?>">
					<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item <?php if( $active=="var_01" ) echo 'active'; ?>">
					<a class="nav-link" href="#">Link</a>
				</li>
				<li class="nav-item <?php if( $active=="var_02" ) echo 'active'; ?>">
					<a class="nav-link disabled" href="#">Disabled</a>
				</li>
			</ul>
			<form class="form-inline my-2 my-lg-0">
				<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			</form>
		</div>
	</div>
</nav>