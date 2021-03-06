<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		$view_name="Blog";
		include("structure/head.php");

		include('php/blog/core.php');
		include('php/slug.lib.php');

		date_default_timezone_set('America/Mexico_City');
		$tabla = 'blogs';
		$mysqli = Connection::conectar_db();
		Connection::selecciona_db($mysqli);
		mysqli_query ($mysqli,"SET NAMES 'UTF8';");

		$page = 1;

		if( isset($_GET["page"]) )
			$page = $_GET["page"];

		// dd( wblog() );

		if(wblog() == "no") {
			if( isset($_GET["search"]) && !empty($_GET["search"]) ) // If user searchs something
				$search = $_GET["search"];
			else
				$search = null;

			$blog = blog_actual($mysqli, $tabla, null, null, null, $page, $search);
			$blogroot = "false";
		} else {
			$blogroot = "true";
			$ssblog = blog_ver($mysqli, $tabla, wblog()['idblog'], 1);
			$catblog = blog_ver($mysqli, $tabla, wblog()['isblog'], 2);


			$show_catblog = 0;
			if( wblog()['idblog'] )
				$show_catblog++;
			if( wblog()['isblog'] )
				$show_catblog++;
	?>
		<meta name="keywords" content="<?php echo $ssblog[0]['meta_keywords'] ?>">
		<meta name="description" content="<?php echo $ssblog[0]['meta'] ?>">
	<?php } ?>
	<link rel="stylesheet" type="text/css" href="<?php echo $path; ?>assets/css/multilevel.css">
