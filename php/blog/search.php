<?php
	include("../slug.lib.php");
	include("core.php");
	
	$path = (!empty($_SERVER['HTTPS']) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'];
  $path .= $_SERVER['HTTP_HOST'] == 'localhost:8888' ? '/fabricadesoluciones.com/' : '';
  $path .= "/";

	$mysqli = conectar_db();
  selecciona_db($mysqli);

	$word = $_POST['search'];
	// $word = "atm";
  $limit_1 = 4;

	if( empty($word) ) {
		$query = "SELECT COUNT(*) as num_rows FROM blogs WHERE status = 1";
		$res = mysqli_query($mysqli, $query);
    $total = mysqli_fetch_array($res)["num_rows"];
    mysqli_free_result($res);

    $total_pages = $total / $limit_1;
    $total_pages = ceil($total_pages);

    $limit_0 = ($page*$limit_1);

    $sql = "SELECT * FROM ".$tabla." WHERE status = '1' ";
    $sql .= "AND status = 1 ORDER BY created_at DESC LIMIT $limit_0,$limit_1";

    $query = mysqli_query($mysqli,$sql);
	}

  $sql = null;
	$sql = "SELECT * FROM blogs WHERE";
	$sql .= " name LIKE '%$word%'";
	$sql .= " OR author LIKE '%$word%'";
	$sql .= " OR meta LIKE '%$word%'";
	$sql .= " OR meta_keywords LIKE '%$word%'";
	$sql .= " OR body LIKE '%$word%'";

	if( strpos($word, "servicio") !== false )
		$sql .= " OR type = 1";
	if( strpos($word, "atm") !== false )
		$sql .= " OR type = 2";
	if( strpos($word, "capacitacion") !== false )
		$sql .= " OR type = 3";

	if( strpos($word, "casos de u") !== false )
		$sql .= " OR subcategory = 2";
	else if( strpos($word, "casos de e") !== false )
		$sql .= " OR subcategory = 3";
	else if( strpos($word, "casos") !== false )
		$sql .= " OR subcategory = 2 OR subcategory = 3";

	if( strpos($word, "conceptos") !== false )
		$sql .= " OR subcategory = 1";

	// Make pagination when there are no word to search
	$sql_count = "SELECT COUNT(*) AS num_rows FROM blogs WHERE status = 1 AND ".explode("WHERE", $sql)[1];
	$result = mysqli_query($mysqli,$sql_count);
	$total_sql_count = mysqli_fetch_array($result)["num_rows"];
  mysqli_free_result($result);
  $total_pages = $total_sql_count / $limit_1;
  $total_pages = ceil($total_pages);
  $limit_0 = ($page*$limit_1);

	$sql .= " AND status = 1 ORDER BY created_at DESC LIMIT $limit_0,$limit_1";
	// echo $sql;

	$result = mysqli_query($mysqli,$sql);
	$pedro = 0;
  $categories = categories_list($mysqli);
  foreach( $categories as $category ) {
      $cat_arr[$pedro] = $category["slug"];
      $pedro++;
  }
	while( $row = mysqli_fetch_array($result) ) {
    if( $row['category']==1 ) $_category = $cat_arr[0];
    if( $row['category']==2 ) $_category = $cat_arr[1];
    if( $row['category']==3 ) $_category = $cat_arr[2];
    if( $row['category']==4 ) $_category = $cat_arr[3];
    if( $row['category']==5 ) $_category = $cat_arr[4];
    if( $row['category']==6 ) $_category = $cat_arr[5];
    if( $row['category']==7 ) $_category = $cat_arr[6];
    if( $row['category']==8 ) $_category = $cat_arr[7];
    if( $row['category']==9 ) $_category = $cat_arr[8];
		$datos[] = array(
			'id' => $row['id'],
      'img' => $row['img'],
      'img_alt' => $row['img_alt'],
      'name' => $row['name'],
      'subname' => $row['subname'],
      'type' => $row["type"],
      'category' => $_category,
      'subcategory' => $_subcategory,
      'slug' => $row['slug'],
      'author' => $row['author'],
      'created_at' => $row['created_at'],
      'body' => $row['body'],
      'pages' => $total_pages,
		);
	}
	// var_dump($datos);
?>

<?php if( count($datos)>0 ) { ?>
	<div class="row align-items-center">
		<?php $b_counter = 0; ?>
		<?php foreach( $datos as $blog ) { ?>
			<?php if( $b_counter==0 ) { ?>
				<div class="col-md-7 text-center mt60 mb-3 mb-md-5">
					<div class="row justify-content-center">
						<div class="col-md-12">
							<img class="img-fluid d-block" src="<?php echo $path; ?>uploads/<?php echo $blog['img']; ?>" alt="<?php echo $blog['img_alt'] ?>">
						</div>
					</div>
				</div>
				<div class="col-md-5 mt60 mb-3 mb-md-5">
					<div class="row">
						<div class="col-md-12">
							<h3 class="bolder text-uppercase"><?php echo $blog["name"]; ?></h3>
							<p class="mt-3 mb-3 mb-md-5 text-lgray">
								<?php
									if( strlen($blog["body"])>900 )
										echo substr($blog["body"], 0, 900)."...";
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
				<div class="col-md-4 mb-3">
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
							<div class="mt-3 mb-3 mb-md-5 text-lgray">
								<?php
									if( strlen($blog["body"])>250 )
										echo substr($blog["body"], 0, 250)."...";
									else
										echo $blog["body"];
								?>
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

	<div id="section-paginate" class="col-md-12 mt-3 mt-md-5">
	  <ul class="pagination pagination-black justify-content-center">
	    <li class="page-item"><a class="page-link" href="<?php if($page>1) echo "blog?page=".($_GET["page"]-1); else echo "#"; ?>">Anterior</a></li>
	    <?php /*for( $i=1; $i<=$total_pages; $i++ ) {*/ ?>
			<?php
				if( isset($word) && !empty($word) )
					$add_var = "search=".$word."&";
				else
					$add_var = "";
			?>
	    <?php for( $i=1; $i<=$datos[0]["pages"]; $i++ ) { ?>
	    	<li class="page-item <?php if( $i==1 ) echo 'active' ?>">
	    		<a class="page-link" href="<?php echo "blog?".$add_var."page=".$i; ?>"><?php echo $i; ?></a>
	    	</li>
	    <?php } ?>
	    <li class="page-item"><a class="page-link" href="<?php if( isset($_GET["page"]) ) {if( $_GET["page"]==$blog["pages"] ) echo "#"; else echo "blog?".$add_var."page=".($page+1); } else echo "blog?".$add_var."page=".($page+1); ?>">Siguiente</a></li>
	  </ul>
	</div>
<?php } else { ?>
<div class="row justify-content-center">
	<div class="col-md-8 text-center pt60">
		<h3>No hay resultados con "<?php echo $word; ?>".</h3>
	</div>
</div>
<div class="row justify-content-center mt60">
	<div class="col-md-4">
		<a href="<?php echo $path; ?>/blog" class="btn btn-black d-block">VOLVER</a>
	</div>
</div>
<?php } ?>