<?php
session_start();
// $_SESSION["loggedin"]=false;
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  header('Location: panel-control.php');
}
else{
}
 ?>
<!DOCTYPE html>
<html lang="en">
  <?php require('structure/head.php'); ?>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-12 jumbotron-container">
          <div class="jumbotron col-md-4 col-md-offset-4 orange-gradient">
            <div>
              <div class="logo-container text-center">
                <a href="/index">
                  <img src="http://placehold.it/200x50.svg?text=BrandLogo" alt="BrandLogo" class="logo svg svg-black">
                </a>
              </div>
            </div>
              <div class="form-group">
                <input type="text" name="user" class="form-control" id="user" placeholder="Usuario" required>
              </div>
              <div class="form-group">
                <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña" required>
              </div>
              <div class="form-group text-right">
                <button type="submit" class="btn btn-success more-radius" id="acceso">Entrar</button>
              </div>
            <!-- </form> -->
          </div>
        </div>
    <div id="alerts" style="position: fixed; top: 20px; width: 70%; z-index: 2; margin-left: 0px;">
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript" src='assets/js/acceso.js'></script>
  </body>
</html>