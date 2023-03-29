
<?php
session_start();

if(isset($_GET["id"]))
    {
        $_SESSION["identifiant"]= $_GET["id"];
    }
?>




<main>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 login-section-wrapper">
          <div class="brand-wrapper">
          <img src="assets/images/logo.jpg" alt="logo" class="logo" class="img-fluid">
          </div>


          <div class="login-wrapper align-1 my-auto">
            <form action="?page=verification" method="post">
              <div class="form-group mb-4">
                <input type="password" name="passwordconnect" id="password" class="form-control" placeholder="Entrer votre mot de passe">
              </div>
              <input name="login" id="login" class="btn btn-block login-btn" type="submit" value="Login">
            </form>
          </div>


        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
        <img src="assets/images/home.jpg" alt="login image" class="login-img" class="img-fluid">
        </div>
      </div>
    </div>
  </main>


<?php
