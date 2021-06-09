<div id="layoutSidenav">
  <div id="layoutSidenav_nav">
    <?php include("structure/menu.php"); ?>
  </div>
  <div id="layoutSidenav_content">
    <main>
      <?php echo $content; ?>

      <?php isset($data_table_which) && !empty($data_table_which) ? include("widgets/data-table.php") : "" ?>
    </main>
    <footer class="py-4 bg-light mt-auto">
      <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
          <div class="text-muted">
            <p class="mb-0">Copyright &copy; <?php echo $env->APP_NAME." ".$copy_year; ?></p>
          </div>
          <?php /*
          <div>
            <a href="#">Privacy Policy</a>
            &middot;
            <a href="#">Terms &amp; Conditions</a>
          </div>
          */ ?>
        </div>
      </div>
    </footer>
  </div>
</div>
