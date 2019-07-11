<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		$view_name="Blog";
		include("structure/head.php");

		// include('php/blog/core.php');
		// include('php/slug.lib.php');

		date_default_timezone_set('America/Mexico_City');
		$tabla = 'blogs';
		$mysqli = Connection::conectar_db();
		Connection::selecciona_db($mysqli);
		mysqli_query ($mysqli,"SET NAMES 'UTF8';");

		$root = Blog::blogUrl();
		// dd( $root );

		if( $root=="root" ) {
			$blogs = Blog::all();
			// dd( "HOA" );
			// dd( $blogs );
		} else {
			$sblog = $root;
		}
	?>
	<link rel="stylesheet" type="text/css" href="<?php echo $path; ?>assets/css/multilevel.css">
</head>
<body>
	<?php $active="blog"; include("structure/navbar.php"); ?>


	<?php if( $root=="root" ) { ?>
		<section class="container-custom pt-60 pb-60">
			<div class="row">
				<div class="col-md-12 mb-3 mb-md-4 text-center"> <h1><strong>Nuestro Blog</strong></h1> </div>

				<?php foreach( $blogs as $blog ) { ?>
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-12">
								<img class="img-fluid d-block" src="<?php echo $path; ?>uploads/<?php echo $blog['img']; ?>" alt="<?php echo $blog['img_alt'] ?>">
							</div>

							<div class="col-md-12 mt-60 mb-3 mb-md-5">
								<div class="row">
									<div class="col-md-12">
										<h3 class="bolder text-uppercase"><?php echo $blog["name"]; ?></h3>
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
											if( isset($blog["category"]) && !empty($blog["category"]) )
												$url .= $blog["category"]."/";

											if( isset($blog["subcategory"]) && !empty($blog["subcategory"]) )
												$url .= $blog["subcategory"]."/";

											$url .= Blog::slugger($blog["name"]);
										?>
										<a href="<?php echo $url; ?>" class="btn btn-success btn-block mt-4 text-white">LEER COMPLETO</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</section>
	<?php } else { ?>
		<section class="container-fluid">
			<?php if( isset($sblog['cover']) ) { ?>
				<div class="row relativer bg-container bg-mh bg-widget-cover appear" style="background-image: url('<?php echo $path; ?>uploads/<?php echo $sblog['cover'] ?>')"> </div>
			<?php } else { ?>
				<div class="row relativer bg-container bg-mh bg-widget-cover appear" style="background-image: url('http://placehold.it/1920x1080.png?text=1920x1080.jpg');"> </div>
			<?php } ?>
		</section>

		<section class="py-60">
			<div class="container-custom">
				<div class="row justify-content-center">
					<div class="col-md-12 text-center mb-45">
						<h1 class="mb-3"><strong><?php echo $sblog["name"] ?></strong></h1>
						<h4> <em>por <?php echo $sblog["author"] ?></em> </h4>
					</div>
					<div class="col-md-10">
						<?php if( isset($sblog['video']) ) { ?>
							<div class="play-container blog-play-container">
								<img class="play-ico" src="<?php echo $path; ?>assets/img/play-13.svg" alt="PlayIco">
								<img class="custom-thumbnail img-fluid d-block m-auto" src="<?php echo $path; ?>uploads/<?php echo $sblog['img'] ?>" alt="<?php echo $sblog['img_alt'] ?>">
								<div class="embed-responsive embed-responsive-16by9 d-none">
									<iframe id="emb-iframe" class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $sblog['video']; ?>" allowfullscreen></iframe>
								</div>
							</div>
						<?php } else { ?>
							<img class="img-fluid d-block m-auto" src="<?php echo $path; ?>uploads/<?php echo $sblog['img'] ?>" alt="<?php echo $sblog['img_alt'] ?>">
						<?php } ?>

						<p class="mb-3"></p>
						<?php echo $sblog["body"]; ?>

						<div class="row justify-content-center mt-60">
							<div class="col-md-4">
								<a href="<?php echo $path;?>blog" class="btn btn-success d-block">VOLVER</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php } ?>

	<?php
		if( $root!="root" ) {
			if( isset($sblog["name"]) ) {
				$id = $sblog["id"];
				$comments = Blog::getComments($mysqli,$id); ?>
		<section id="section-comments" class="container-custom pb-60">
			<div class="row justify-content-center">
				<div class="col-md-12"> <?php include("alerts/success.php"); ?> </div>
					<div class="col-md-6 text-center">
						<h3>Comentarios</h3>
					</div>
					<div class="col-md-12 mb-3"></div>

					<?php if( isset($comments) && !empty($comments) ) { ?>
					<?php foreach( $comments as $comment ) { ?>
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
					<?php } // ./endforeach ?>
					<?php } else { ?>
						<div class="col-md-12 mb-3 mb-md-5 text-center">No hay comentarios para esta entrada.</div>
					<?php } // /.endif ?>

					<div class="col-md-12 mb-3">
						<div class="row justify-content-center">
							<div class="col-md-6">
								<form action="<?php echo $path; ?>php/db/requests.php" method="POST">
								<input type="hidden" name="request" value="blog-entry">
								<input type="hidden" name="table" value="blog_comments">
									<?php $header = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
									<input type="hidden" name="header" value="<?php echo $header; ?>#section-comments">
									<input type="hidden" name="id_blog" value="<?php echo $sblog["id"]; ?>">
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
