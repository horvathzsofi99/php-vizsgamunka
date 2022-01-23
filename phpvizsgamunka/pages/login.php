<?php 
require './menu.php'; 
if(isset($_POST['login']) && $_SERVER['REQUEST_METHOD'] == "POST"){
    loginUser();
}
?>

<div class="container-fluid px-0 mb-3">
    <img src="../assets/img/movie-bg.jpg" alt="alt" width="100%"/>
</div>
<div class="container pb-5">
    <div class="text-center">
        <h2 class="section-heading text-uppercase py-5">Bejelentkezés</h2>
    </div>
    <form class="row g-3" method="POST">
      <div class="col-md-6">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="login[email]">
      </div>
      <div class="col-md-6">
        <label for="password" class="form-label">Jelszó</label>
        <input type="password" class="form-control" id="password" name="login[password]">
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-primary">Bejelentkezés</button>
      </div>
    </form>
</div>

<?php 
require_once 'footer.php';
?>