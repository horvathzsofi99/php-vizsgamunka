<?php 
require './admin_menu.php';
?>

<div class="container-fluid px-0 mb-3">
    <img src="../assets/img/movie-bg.jpg" alt="alt" width="100%"/>
</div>

<div class="container text-center">
    <div class="text-center">
        <h2 class="section-heading text-uppercase py-5">Film hozzáadása</h2>
    </div>
    <form method="POST" enctype="multipart/form-data">
        <div class="row mb-3">
          <label for="title" class="col-sm-2 col-form-label">Cím</label>
          <div class="col-sm-10">
              <input type="text" class="form-control" id="title" name="upload[title]" required>
          </div>
        </div>
        <div class="row mb-3">
          <label for="description" class="col-sm-2 col-form-label">Leírás</label>
          <div class="col-sm-10">
              <textarea id="description" name="upload[description]" class="w-100" required></textarea>
          </div>
        </div>
        <div class="row mb-3">
          <label for="year" class="col-sm-2 col-form-label">Kiadás éve</label>
          <div class="col-sm-10">
              <input type="text" class="form-control" id="year" name="upload[year]" maxlength="4" size="4" required>
          </div>
        </div>
        <div class="row mb-3">
          <label for="rating" class="col-sm-2 col-form-label">Értékelés</label>
          <div class="col-sm-10">
              <input type="text" class="form-control" id="rating" name="upload[rating]" maxlength="1" size="1" required>
          </div>
        </div>
        
        <div class="row mb-3 justify-content-end" id="wrap-director">
          <label for="director" class="col-sm-2 col-form-label">Rendező</label>
          <div class="col-sm-9">
              <input type="text" class="form-control" id="director0" name="director0" required>
          </div>
          <button type="button" class="col-sm-1 btn btn-success" id="add-director">+</button>
        </div>
        
        <div class="row mb-3 justify-content-end" id="wrap-actor">
          <label for="actor" class="col-sm-2 col-form-label">Színész</label>
          <div class="col-sm-9">
              <input type="text" class="form-control" id="actor0" name="actor0" required>
          </div>
          <button type="button" class="col-sm-1 btn btn-success" id="add-actor">+</button>
        </div>
        
        <div class="row mb-3" id="wrap-category">
            <label for="category" class="col-sm-2 col-form-label">Kategória</label>
            <div class="col-sm-9 mt-2">
                <?php 
                $allCategory = getCategory();
                $cat_num = 0;
                while ($category = mysqli_fetch_assoc($allCategory)){
                    $cat_num++;
                    print('<div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="check_category'.$cat_num.'" name="check_category'.$cat_num.'" value="'.$category['id'].'">
                            <label class="form-check-label" for="inlineCheckbox1">'.$category['megnevezes'].'</label>
                        </div>');
                }
                ?>
            </div>
        </div>
        
        <div class="row mb-3" id="wrap-picture">
            <label for="formFile" class="col-sm-2 col-form-label">Borítókép</label>
            <div class="col-sm-10">
                <input class="form-control" type="file" id="picture" name="picture" accept="image/*" required>
            </div>
        </div>
          
        
        <button type="submit" class="btn btn-primary mb-3">Mentés</button>
      </form>
  </div>

<?php 
require './footer.php';
insertMovie();
?>