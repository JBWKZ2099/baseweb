<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
  <?php /*
    <li class="nav-item <?php if( $active_menu=="charts_mn" ) echo "active"; ?>" data-toggle="tooltip" data-placement="right" title="Histórico">
      <a class="nav-link nav-link-collapse <?php if( $active_menu=="charts_mn" ) echo ""; else echo "collapsed"; ?>" data-toggle="collapse" href="#graphsCollapse" data-parent="#exampleAccordion">
        <i class="fa fa-fw fa-area-chart"></i>
        <span class="nav-link-text">
          Gráficas</span>
      </a>
      <ul class="sidenav-second-level collapse <?php if( $collapse=="charts" ) echo "show"; ?>" id="graphsCollapse">
        <li <?php if( $active_opt=="charts" ) echo "class='active'"; ?>>
          <a href="charts">Ver</a>
        </li>
        <?php if( Auth::user()->permission_admin==1 ) { ?>
          <li <?php if( $active_opt=="charts-create" ) echo "class='active'"; ?>>
            <a href="<?php echo $env->APP_URL_ADMIN; ?>charts-create">Crear / Actualizar</a>
          </li>
          <li <?php if( $active_opt=="charts-update" ) echo "class='active'"; ?>>
            <a href="<?php echo $env->APP_URL_ADMIN; ?>charts-update">Actualizar títulos</a>
          </li>
        <?php } ?>
      </ul>
    </li>
    <li class="nav-item <?php if( $active_menu=="historic_mn" ) echo "active"; ?>" data-toggle="tooltip" data-placement="right" title="Histórico">
      <a class="nav-link nav-link-collapse <?php if( $active_menu=="historic_mn" ) echo ""; else echo "collapsed"; ?>" data-toggle="collapse" href="#historyCollapse" data-parent="#exampleAccordion">
        <i class="fa fa-fw fa-file-pdf-o"></i>
        <span class="nav-link-text">
          Histórico</span>
      </a>
      <ul class="sidenav-second-level collapse <?php if( $collapse=="historic" ) echo "show"; ?>" id="historyCollapse">
        <li <?php if( $active_opt=="historic-view" ) echo "class='active'"; ?>>
          <a href="<?php echo $env->APP_URL_ADMIN; ?>historics">Lista de Históricos</a>
        </li>
        <?php if( Auth::user()->permission_admin==1 ) { ?>
          <li <?php if( $active_opt=="historic-create" ) echo "class='active'"; ?>>
            <a href="<?php echo $env->APP_URL_ADMIN; ?>historics-create">Agregar Histórico</a>
          </li>
          <li <?php if( $active_opt=="historic-deleted" ) echo "class='active'"; ?>>
            <a href="<?php echo $env->APP_URL_ADMIN; ?>historics-deleted">Históricos Eliminados</a>
          </li>
        <?php } ?>
      </ul>
    </li>
  */ ?>
  <?php if( Auth::user()->permission_admin==1 && (Auth::user()->permission_blogs_c==1 || Auth::user()->permission_blogs_r==1 || Auth::user()->permission_blogs_u==1 || Auth::user()->permission_blogs_d==1) ) { $word_menu = "Blog"; ?>
    <li class="nav-item <?php if( $active_menu=="blog_mn" ) echo "active"; ?>" data-toggle="tooltip" data-placement="right" title="Usuarios">
      <a class="nav-link nav-link-collapse <?php if( $active_menu=="blog_mn" ) echo ""; else echo "collapsed"; ?>" data-toggle="collapse" href="#blogCollapse" data-parent="#exampleAccordion">
        <i class="fa fa-fw fa-rss-square"></i>
        <span class="nav-link-text">
          <?php echo $word_menu; ?>s</span>
      </a>
      <ul class="sidenav-second-level collapse <?php if( $collapse=="blog" ) echo "show"; ?>" id="blogCollapse">
        <?php if( Auth::user()->permission_blogs_r==1 ) { ?>
          <li <?php if( $active_opt=="blog-view" ) echo "class='active'"; ?>>
            <a href="<?php echo $env->APP_URL_ADMIN; ?>blogs">Lista de <?php echo $word_menu; ?>s</a>
          </li>
        <?php } ?>
        <?php if( Auth::user()->permission_blogs_c==1 ) { ?>
          <li <?php if( $active_opt=="blog-create" ) echo "class='active'"; ?>>
            <a href="<?php echo $env->APP_URL_ADMIN; ?>blogs-create">Agregar <?php echo $word_menu; ?></a>
          </li>
        <?php } ?>
        <?php if( Auth::user()->permission_blogs_d==1 ) { ?>
          <li <?php if( $active_opt=="blog-deleted" ) echo "class='active'"; ?>>
            <a href="<?php echo $env->APP_URL_ADMIN; ?>blogs-deleted"><?php echo $word_menu; ?>s Eliminados</a>
          </li>
        <?php } ?>
      </ul>
    </li>
  <?php } ?>
  <?php if( Auth::user()->permission_admin==1  && (Auth::user()->permission_categories_c==1 || Auth::user()->permission_categories_r==1 || Auth::user()->permission_categories_u==1 || Auth::user()->permission_categories_d==1) ) { $word_menu = "Categoría"; ?>
    <li class="nav-item <?php if( $active_menu=="category_mn" ) echo "active"; ?>" data-toggle="tooltip" data-placement="right" title="categories">
      <a class="nav-link nav-link-collapse <?php if( $active_menu=="category_mn" ) echo ""; else echo "collapsed"; ?>" data-toggle="collapse" href="#categoryCollapse" data-parent="#exampleAccordion">
        <i class="fa fa-fw fa-file-text"></i>
        <span class="nav-link-text">
          Blogs - <?php echo $word_menu; ?>s</span>
      </a>
      <ul class="sidenav-second-level collapse <?php if( $collapse=="category" ) echo "show"; ?>" id="categoryCollapse">
        <?php if( Auth::user()->permission_categories_r==1 ) { ?>
          <li <?php if( $active_opt=="category-view" ) echo "class='active'"; ?>>
            <a href="<?php echo $env->APP_URL_ADMIN; ?>categories">Lista de <?php echo $word_menu; ?>s</a>
          </li>
        <?php } ?>
        <?php if( Auth::user()->permission_categories_c==1 ) { ?>
          <li <?php if( $active_opt=="category-create" ) echo "class='active'"; ?>>
            <a href="<?php echo $env->APP_URL_ADMIN; ?>categories-create">Agregar <?php echo $word_menu; ?></a>
          </li>
        <?php } ?>
        <?php if( Auth::user()->permission_categories_d==1 ) { ?>
          <li <?php if( $active_opt=="category-deleted" ) echo "class='active'"; ?>>
            <a href="<?php echo $env->APP_URL_ADMIN; ?>categories-deleted"><?php echo $word_menu; ?>s Eliminadas</a>
          </li>
        <?php } ?>
      </ul>
    </li>
  <?php } ?>
  <?php if( Auth::user()->permission_admin==1  && (Auth::user()->permission_subcategories_c==1 || Auth::user()->permission_subcategories_r==1 || Auth::user()->permission_subcategories_u==1 || Auth::user()->permission_subcategories_d==1) ) { $word_menu = "Subategoría"; ?>
    <li class="nav-item <?php if( $active_menu=="subcategory_mn" ) echo "active"; ?>" data-toggle="tooltip" data-placement="right" title="subcategories">
      <a class="nav-link nav-link-collapse <?php if( $active_menu=="subcategory_mn" ) echo ""; else echo "collapsed"; ?>" data-toggle="collapse" href="#subcategoryCollapse" data-parent="#exampleAccordion">
        <i class="fa fa-fw fa-file-text"></i>
        <span class="nav-link-text">
          Blogs - <?php echo $word_menu ?>s</span>
      </a>
      <ul class="sidenav-second-level collapse <?php if( $collapse=="subcategory" ) echo "show"; ?>" id="subcategoryCollapse">
        <?php if( Auth::user()->permission_subcategories_r==1 ) { ?>
          <li <?php if( $active_opt=="subcategory-view" ) echo "class='active'"; ?>>
            <a href="<?php echo $env->APP_URL_ADMIN; ?>subcategories">Lista de <?php echo $word_menu ?>s</a>
          </li>
        <?php } ?>
        <?php if( Auth::user()->permission_subcategories_c==1 ) { ?>
          <li <?php if( $active_opt=="subcategory-create" ) echo "class='active'"; ?>>
            <a href="<?php echo $env->APP_URL_ADMIN; ?>subcategories-create">Agregar <?php echo $word_menu ?></a>
          </li>
        <?php } ?>
        <?php if( Auth::user()->permission_subcategories_d==1 ) { ?>
          <li <?php if( $active_opt=="subcategory-deleted" ) echo "class='active'"; ?>>
            <a href="<?php echo $env->APP_URL_ADMIN; ?>subcategories-deleted"><?php echo $word_menu ?>s Eliminadas</a>
          </li>
        <?php } ?>
      </ul>
    </li>
  <?php } ?>
  <?php if( Auth::user()->permission_admin==1 && (Auth::user()->permission_users_c==1 || Auth::user()->permission_users_r==1 || Auth::user()->permission_users_u==1 || Auth::user()->permission_users_d==1) ) { $word_menu = "Usuario"; ?>
    <li class="nav-item <?php if( $active_menu=="customer_mn" ) echo "active"; ?>" data-toggle="tooltip" data-placement="right" title="Usuarios">
      <a class="nav-link nav-link-collapse <?php if( $active_menu=="customer_mn" ) echo ""; else echo "collapsed"; ?>" data-toggle="collapse" href="#customerCollapse" data-parent="#exampleAccordion">
        <i class="fa fa-fw fa-user-circle"></i>
        <span class="nav-link-text">
          <?php echo $word_menu; ?>s</span>
      </a>
      <ul class="sidenav-second-level collapse <?php if( $collapse=="customer" ) echo "show"; ?>" id="customerCollapse">
        <?php if( Auth::user()->permission_users_r==1 ) { ?>
          <li <?php if( $active_opt=="customer-view" ) echo "class='active'"; ?>>
            <a href="<?php echo $env->APP_URL_ADMIN; ?>customers">Lista de <?php echo $word_menu; ?>s</a>
          </li>
        <?php } ?>
        <?php if( Auth::user()->permission_users_c==1 ) { ?>
          <li <?php if( $active_opt=="customer-create" ) echo "class='active'"; ?>>
            <a href="<?php echo $env->APP_URL_ADMIN; ?>customers-create">Agregar <?php echo $word_menu; ?></a>
          </li>
        <?php } ?>
        <?php if( Auth::user()->permission_users_d==1 ) { ?>
          <li <?php if( $active_opt=="customer-deleted" ) echo "class='active'"; ?>>
            <a href="<?php echo $env->APP_URL_ADMIN; ?>customers-deleted"><?php echo $word_menu; ?>s Eliminados</a>
          </li>
        <?php } ?>
      </ul>
    </li>
  <?php } ?>
</ul>
