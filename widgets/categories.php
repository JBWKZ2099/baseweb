<div class="row justify-content-center">
	<div class="col-md-12 col-lg-8">
		<?php
			$exccom = categories_list($mysqli);
			$atm = blogs_list($mysqli,2);
			$cap = blogs_list($mysqli,3);
			// dd( $exccom );
			// var_dump($exccom);

			$categories = categories_list($mysqli);
			// dd( $categories );
		?>
		<ul class="nav nav-fill custom-dropdown">
		  <li class="nav-item dropdown">
		    <a class="nav-link dropdown-toggle text-gray-dark" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><span class="h3"><strong>EXCCOM</strong></span></a>
		    <div class="dropdown-menu dropdown">
		    	<?php if( isset($exccom) && !empty($exccom) ) { ?>
			    	<?php foreach( $exccom as $_vblog ) { ?>
			    		<?php
								$url = $path."blog/".$_vblog["slug"];
							?>

		    			<?php
		    				$blogs_from_cat = blogs_from_cat($mysqli, $_vblog["id"]);
		    				if( isset($blogs_from_cat) && !empty($blogs_from_cat) ) { ?>
				    			<a class="nav-link dropdown-toggle text-white" data-toggle="dropdown" href="<?php echo $url; ?>" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_vblog["name"]; ?></a>
					    			<div class="dropdown-menu dropdown-child">
					    				<?php foreach( $blogs_from_cat as $ind_blog ) { ?>
					    					<a class="dropdown-item" href="<?php echo $path."blog/".$_vblog["slug"]."/".$ind_blog["slug"]; ?>"><?php echo $ind_blog["name"]; ?></a>
					    				<?php } ?>
					    			</div>
		    			<?php } else { ?>
		    				<a href="<?php echo $url; ?>" class="dropdown-item pl-3 pr-3 text-white">
		    					<?php echo $_vblog["name"]; ?>
		    				</a>
		    			<?php } ?>
			    	<?php } ?>
			    <?php } else { ?>
			    	<span class="pl-3 text-white">No hay blogs</span>
			    <?php } ?>
		    </div>
		  </li>
		  <li class="nav-item dropdown">
		    <a class="nav-link dropdown-toggle text-gray-dark" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><span class="h3"><strong>ATM</strong></span></a>
		    <div class="dropdown-menu">
		    	<?php if( isset($atm) && !empty($atm) ) { ?>
			    	<?php foreach( $atm as $_vblog ) { ?>
			    		<?php
								$url = $path."blog/atm/".slugger($_vblog["name"]);
							?>

			    		<a href="<?php echo $url; ?>" class="dropdown-item text-white pl-3"><?php echo $_vblog["name"]; ?></a>
			    	<?php } ?>
			    <?php } else { ?>
			    	<span class="pl-3 text-white">No hay blogs</span>
			    <?php } ?>
		    </div>
		  </li>
		  <li class="nav-item dropdown">
		    <a class="nav-link dropdown-toggle text-gray-dark" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><span class="h3"><strong>CAPACITACIÓN</strong></span></a>
		    <div class="dropdown-menu">
		    	<?php if( isset($cap) && !empty($cap) ) { ?>
			    	<?php foreach( $cap as $_vblog ) { ?>
			    		<?php
								$url = $path."blog/capacitacion/".slugger($_vblog["name"]);
							?>

			    		<a href="<?php echo $url; ?>" class="dropdown-item text-white pl-3"><?php echo $_vblog["name"]; ?></a>
			    	<?php } ?>
			    <?php } else { ?>
			    	<span class="pl-3 text-white">No hay blogs</span>
			    <?php } ?>
		    </div>
		  </li>
		</ul>
	</div>
</div>
