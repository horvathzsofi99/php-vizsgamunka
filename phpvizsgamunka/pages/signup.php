<?php 
require './menu.php';
if($_POST['signup'] and $_SERVER['REQUEST_METHOD'] == "POST"){
    signupUser();
}
?>

<div class="container-fluid px-0 mb-3">
    <img src="../assets/img/movie-bg.jpg" alt="alt" width="100%"/>
</div>
<div class="container pb-5">
    <div class="text-center">
        <h2 class="section-heading text-uppercase py-5">Regisztráció</h2>
    </div>
    <form class="row g-3" method="POST">
      <div class="col-md-6">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="signup[email]">
      </div>
      <div class="col-md-6">
        <label for="birthdate" class="form-label">Születési dátum</label>
        <input type="date" class="form-control" id="birthdate" name="signup[birthdate]">
      </div>
      <div class="col-md-6">
        <label for="password1" class="form-label">Jelszó</label>
        <input type="password" class="form-control" id="password1" name="signup[password1]">
      </div>
      <div class="col-md-6">
        <label for="name" class="form-label">Név</label>
        <input type="text" class="form-control" id="name" name="signup[name]">
      </div>
      <div class="col-md-6">
        <label for="password2" class="form-label">Jelszó mégegyszer</label>
        <input type="password" class="form-control" id="password2" name="signup[password2]">
      </div>
      <div class="col-md-6" id="wrap-image">
        <label for="image" class="form-label">Kép</label><br>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" id="image" name="image">
          Avatar kép kiválasztása
        </button>
        <img style="height: 40px;" class="mx-3" id="signup-icon" src="../assets/img/user/img1.png">
      </div>
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Válasszon a profiljának képet!</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row row-cols-1 row-cols-md-4 g-4">
                  <div class="col">
                    <div class="card-user h-100 form-check form-check-inline">
                      <input class="btn-check" type="radio" name="exampleRadios" id="exampleRadios1" autocomplete="off" value="img1.png" checked>
                      <label class="btn btn-secondary p-0" style="border-radius: 50%;" for="exampleRadios1">
                        <img src="../assets/img/user/img1.png" class="card-img-top" alt="...">
                      </label>
                    </div>
                  </div>
                <?php 
                for($w = 2; $w <= 24; $w++){
                    print('<div class="col">
                        <div class="card-user h-100 form-check form-check-inline">
                          <input class="btn-check" type="radio" name="exampleRadios" id="exampleRadios'.$w.'" autocomplete="off" value="img'.$w.'.png">
                          <label class="btn btn-secondary p-0" style="border-radius: 50%;" for="exampleRadios'.$w.'">
                            <img src="../assets/img/user/img'.$w.'.png" class="card-img-top" alt="...">
                          </label>
                        </div>
                      </div>');
                }
                ?>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="add-user-icon" data-bs-dismiss="modal">Tovább</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-primary">Regisztráció</button>
      </div>
    </form>
</div>

<?php require_once 'footer.php'; ?>