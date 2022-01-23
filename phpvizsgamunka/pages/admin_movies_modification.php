<?php 
require './admin_menu.php';
modifiedMovie();

?>

<div class="container-fluid px-0 mb-3">
    <img src="../assets/img/movie-bg.jpg" alt="alt" width="100%"/>
</div>

<div class="container text-center">
    <div class="text-center">
        <h2 class="section-heading text-uppercase py-5">Film módosítása</h2>
    </div>
    <?php   
        $moviesById = getMoviesById();
        while($moviesByIdData = mysqli_fetch_assoc($moviesById)){
            $id = $moviesByIdData['id'];
            $title = $moviesByIdData['cim'];
            $description = $moviesByIdData['leiras'];
            $year = $moviesByIdData['kiadas'];
            $rating = $moviesByIdData['ertekeles'];
        } 
        
        
        $director = [];
        $actor = [];
        $category = [];
        $movieDirector = getDirectorById();
        while($movieDirectorData = mysqli_fetch_assoc($movieDirector)){
            array_push($director, $movieDirectorData['rendezo']);
        } 
        
        $movieActor = getActorById();
        while($movieActorData = mysqli_fetch_assoc($movieActor)){
            array_push($actor, $movieActorData['szinesz']);
        } 
        
        $movieCategory = getCategoryById();
        while($movieCategoryData = mysqli_fetch_assoc($movieCategory)){
            array_push($category, $movieCategoryData['kategoria']);
        }
        
        ?>
    
    <form method="POST" enctype="multipart/form-data">
        <div class="row mb-3">
          <label for="title" class="col-sm-2 col-form-label">Cím</label>
          <div class="col-sm-10">
              <input type="text" class="form-control" id="m-title" name="modified[title]" required value="<?php print($title) ?>">
          </div>
        </div>
        <div class="row mb-3">
          <label for="description" class="col-sm-2 col-form-label">Leírás</label>
          <div class="col-sm-10">
              <textarea id="m-description" name="modified[description]" class="w-100" required><?php print($description) ?></textarea>
          </div>
        </div>
        <div class="row mb-3">
          <label for="year" class="col-sm-2 col-form-label">Kiadás éve</label>
          <div class="col-sm-10">
              <input type="text" class="form-control" id="m-year" name="modified[year]" maxlength="4" size="4" required value="<?php print($year) ?>">
          </div>
        </div>
        <div class="row mb-3">
          <label for="rating" class="col-sm-2 col-form-label">Értékelés</label>
          <div class="col-sm-10">
              <input type="text" class="form-control" id="m-rating" name="modified[rating]" maxlength="1" size="1" required value="<?php print($rating) ?>">
          </div>
        </div>
        
        <div class="row mb-3 justify-content-end" id="m-wrap-director">
          <label for="director" class="col-sm-2 col-form-label">Rendező</label>
          <div class="col-sm-9">
              <input type="text" class="form-control" id="m-director0" name="m-director0" value="<?php if(isset($director[0])){print($director[0]);} ?>">
          </div>
          <button type="button" class="col-sm-1 btn btn-success" id="m-add-director">+</button>
        </div>
        
        <?php 
        if(isset($director[1])){
            for($i = 1; $i < count($director); $i++){
                print('<div class="row mb-3" id="m-wrap-director">
                        <label for="director" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="m-director'.$i.'" name="m-director'.$i.'" required value="'.$director[$i].'">
                        </div>
                        <div class=\"col-sm-1\"></div>
                      </div>');
            }
        }
        ?>
        
        <div class="row mb-3 justify-content-end" id="m-wrap-actor">
          <label for="actor" class="col-sm-2 col-form-label">Színész</label>
          <div class="col-sm-9">
              <input type="text" class="form-control" id="m-actor0" name="m-actor0" value="<?php if(isset($actor[0])){print($actor[0]);} ?>">
          </div>
          <button type="button" class="col-sm-1 btn btn-success" id="m-add-actor">+</button>
        </div>
        
        <?php 
        if(isset($actor[1])){
            for($j = 1; $j < count($actor); $j++){
                print('<div class="row mb-3" id="m-wrap-actor">
                        <label for="actor" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="m-actor'.$j.'" name="m-actor'.$j.'" required value="'.$actor[$j].'">
                        </div>
                        <div class=\"col-sm-1\"></div>
                      </div>');
            }
        }
        ?>
        
        <div class="row mb-3" id="m-wrap-category">
            <label for="category" class="col-sm-2 col-form-label">Kategória</label>
            <div class="col-sm-9 mt-2">
                <?php 
                $allCategory = getCategory();
                $cat_num = 0;
                $thisMovieCategories = [];
                $thisMovieCategory = getCategoryById();
                while ($thisMovieCategoriesData = mysqli_fetch_assoc($thisMovieCategory)){
                    array_push($thisMovieCategories, $thisMovieCategoriesData['kategoria']);
                }
                while ($category = mysqli_fetch_assoc($allCategory)){
                    $cat_num++;
                    print('<div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="check_category'.$cat_num.'" name="check_category'.$cat_num.'" value="'.$category['id'].'"');
                    if(in_array($category["megnevezes"], $thisMovieCategories)){print("checked");}
                    print('>
                            <label class="form-check-label" for="inlineCheckbox1">'.$category['megnevezes'].'</label>
                        </div>');
                }
                ?>
            </div>
        </div>
        
        <div class="row mb-3" id="wrap-picture">
            <label for="formFile" class="col-sm-2 col-form-label">Borítókép</label>
            <div class="col-sm-10">
                <input class="form-control" type="file" id="m-picture" name="m-picture" accept="image/*">
            </div>
        </div>
          
        
        <a href="admin_movies_modification.php?id=<?php $moviesByIdData['id'] ?>" class="text-black"><button type="submit" class="btn btn-primary mb-3">Mentés</button></a>
      </form>
  </div>

<?php 
require './footer.php';
?>