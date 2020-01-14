<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		$view_name="Blog";
		include("structure/head.php");

		 //include('php/blog/core.php');
	   //include('php/slug.lib.php');

		date_default_timezone_set('America/Mexico_City');
 		$tabla = 'blogs';
 		$mysqli = Connection::conectar_db();
 		Connection::selecciona_db($mysqli);
 		mysqli_query ($mysqli,"SET NAMES 'UTF8';");
		$page = ( isset($_GET["page"]) && !empty($_GET["page"]) ) ? $_GET["page"] : 1;
 		$sql = "SELECT * FROM $tabla WHERE status = 1 AND deleted_at IS NULL";
 		$result = DB::consulta_tb($mysqli,$sql);

		$arr_blg = array();
		while( $row = mysqli_fetch_array($result,MYSQLI_ASSOC) ) {
			$arr_blg[] = array(
				"id" => $row["id"],
				"name" => $row["name"],
				"body" => $row["body"],
				"img" => $row["img"],
				"cover" => $row["cover"],
				"category_1" => $row["category_1"],
				"category_2" => $row["category_2"],
				"category_3" => $row["category_3"],
				"category_4" => $row["category_4"],
				"created_at" => $row["created_at"],
				"updated_at" => $row["updated_at"],
				"deleted_at" => $row["deleted_at"],
				"status" => $row["status"],
				"slug_name" => $row["slug_name"],
			);
		}

		$arr_blg = array_chunk($arr_blg, 10);
		$pages = count( $arr_blg );

		// foreach( $arr_blg[$page-1] as $key => $row ) {
		// 	dd( $row );
		// }
		// dd( $arr_blg );
		// dd( $page );
 		// $consulta ="SELECT * FROM $tabla WHERE id = $row ['id']";
 	  //$consulta ="SELECT * FROM $tabla";
 		//$resulta = DB::consulta_tb($mysqli,$consulta);

	    $root = Blog::blogUrl();
			if( $root=="root" ) {
				$blogs = Blog::all();
				// dd( "HOA" );
				// dd( $blogs );
			} else {
				$sblog = $root;
				include('php/slug.lib.php');
				$blog_path = substr($path, 0, -1);
				$current_blog = $blog_path.$_SERVER['REQUEST_URI'];
				$which_blog = slugger(explode("blog/", $current_blog)[1]);
				$consulta ="SELECT * FROM $tabla WHERE slug_name= '$which_blog'";

				$resulta = DB::consulta_tb($mysqli,$consulta);
				$rwd = mysqli_fetch_array($resulta,MYSQLI_ASSOC);

			}
		?>

		<link rel="stylesheet" type="text/css" href="<?php echo $path; ?>assets/css/multilevel.css">
</head>
<body>
	<?php $active="blog"; include("structure/navbar.php"); ?>

	<?php if( $root=="root" ) { ?>
		<section class="container-custom pt-60 pb-60">
			<div class="row">
				<div class="col-md-12 mb-3 mb-md-4 text-center"><h1><strong>Nuestros Blogs</strong></h1></div>

				<?php foreach( $arr_blg[$page-1] as $key => $row ) { //dd( $row ); ?>

				<?php // dd( $row[$page-1] ); /* while( $row = mysqli_fetch_array($result,MYSQLI_ASSOC)){ */ ?>
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-12">
								<img class="img-fluid d-block" src="<?php echo $path; ?>uploads/<?php echo $row['img']; ?>">
							</div>
							<div class="col-md-12 mt-60 mb-3 mb-md-5">
								<div class="row">
									<div class="col-md-12">
										<h3 class="bolder text-uppercase"><?php echo $row['name']; ?></h3>
									</div>

									<div class="col-md-12 blog-preview-content">
										<div class="row no-gutters align-items-center h-100">
											<div class="col-md-12">
												<div class="mt-3 mb-3 text-lgray">
													<?php
														if( strlen($row["body"])>255 )
															echo substr($row["body"], 0, 255)."...";
														else
															echo $row["body"];
													?>
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-12">
										<?php
											$url = $path."blog/";
											$url .= Blog::slugger($row["name"]);
										?>
										<a href="<?php echo $url; ?>" class="btn btn-success btn-block mt-4 text-white">LEER COMPLETO</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>

				<?php if( $pages>1 ) { ?>
					<div class="col-md-12 mt-3 mt-md-5">
						<ul class="pagination pagination-green justify-content-center">
							<li class="page-item"><a class="page-link" href="<?php if($page>1) echo "?page=".($_GET["page"]-1); else echo "#"; ?>">Anterior</a></li>
							<?php for( $i=1; $i<=$pages; $i++ ) { ?>
								<li class="page-item <?php if( $_GET["page"]==$i || $page==$i ) echo 'active' ?>">
									<a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
								</li>
							<?php } ?>
							<li class="page-item"><a class="page-link" href="<?php if( isset($_GET["page"]) ) { if( $_GET["page"]==$pages ) echo "#"; else echo "?page=".($page+1); } else {if( $page==$pages ) echo "#"; else echo "?page=".($page+1); } ?>">Siguiente</a></li>
						</ul>
					</div>
				<?php } ?>
			</div>
		</section>
 <?php } else {?>
	 <section class="container-fluid">
		 <?php if( isset($rwd['cover']) ) { ?>
			 <div class="row relativer bg-container bg-mh bg-widget-cover appear" style="background-image: url('<?php echo $path; ?>uploads/<?php echo $rwd['cover'] ?>')"> </div>
		 <?php } ?>
	 </section>

	 <section class="py-60">
 		<div class="container-custom">
 			<div class="row justify-content-center">
 				<div class="col-md-12 text-center mb-45">
 					<h1 class="mb-3"><strong><?php echo $rwd['name'] ?></strong></h1>
 				</div>
 				<div class="col-md-10">
 						<div class="blog-play-container">
 							<img class="img-fluid d-block m-auto" src="<?php echo $path; ?>uploads/<?php echo $rwd['img'] ?>">
 						</div>


 					<p class="mb-3"><?php echo $rwd['body']; ?></p>


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
			if( isset($rwd["name"]) ) {
				$id = $rwd["id"];
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
											<input type="hidden" name="id_blog" value="<?php echo $rwd["id"]; ?>">
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
