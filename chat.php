<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		$view_name="Inicio";
		include("structure/head.php");
		$asset = "assets/img/folder_name/"; // Path where are storaged media files (img, video, etc)


		// if(session_status()==="") session_start();
		// logout();
		// unset( $_SESSION );
		// $pswd_ed = "Stratega2020*";
		// $pswd_encrypted = Auth::cryptBlowfish($pswd_ed);
		// dd( $pswd_ed, $pswd_encrypted );

		$_page = isset($_GET["page"]) && !empty($_GET["page"]) ? "".$_GET["page"]."" : "0";
		$page = $_page==0 ? "1" : $_page;

		ini_set("memory_limit","1G");
		$getcont = file_get_contents("./messages.json");
		$json = json_decode($getcont, true)["conversations"];
		$ara = [];

		foreach( $json as $key => $msg ) {
			if( $msg["displayName"]=="Ara GR" ) {
				$ara = $msg["MessageList"];
				// dd( $msg["MessageList"] );
				// dd("Alto ahí prro");
			}
		}

		/*El ultimoo revisado 2019-06-07 16:46:26*/
		krsort($ara);
		// $chunked = array_chunk($ara, 50);
		$chunked = array_chunk($ara, 1800);

		// dd( count($chunked) );
	?>

	<style>
		.text-white * { color: #FFF; }
	</style>
</head>
<body>
	<section class="container-custom">
		<div class="row">
			<div class="col-md-12 chat-container">

				<div class="row justify-content-center">
					<div class="col-md-6">
						<div class="row">

							<?php foreach( $chunked as $key => $msg ): ?>
								<?php if($key==0): ?>
									<?php foreach( $msg as $_key => $itm ): ?>
										<div class="col-md-10 message-container <?php echo ( $itm["from"]!="8:jbwkz2099"?: "ml-auto text-right" ); ?> mb-3">
											<p class='font-weight-bold mb-2'>
												<?php echo $itm["from"]!="8:jbwkz2099"? $itm["from"].":" : ""; ?>

												<?php
													$date = explode("T", $itm["originalarrivaltime"])[0];
													$time = explode(".", explode("T", $itm["originalarrivaltime"])[1])[0];
												?>
												<span class="text-muted"><small><?php echo $date." ".$time; ?></small></span>
											</p>

											<div class="<?php echo ( $itm["from"]!="8:jbwkz2099" ? "bg-default" : "text-white bg-info" ) ?> p-3 rounded-sm">
												<p><?php echo $itm["content"]; ?></p>
											</div>
										</div>
									<?php endforeach; ?>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>
