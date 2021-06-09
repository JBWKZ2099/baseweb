<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
  <div class="sb-sidenav-menu">
    <div class="nav">

      <a class="nav-link" href="<?php echo $env->APP_URL_ADMIN; ?>">
        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
        Dashboard
      </a>

      <div class="sb-sidenav-menu-heading">Blogs</div>
      <?php if( Auth::user()->permission_admin==1 && (Auth::user()->permission_blogs_c==1 || Auth::user()->permission_blogs_r==1 || Auth::user()->permission_blogs_u==1 || Auth::user()->permission_blogs_d==1) ) { $word_menu = "Blog"; ?>
        <a class="nav-link <?php if( $active_menu=="blog_mn" ) echo "active"; else echo "collapsed"; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseBlogs" aria-expanded="false" aria-controls="collapseBlogs">
          <div class="sb-nav-link-icon"><i class="fas fa-rss"></i></div>
          <?php echo $word_menu; ?>s</span>
          <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse <?php if( $collapse=="blog" ) echo "show"; else echo ""; ?>" id="collapseBlogs" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav">
            <?php if( Auth::user()->permission_blogs_r==1 ) { ?>
              <a class="nav-link <?php if( $active_opt=="blog-view" ) echo "active"; ?>" href="<?php echo $env->APP_URL_ADMIN; ?>blogs">Lista de <?php echo $word_menu; ?>s</a>
            <?php } ?>
            <?php if( Auth::user()->permission_blogs_c==1 ) { ?>
              <a class="nav-link <?php if( $active_opt=="blog-create" ) echo "active"; ?>" href="<?php echo $env->APP_URL_ADMIN; ?>blogs-create">Agregar <?php echo $word_menu; ?></a>
            <?php } ?>
            <?php if( Auth::user()->permission_blogs_d==1 ) { ?>
              <a class="nav-link <?php if( $active_opt=="blog-deleted" ) echo "active"; ?>" href="<?php echo $env->APP_URL_ADMIN; ?>blogs-deleted"><?php echo $word_menu; ?>s Eliminados</a>
            <?php } ?>
          </nav>
        </div>
      <?php } ?>

      <?php if( Auth::user()->permission_admin==1  && (Auth::user()->permission_categories_c==1 || Auth::user()->permission_categories_r==1 || Auth::user()->permission_categories_u==1 || Auth::user()->permission_categories_d==1) ) { $word_menu = "Categoría"; ?>
        <a class="nav-link <?php if( $active_menu=="category_mn" ) echo "active"; else echo "collapsed"; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseBlogCats" aria-expanded="false" aria-controls="collapseBlogCats">
          <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
          Blogs - <?php echo $word_menu; ?>s</span>
          <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse <?php if( $collapse=="category" ) echo "show"; else echo ""; ?>" id="collapseBlogCats" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav">
            <?php if( Auth::user()->permission_categories_r==1 ) { ?>
              <a class="nav-link <?php if( $active_opt=="category-view" ) echo "active"; ?>" href="<?php echo $env->APP_URL_ADMIN; ?>categories">Lista de <?php echo $word_menu; ?>s</a>
            <?php } ?>
            <?php if( Auth::user()->permission_categories_c==1 ) { ?>
              <a class="nav-link <?php if( $active_opt=="category-create" ) echo "active"; ?>" href="<?php echo $env->APP_URL_ADMIN; ?>categories-create">Agregar <?php echo $word_menu; ?></a>
            <?php } ?>
            <?php if( Auth::user()->permission_categories_d==1 ) { ?>
              <a class="nav-link <?php if( $active_opt=="category-deleted" ) echo "active"; ?>" href="<?php echo $env->APP_URL_ADMIN; ?>categories-deleted"><?php echo $word_menu; ?>s Eliminadas</a>
            <?php } ?>
          </nav>
        </div>
      <?php } ?>

      <?php if( Auth::user()->permission_admin==1  && (Auth::user()->permission_subcategories_c==1 || Auth::user()->permission_subcategories_r==1 || Auth::user()->permission_subcategories_u==1 || Auth::user()->permission_subcategories_d==1) ) { $word_menu = "Subategoría"; ?>
        <a class="nav-link <?php if( $active_menu=="subcategory_mn" ) echo "active"; else echo "collapsed"; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseBlogSubCats" aria-expanded="false" aria-controls="collapseBlogSubCats">
          <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
          Blogs - <?php echo $word_menu; ?>s</span>
          <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse <?php if( $collapse=="subcategory" ) echo "show"; else echo ""; ?>" id="collapseBlogSubCats" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav">
            <?php if( Auth::user()->permission_subcategories_r==1 ) { ?>
              <a class="nav-link <?php if( $active_opt=="subcategory-view" ) echo "active"; ?>" href="<?php echo $env->APP_URL_ADMIN; ?>subcategories">Lista de <?php echo $word_menu; ?>s</a>
            <?php } ?>
            <?php if( Auth::user()->permission_subcategories_c==1 ) { ?>
              <a class="nav-link <?php if( $active_opt=="subcategory-create" ) echo "active"; ?>" href="<?php echo $env->APP_URL_ADMIN; ?>subcategories-create">Agregar <?php echo $word_menu; ?></a>
            <?php } ?>
            <?php if( Auth::user()->permission_subcategories_d==1 ) { ?>
              <a class="nav-link <?php if( $active_opt=="subcategory-deleted" ) echo "active"; ?>" href="<?php echo $env->APP_URL_ADMIN; ?>subcategories-deleted"><?php echo $word_menu; ?>s Eliminadas</a>
            <?php } ?>
          </nav>
        </div>
      <?php } ?>

      <div class="sb-sidenav-menu-heading">Administración</div>

      <?php if( Auth::user()->permission_admin==1 && (Auth::user()->permission_users_c==1 || Auth::user()->permission_users_r==1 || Auth::user()->permission_users_u==1 || Auth::user()->permission_users_d==1) ) { $word_menu = "Usuario"; ?>
        <a class="nav-link <?php if( $active_menu=="customer_mn" ) echo "active"; else echo "collapsed"; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUsers" aria-expanded="false" aria-controls="collapseUsers">
          <div class="sb-nav-link-icon"><i class="fas fa-user-cog"></i></div>
          <?php echo $word_menu; ?>s</span>
          <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse <?php if( $collapse=="customer" ) echo "show"; else echo ""; ?>" id="collapseUsers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav">
            <?php if( Auth::user()->permission_subcategories_r==1 ) { ?>
              <a class="nav-link <?php if( $active_opt=="customer-view" ) echo "active"; ?>" href="<?php echo $env->APP_URL_ADMIN; ?>customers">Lista de <?php echo $word_menu; ?>s</a>
            <?php } ?>
            <?php if( Auth::user()->permission_subcategories_c==1 ) { ?>
              <a class="nav-link <?php if( $active_opt=="customer-create" ) echo "active"; ?>" href="<?php echo $env->APP_URL_ADMIN; ?>customers-create">Agregar <?php echo $word_menu; ?></a>
            <?php } ?>
            <?php if( Auth::user()->permission_subcategories_d==1 ) { ?>
              <a class="nav-link <?php if( $active_opt=="customer-deleted" ) echo "active"; ?>" href="<?php echo $env->APP_URL_ADMIN; ?>customers-deleted"><?php echo $word_menu; ?>s Eliminados</a>
            <?php } ?>
          </nav>
        </div>
      <?php } ?>

      <?php if( Auth::user()->permission_admin==1 && (Auth::user()->permission_contacts_r==1) ) { $word_menu = "Lista de contactos"; ?>
        <a class="nav-link <?php if( $active_menu=="contact_mn" ) echo "active"; ?>" href="<?php echo $env->APP_URL_ADMIN; ?>contacts">
          <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>
          <?php echo $word_menu; ?></span>
        </a>
      <?php } ?>

      <?php /*
      <!-- Ejemplo de como poner un enlace sencillo -->
      <a class="nav-link" href="index.html">
        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
        Dashboard
      </a>
      */ ?>
    </div>
  </div>
  <div class="sb-sidenav-footer">
    <div class="small">Conectado como:</div>
    <?php
      echo Auth::user()->name." ".Auth::user()->last_name;
    ?>
  </div>
</nav>