</head>
<body>
	<?php $active="blog"; include("structure/navbar.php"); ?>
	<?php dd($blogroot); if($blogroot == 'true') { ?>
		<?php if(isset($blog[0]['name']) || isset($ssblog[0]['name'])) { ?>
			<?php $bg_color="bg-black"; $blog = true; ?>
			<section class="container-fluid">
				<?php if( isset($ssblog[0]['cover']) && !empty($ssblog[0]['cover']) ) { ?>
					<div class="row relativer bg-container bg-mh bg-widget-cover appear" style="background-image: url('<?php echo $path; ?>uploads/<?php echo $ssblog[0]['cover'] ?>')"> </div>
				<?php } else { ?>
					<div class="row relativer bg-container bg-mh bg-widget-cover align-items-center justify-content-center" style="border-bottom: 1px solid #333;">
							<p> <?php  echo $ssblog[0]['cover_alt']; ?> </p>
					</div>
				<?php } ?>
			</section>

			<section class="py-60">
				<div class="container-custom">
					<div class="row justify-content-center">
						<div class="col-md-12 text-center mb-45">
							<h1 class="mb-3"><strong><?php echo $ssblog[0]["name"] ?></strong></h1>
							<h4> <em>por <?php echo $ssblog[0]["author"] ?></em> </h4>
						</div>
						<div class="col-md-10">
							<?php if( isset($ssblog[0]['video']) ) { ?>
								<div class="play-container blog-play-container">
									<img class="play-ico" src="<?php echo $path; ?>assets/img/play-13.svg" alt="PlayIco">
									<img class="custom-thumbnail img-fluid d-block m-auto" src="<?php echo $path; ?>uploads/<?php echo $ssblog[0]['img'] ?>" alt="<?php echo $ssblog[0]['img_alt'] ?>">
									<div class="embed-responsive embed-responsive-16by9 d-none">
										<iframe id="emb-iframe" class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $ssblog[0]['video']; ?>" allowfullscreen></iframe>
									</div>
								</div>
							<?php } else { ?>
								<img class="img-fluid d-block m-auto" src="<?php echo $path; ?>uploads/<?php echo $ssblog[0]['img'] ?>" alt="<?php echo $ssblog[0]['img_alt'] ?>">
							<?php } ?>

							<p class="mb-3"></p>
							<?php echo $ssblog[0]["body"]; ?>

							<div class="row justify-content-center mt-60">
								<div class="col-md-4">
									<a href="<?php echo $path;?>blog" class="btn btn-success d-block">VOLVER</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		<?php } else { ?>
			<?php if( isset($catblog) && !empty($catblog) && $show_catblog>0 ) { ?>
				<?php
					// dd($catblog[0]["type"]);
					if( isset($catblog[0]["type"]) && !empty($catblog[0]["type"]) ) {
						$type = $catblog[0]["type"];
						$val = $catblog[0]["category"];
					}
					$blog = blog_actual($mysqli, $tabla, $val, $type, wblog()["isblog"], $page, null);
				?>
				<section class="container-fluid">
					<div class="row relativer bg-container bg-mh bg-widget-cover bg-blog-img appear">
				</section>

				<div class="container-custom py-60">
					<div class="row">
						<div class="col-md-6 offset-md-3 text-center">
							<img src="<?php echo $path; ?>assets/img/logo-34.svg" alt="logo">
						</div>
						<div class="col-md-12 text-center mt-5">
							<h1 class="bolder">NUESTRO BLOG</h1>
							<hr class="hr-blog">

							<?php include("widgets/categories.php"); ?>
						</div>
						<?php
							array_pop($blog); /*Delete last array element*/
							$blogs = $blog;
						?>
					</div>
					<div class="row align-items-center">
						<?php if( isset($blogs) && !empty($blogs) ) { ?>
							<?php $b_counter = 0; ?>
							<?php foreach( $blogs as $blog ) { ?>
								<?php if( $b_counter==0 ) { ?>
									<div class="col-md-7 text-center mt-60 mb-3 mb-md-5">
										<div class="row justify-content-center">
											<div class="col-md-12">
												<img class="img-fluid d-block" src="<?php echo $path; ?>uploads/<?php echo $blog['img']; ?>" alt="<?php echo $blog['img_alt'] ?>">
											</div>
										</div>
									</div>
									<div class="col-md-5 mt-60 mb-3 mb-md-5">
										<div class="row">
											<div class="col-md-12">
												<h3 class="bolder text-uppercase"><?php echo $blog["name"]; ?></h3>
												<p class="mt-3 mb-3 mb-md-5 text-lgray">
													<?php
														if( strlen($blog["body"])>500 )
															echo substr($blog["body"], 0, 500)."...";
														else
															echo $blog["body"];
													?>
												</p>
											</div>

											<div class="col-md-12">
												<?php
													$url = $path."blog/";
													if( $blog["type"]=="exccom-services" )
														$url .= $blog["category"]."/";
													else if( $blog["type"]=="atm" )
														$url .= "atm/";
													else if( $blog["type"]=="capacitacion" )
														$url .= "capacitacion/";

													$url .= slugger($blog["name"]);
												?>
												<a href="<?php echo $url; ?>" class="btn btn-success btn-block mt-4 text-white">LEER COMPLETO</a>
											</div>
										</div>
									</div>
								<?php } else { ?>
									<div class="col-md-4">
										<div class="row align-items-center">
											<div class="col-md-12 mb-3">
												<img class="img-fluid d-block" src="<?php echo $path; ?>uploads/<?php echo $blog['img']; ?>" alt="<?php echo $blog['img_alt'] ?>">
											</div>

											<div class="col-md-12 mb-3 blog-title">
												<h5 class="bolder text-uppercase">
													<?php
														if( strlen($blog["name"]>50) )
															echo substr($blog["name"], 0, 50)."...";
														else
															echo $blog["name"];
													?>
												</h5>
											</div>

											<div class="col-md-12 blog-preview-content">
												<div class="row no-gutters align-items-center h-100">
													<div class="col-md-12">
														<div class="mt-3 mb-3 text-lgray">
															<?php
																if( strlen($blog["body"])>300 )
																	echo substr($blog["body"], 0, 300)."...";
																else
																	echo $blog["body"];
															?>
														</div>
													</div>
												</div>
											</div>

											<div class="col-md-12">
												<?php
													$url = $path."blog/";
													if( $blog["type"]=="exccom-services" )
														$url .= $blog["category"]."/";
													else if( $blog["type"]=="atm" )
														$url .= "atm/";
													else if( $blog["type"]=="capacitacion" )
														$url .= "capacitacion/";

													$url .= slugger($blog["name"]);
												?>
												<a href="<?php echo $url; ?>" class="btn btn-success btn-block mt-4 text-white">LEER COMPLETO</a>
											</div>
										</div>
									</div>
								<?php } ?>

								<?php $b_counter++; ?>
							<?php } ?>
						<?php } else { ?>
							<div class="col-md-12 mt-3 text-center">
								<h3 class="text-black">No hay blogs.</h3>
							</div>
						<?php } ?>
					</div>
					<?php if( $blog["pages"]!=null ) { ?>
						<div class="col-md-12 mt-3 mt-md-5">
						  <ul class="pagination pagination-black justify-content-center">
						    <li class="page-item"><a class="page-link" href="<?php if($page>1) echo "?page=".($_GET["page"]-1); else echo "#"; ?>">Anterior</a></li>
						    <?php for( $i=1; $i<=$blog["pages"]; $i++ ) { ?>
						    	<li class="page-item <?php if( $_GET["page"]==$i || $page==$i ) echo 'active' ?>">
						    		<a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
						    	</li>
						    <?php } ?>
						    <li class="page-item"><a class="page-link" href="<?php if( isset($_GET["page"]) ) { if( $_GET["page"]==$blog["pages"] ) echo "#"; else echo "?page=".($page+1); } else {if( $page==$blog["pages"] ) echo "#"; else echo "?page=".($page+1); } ?>">Siguiente</a></li>
						  </ul>
						</div>
					<?php } ?>

					<?php /*<div class="row justify-content-center mt-60">
						<div class="col-md-4">
							<a href="<?php echo $path; ?>blog" class="btn btn-success d-block">VOLVER</a>
						</div>
					</div>*/ ?>
				</div>
			<?php } else { ?>
				<section class="container-fluid">
					<div class="row relativer bg-container bg-mh bg-widget-cover bg-blog-img appear">
				</section>

				<section class="py-60">
					<div class="container-custom">
						<div class="row">
							<div class="col-md-6 offset-md-3 text-center">
								<img src="<?php echo $path; ?>assets/img/logo-34.svg" alt="logo">
							</div>
							<div class="col-md-12 text-center mt-5">
								<h2 class="bolder">NO HAY CONTENIDO EN ESTA CATEGOR??A.</h2>
								<hr class="hr-blog">
							</div>
						</div>

						<div class="row justify-content-center mt-60">
							<div class="col-md-4">
								<a href="<?php echo $path;?>blog" class="btn btn-success d-block">VOLVER</a>
							</div>
						</div>
					</div>
				</section>
			<?php } ?>
		<?php } ?>
		<?php if(isset($blog[0]['name']) || isset($sblog[0]['name'])) { ?>
		<?php } ?>
	<?php } else { ?>
		<section class="container-fluid">
			<div class="row relativer bg-container bg-mh bg-widget-cover bg-blog-img appear">
		</section>

		<div class="container-custom py-60">
			<div class="row">
				<div class="col-md-6 offset-md-3 text-center">
					<img src="<?php echo $path; ?>assets/img/logo-34.svg" alt="logo">
				</div>
				<div class="col-md-3 float-right input-group">
					<input id="search" class="form-control text-center" placeholder="BUSCAR">
				  <div class="input-group-append">
				  	<button id="search-btn" class="btn btn-outline-secondary" type="button">
				  		<i class="fas fa-search"></i>
				  	</button>
				  </div>
				</div>
				<div class="col-md-12 text-center mt-5">
					<h1 class="bolder">NUESTRO BLOG</h1>
					<hr class="hr-blog">

					<?php include("widgets/categories.php"); ?>
				</div>
				<?php
					array_pop($blog); /*Delete last array element*/
					$blogs = $blog;

					if( isset($_GET["page"]) && !empty($_GET["page"]) && $_GET["page"]<=$blog[0]["pages"] ) { ?>
						<?php if( isset($blogs) && !empty($blogs) ) { ?>
							<div id="blogs-container" class="col-md-12">
								<div class="row align-items-center">
									<?php $b_counter = 0; ?>
									<?php foreach( $blogs as $blog ) { ?>
										<?php if( $b_counter==0 ) { ?>
											<div class="col-md-7 text-center mt-60 mb-3 mb-md-5">
												<div class="row justify-content-center">
													<div class="col-md-12">
														<img class="img-fluid d-block" src="<?php echo $path; ?>uploads/<?php echo $blog['img']; ?>" alt="<?php echo $blog['img_alt'] ?>">
													</div>
												</div>
											</div>
											<div class="col-md-5 mt-60 mb-3 mb-md-5">
												<div class="row">
													<div class="col-md-12">
														<h3 class="bolder text-uppercase"><?php echo $blog["name"]; ?></h3>
														<p class="mt-3 mb-3 mb-md-5 text-lgray">
															<?php
																if( strlen($blog["body"])>500 )
																	echo substr($blog["body"], 0, 500)."...";
																else
																	echo $blog["body"];
															?>
														</p>
													</div>

													<div class="col-md-12">
														<?php
															$url = $path."blog/";
															if( $blog["type"]=="exccom-services" )
																$url .= $blog["category"]."/";
															else if( $blog["type"]=="atm" )
																$url .= "atm/";
															else if( $blog["type"]=="capacitacion" )
																$url .= "capacitacion/";

															$url .= slugger($blog["name"]);
														?>
														<a href="<?php echo $url; ?>" class="btn btn-success btn-block mt-4 text-white">LEER COMPLETO</a>
													</div>
												</div>
											</div>
										<?php } else { ?>
											<div class="col-md-4">
												<div class="row align-items-center">
													<div class="col-md-12 mb-3">
														<img class="img-fluid d-block" src="<?php echo $path; ?>uploads/<?php echo $blog['img']; ?>" alt="<?php echo $blog['img_alt'] ?>">
													</div>

													<div class="col-md-12 mb-3 blog-title">
														<h5 class="bolder text-uppercase">
															<?php
																if( strlen($blog["name"]>50) )
																	echo substr($blog["name"], 0, 50)."...";
																else
																	echo $blog["name"];
															?>
														</h5>
													</div>

													<div class="col-md-12 blog-preview-content">
														<div class="row no-gutters align-items-center h-100">
															<div class="col-md-12">
																<div class="mt-3 mb-3 text-lgray">
																	<?php
																		if( strlen($blog["body"])>300 )
																			echo substr($blog["body"], 0, 300)."...";
																		else
																			echo $blog["body"];
																	?>
																</div>
															</div>
														</div>
													</div>

													<div class="col-md-12">
														<?php
															$url = $path."blog/";
															if( $blog["type"]=="exccom-services" )
																$url .= $blog["category"]."/";
															else if( $blog["type"]=="atm" )
																$url .= "atm/";
															else if( $blog["type"]=="capacitacion" )
																$url .= "capacitacion/";

															$url .= slugger($blog["name"]);
														?>
														<a href="<?php echo $url; ?>" class="btn btn-success btn-block mt-4 text-white">LEER COMPLETO</a>
													</div>
												</div>
											</div>
										<?php } ?>

										<?php $b_counter++; ?>
									<?php } ?>
								</div>
							</div>
						<?php } else { ?>
							<div class="col-md-12 mt-3 text-center">
								<h3 class="text-black">No hay blogs.</h3>
							</div>
						<?php } ?>
				<?php } else { /*Si el $_GET["pages"] es mayor al numero total de paginas*/ ?>
					<div class="col-md-12 mt-3 mt-md-5 text-center">
						<h3 class="text-black">No hay blogs en esta p??gina.</h3>
					</div>
				<?php } ?>
			</div>
			<?php if( isset($blog["pages"]) && !empty($blog["pages"]) && $blog["pages"]!=null ) { ?>
				<div id="section-paginate" class="col-md-12 mt-3 mt-md-5">
				  <ul class="pagination pagination-black justify-content-center">
				    <li class="page-item"><a class="page-link" href="<?php if($page>1) echo "blog?page=".($_GET["page"]-1); else echo "#"; ?>">Anterior</a></li>
				    <?php for( $i=1; $i<=$blog["pages"]; $i++ ) { ?>
				    	<li class="page-item <?php if( $_GET["page"]==$i || $page==$i ) echo 'active' ?>">
				    		<a class="page-link" href="blog?page=<?php echo $i; ?>"><?php echo $i; ?></a>
				    	</li>
				    <?php } ?>
				    <li class="page-item"><a class="page-link" href="<?php if( isset($_GET["page"]) ) { if( $_GET["page"]==$blog["pages"] ) echo "#"; else echo "blog?page=".($page+1); } else {if( $page==$blog["pages"] ) echo "#"; else echo "blog?page=".($page+1); } ?>">Siguiente</a></li>
				  </ul>
				</div>
			<?php } ?>
		</div>
	<?php } ?>


	<?php
		if( $blogroot == 'true' ) {
			if(isset($blog[0]['name']) || isset($ssblog[0]['name'])) {
				$id_blog = $ssblog[0]["id"];
				$comments = getComments($mysqli,$id_blog); ?>
		<section id="section-comments" class="container-custom pb-60">
			<div class="row justify-content-center">
				<div class="col-md-12"> <?php include("alerts/success.php"); ?> </div>
					<div class="col-md-6 text-center">
						<h3>Comentarios</h3>
					</div>
					<div class="col-md-12 mb-3"></div>
		<?php if( isset($comments) && !empty($comments) ) {
					foreach( $comments as $comment ) { ?>
						<div class="col-md-6">
							<p class="mb-1">
								<i class="far fa-clock"></i>
								<strong class="text-capitalize">
									<?php
										setlocale(LC_ALL,"es_ES");
										$splitted = explode(" ", $comment["created_at"]);
										echo strftime( "%a %d %b %Y", strtotime("$splitted[0]") );
									?>
								</strong> -
								<span class="text-info"><?php echo $splitted[1]; ?></span>
								<br class="d-block d-md-none">
								<strong>por</strong> <i class="far fa-user"></i>
								<?php echo $comment["name"]; ?>
							</p>

							<p>
								<?php echo $comment["comment"]; ?>
							</p>
							<hr>
						</div>
						<div class="col-md-12 mb-3"></div>
		<?php }
				} else {
					echo "<div class='col-md-12 mb-3 mb-md-5 text-center'>No hay comentarios para esta entrada.</div>";
				} ?>
				<div class="col-md-12 mb-3">
					<div class="row justify-content-center">
						<div class="col-md-6">
							<form action="<?php echo $path; ?>php/db/requests.php" method="POST">
							<input type="hidden" name="request" value="blog-entry">
							<input type="hidden" name="table" value="blog_comments">
								<?php $header = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
								<input type="hidden" name="header" value="<?php echo $header; ?>#section-comments">
								<input type="hidden" name="id_blog" value="<?php echo $ssblog[0]["id"]; ?>">
								<div class="form-group">
									<input type="email" class="form-control fc-custom" name="email" placeholder="E-MAIL:" required>
								</div>

								<div class="form-group">
									<input type="text" class="form-control fc-custom" name="name" placeholder="NOMBRE:" required>
								</div>

								<div class="form-group">
									<textarea name="comment" rows="5" class="form-control fc-custom" placeholder="MENSAJE" required></textarea>
								</div>

								<button class="btn btn-info btn-block" type="submit">ENVIAR</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php
			}
		}
	?>

	<?php include("widgets/frm-cont.php"); ?>
	<?php include("structure/footer.php"); ?>
	<script src="<?php echo $path; ?>assets/js/multilevel.js" async="async"></script>
	<script src="<?php echo $path; ?>assets/js/search.js"></script>
	<script src="<?php echo $path; ?>assets/js/landing-cover.js"></script>
	<script>
		$(document).ready(function() {
			var max = 0;
			$(".blog-preview-content").each(function(){
				var ws = $(window).width();

				if( ws>767 ) {
					var actual = $(this).height();

					if( actual>max )
						max=actual;
				}
			});

			var ws = $(window).width();

			if( ws>767 )
				$(".blog-preview-content").height(max)
		});
	</script>
</body>
</html>
