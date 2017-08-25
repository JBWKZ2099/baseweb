<nav class="navbar navbar-default">
	<div class="container-custom">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#my-navbar" aria-expanded="false">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="#" class="navbar-brand">
				<!-- <img src="http://placehold.it/200x50.jpg&text=200x50" alt="Brand" class="img-responsive"> -->
				<img src="#" alt="Brand" class="img-responsive">
			</a>
		</div>

		<!-- Nav links -->
		<div id="my-navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="<?php if( $active=="index" ) echo 'active'; ?>">
					<a href="#">Link</a>
				</li>
				<li class="<?php if( $active=="var_01" ) echo 'active'; ?>">
					<a href="#">Link</a>
				</li>
				<li class="dropdown<?php if( $active=="var_02" ) echo 'active'; ?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						Dropdown <span class="caret"></span>
					</a>
				</li>
			</ul>

			<form class="navbar-form navbar-left">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search">
					<button type="button" class="btn btn-default">Submit</button>
				</div>
			</form>

			<ul class="nav navbar-nav navbar-right">
				<li class="">
					<a href="#">Link navbar-right</a>
				</li>
			</ul>
		</div>
		<!-- Nav links -->
	</div>
</nav>