<?php /*<h1 class="mt-4"><?php echo end($breadcrumb)["word"]; ?></h1>*/ ?>
<nav class="my-3 my-md-4" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <?php foreach( $breadcrumb as $key => $item ) { ?>
      <li class="breadcrumb-item <?php echo $key==0 ? "active" : "" ?>">
        <?php if( $key<( count($breadcrumb)-1 ) ) { ?>
          <a href="<?php echo substr($env->APP_URL_ADMIN, 0, -1).$item["link"] ?>">
        <?php } ?>
          <?php echo $item["word"]; ?>
        <?php if( $key<( count($breadcrumb)-1 ) ) { ?>
          </a>
        <?php } ?>
      </li>
    <?php } ?>
  </ol>
</nav>