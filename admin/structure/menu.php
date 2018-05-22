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
        <?php if( user()["permission"]==1 ) { ?>
          <li <?php if( $active_opt=="charts-create" ) echo "class='active'"; ?>>
            <a href="<?php echo $abs_path."/"; ?>charts-create">Crear / Actualizar</a>
          </li>
          <li <?php if( $active_opt=="charts-update" ) echo "class='active'"; ?>>
            <a href="<?php echo $abs_path."/"; ?>charts-update">Actualizar títulos</a>
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
          <a href="<?php echo $abs_path."/"; ?>historics">Lista de Históricos</a>
        </li>
        <?php if( user()["permission"]==1 ) { ?>
          <li <?php if( $active_opt=="historic-create" ) echo "class='active'"; ?>>
            <a href="<?php echo $abs_path."/"; ?>historics-create">Agregar Histórico</a>
          </li>
          <li <?php if( $active_opt=="historic-deleted" ) echo "class='active'"; ?>>
            <a href="<?php echo $abs_path."/"; ?>historics-deleted">Históricos Eliminados</a>
          </li>
        <?php } ?>
      </ul>
    </li>
  */ ?>
  <?php if( user()["permission"]==1 ) { ?>
    <li class="nav-item <?php if( $active_menu=="blog_mn" ) echo "active"; ?>" data-toggle="tooltip" data-placement="right" title="Usuarios">
      <a class="nav-link nav-link-collapse <?php if( $active_menu=="blog_mn" ) echo ""; else echo "collapsed"; ?>" data-toggle="collapse" href="#blogCollapse" data-parent="#exampleAccordion">
        <i class="fa fa-fw fa-rss-square"></i>
        <span class="nav-link-text">
          Blogs</span>
      </a>
      <ul class="sidenav-second-level collapse <?php if( $collapse=="blog" ) echo "show"; ?>" id="blogCollapse">
        <li <?php if( $active_opt=="blog-view" ) echo "class='active'"; ?>>
          <a href="<?php echo $abs_path."/"; ?>blogs">Lista de Blogs</a>
        </li>
        <li <?php if( $active_opt=="blog-create" ) echo "class='active'"; ?>>
          <a href="<?php echo $abs_path."/"; ?>blogs-create">Agregar Blog</a>
        </li>
        <li <?php if( $active_opt=="blog-deleted" ) echo "class='active'"; ?>>
          <a href="<?php echo $abs_path."/"; ?>blogs-deleted">Blogs Eliminados</a>
        </li>
      </ul>
    </li>
  <?php } ?>
  <?php if( user()["permission"]==1 ) { ?>
    <li class="nav-item <?php if( $active_menu=="customer_mn" ) echo "active"; ?>" data-toggle="tooltip" data-placement="right" title="Usuarios">
      <a class="nav-link nav-link-collapse <?php if( $active_menu=="customer_mn" ) echo ""; else echo "collapsed"; ?>" data-toggle="collapse" href="#customerCollapse" data-parent="#exampleAccordion">
        <i class="fa fa-fw fa-user-circle"></i>
        <span class="nav-link-text">
          Usuarios</span>
      </a>
      <ul class="sidenav-second-level collapse <?php if( $collapse=="customer" ) echo "show"; ?>" id="customerCollapse">
        <li <?php if( $active_opt=="customer-view" ) echo "class='active'"; ?>>
          <a href="<?php echo $abs_path."/"; ?>customers">Lista de Usuarios</a>
        </li>
        <li <?php if( $active_opt=="customer-create" ) echo "class='active'"; ?>>
          <a href="<?php echo $abs_path."/"; ?>customers-create">Agregar Usuario</a>
        </li>
        <li <?php if( $active_opt=="customer-deleted" ) echo "class='active'"; ?>>
          <a href="<?php echo $abs_path."/"; ?>customers-deleted">Usuarios Eliminados</a>
        </li>
      </ul>
    </li>
  <?php } ?>
</ul>