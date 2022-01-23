<?php

require './user.php';

function modifiedMovie(){
    if(isset($_POST['modified'])){
        $movieById = getMoviesById();
        while($movieByIdData = mysqli_fetch_assoc($movieById)){
            $id = $movieByIdData['id'];
            $oldTitle = $movieByIdData['cim'];
            $oldDescription = $movieByIdData['leiras'];
            $oldYear = $movieByIdData['kiadas'];
            $oldRating = $movieByIdData['ertekeles'];
        } 
        $oldDirector = [];
        $oldActor = [];
        $oldCategory = [];
        $directorArray = [];
        $actorArray = [];
        $categoryIdArray = [];
        
        $title = filter_var($_POST['modified']['title'], FILTER_SANITIZE_SPECIAL_CHARS);
        $description = filter_var($_POST['modified']['description'], FILTER_SANITIZE_SPECIAL_CHARS);
        $year = (int)($_POST['modified']['year']);
        $rating = (int)($_POST['modified']['rating']);
        $picture = $_FILES['m-picture'];
        
        //1-1 kapcsolatos (adatbázis) adatok ellenőrzése hogy változtak-e
        if($oldTitle == $title){
            $isNewTitle = false;
        }else {
            $isNewTitle = true;
            $newTitle = $title;
        }
        
        if($oldDescription == $description){
            $isNewDescription = false;
        }else {
            $isNewDescription = true;
            $newDescription = $description;
        }
        
        if($oldYear == $year){
            $isNewYear = false;
        }else {
            $isNewYear = true;
            $newYear = $year;
        }
        
        if($oldRating == $rating){
            $isNewRating = false;
        }else {
            $isNewRating = true;
            $newRating = $rating;
        }
        
        //több-több kapcsolatos (adatbázis) adatok ellenőrzése hogy változtak-e
        $md=0;
        while(isset($_POST['m-director'.$md])){
            $mdirector = filter_var($_POST['m-director'.$md], FILTER_SANITIZE_SPECIAL_CHARS);
            array_push($directorArray, $mdirector);
            $md++;
        }
        $ma=0;
        while(isset($_POST['m-actor'.$ma])){
            $mactor = filter_var($_POST['m-actor'.$ma], FILTER_SANITIZE_SPECIAL_CHARS);
            array_push($actorArray, $mactor);
            $ma++;
        }
        $allCat = getCategory();
        for($mc = 1; $mc <= (mysqli_num_rows($allCat)); $mc++){
            if(isset($_POST['check_category'.$mc])){
                array_push($categoryIdArray, $_POST['check_category'.$mc]);
            }
        }
        
        $oldMovieDirector = getDirectorById();
        while($oldMovieDirectorData = mysqli_fetch_assoc($oldMovieDirector)){
            array_push($oldDirector, $oldMovieDirectorData['rendezo']);
        } 
        
        $oldMovieActor = getActorById();
        while($oldMovieActorData = mysqli_fetch_assoc($oldMovieActor)){
            array_push($oldActor, $oldMovieActorData['szinesz']);
        } 
        
        $oldMovieCategory = getCategoryById();
        while($oldMovieCategoryData = mysqli_fetch_assoc($oldMovieCategory)){
            array_push($oldCategory, $oldMovieCategoryData['kat_id']);
        }
        
        $newDirector = [];
        $isNewDirector = false;
        for($d = 0; $d < count($directorArray); $d++){
            if(!(in_array($directorArray[$d], $oldDirector))){
                $isNewDirector = true;
                array_push($newDirector, $directorArray[$d]);
            }
        }
        
        $newActor = [];
        $isNewActor = false;
        for($a = 0; $a < count($actorArray); $a++){
            if(!(in_array($actorArray[$a], $oldActor))){
                $isNewActor = true;
                array_push($newActor, $actorArray[$a]);
            }
        }
        
        $newCategory = [];
        $isNewCategory = false;
        for($c = 0; $c < count($categoryIdArray); $c++){
            if(!(in_array($categoryIdArray[$c], $oldCategory))){
                $isNewCategory = true;
                array_push($newCategory, $categoryIdArray[$c]);
            }
        }
        
        //új adatok beillesztése
        $newDataInFilm = false;
        if($isNewTitle){
            $mMovieData['cim'] = $title;
            $newDataInFilm = true;
        }
        if($isNewDescription){
            $mMovieData['leiras'] = $description;
            $newDataInFilm = true;
        }
        if($isNewYear){
            $mMovieData['kiadas_eve'] = $year;
            $newDataInFilm = true;
        }
        if($isNewRating){
            $mMovieData['ertekeles'] = $rating;
            $newDataInFilm = true;
        }
        $conn = dbConnect();
        if($newDataInFilm){
            dbUpdateById($conn, 'film', $mMovieData, $id);
        }
        
        
        $dir = getDirector();
        for($dc = 0; $dc < count($newDirector); $dc++){
                $mDirectorExist = false;
                while($mdirector = mysqli_fetch_assoc($dir)){
                    if(in_array($mdirector['nev'], $newDirector)){
                        $mMovieDirector['rendezo_id'] = $mdirector['id'];
                        $mMovieDirector['film_id'] = $id;
                        $mMovieDirector_id = dbInsert($conn, 'rendezo_film', $mMovieDirector);
                        unset($newDirector[$dc]);
                        $mDirectorExist = true;
                    }
                }
                if(!$mDirectorExist){
                    $mDirectorData['nev'] = $newDirector[$dc];
                    $mDirector_id[$dc] = dbInsert($conn, 'rendezo', $mDirectorData);

                    $mMovieDirector['rendezo_id'] = $mDirector_id[$dc];
                    $mMovieDirector['film_id'] = $id;
                    $mMovieDirector_id = dbInsert($conn, 'rendezo_film', $mMovieDirector);
                }
            
        }
        
        $act = getActor();
        for($ac = 0; $ac < count($newActor); $ac++){
                $mActorExist = false;
                while($mactors = mysqli_fetch_assoc($act)){
                    if(in_array($mactors['nev'], $newActor)){
                        $mMovieActor['szinesz_id'] = $mactors['id'];
                        $mMovieActor['film_id'] = $id;
                        $mMovieActor_id = dbInsert($conn, 'szinesz_film', $mMovieActor);
                        unset($newActor[$ac]);
                        $mActorExist = true;
                    }
                }
                if(!$mActorExist){
                    $mActorData['nev'] = $newActor[$ac];
                    $mActor_id[$ac] = dbInsert($conn, 'szinesz', $mActorData);

                    $mMovieActor['szinesz_id'] = $mActor_id[$ac];
                    $mMovieActor['film_id'] = $id;
                    $mMovieActor_id = dbInsert($conn, 'szinesz_film', $mMovieActor);
                }
        }
        
        $newCategoryIntegerId = [];
        for($q = 0; $q < count($newCategory); $q++){
            $newCategoryIntegerId[$q] = (int)$newCategory[$q];
        }
        for($cc = 0; $cc < count($newCategoryIntegerId); $cc++){
            $mMovieCategory['kategoria_id'] = $newCategoryIntegerId[$cc];
            $mMovieCategory['film_id'] = $id;
            $movieCategory_id = dbInsert($conn, 'kategoria_film', $mMovieCategory);
        }
        
        //végül megvizsgáljuk a képet is, hogy töltöttek-e fel, ha igen, akkor feltöltjük
        if(isset($_FILES['m-picture']) && $_FILES['m-picture'] !== ""){
            if($_FILES['m-picture']['error'] === 0 && $_FILES['m-picture']['type'] == "image/jpeg"){
                $source = $_FILES['m-picture']['tmp_name'];
                $dest = './../assets/img/film/'.$_FILES['m-picture']['name'];

                $file = fopen($source, 'r');
                $header = fread($file, 120);
                fclose($file);

                $pos = strpos($header, 'JFIF');
                if($pos !== false){
                    if(copy($source, $dest)){
                        print("<div id=\"alert\" class=\"alert alert-warning position-fixed bottom-0 mb-0 w-100\" role=\"alert\">
                                Sikeres feltöltés!
                            </div>");
                        $mPicture['kep_url'] = $_FILES['m-picture']['name'];
                        dbUpdateById($conn, 'film', $mPicture, $id);
                    }
                }
                else{
                    exit();
                }
            }
        }
    }
}


function insertMovie(){
    if(isset($_POST['upload'])){
        $directorArray = [];
        $actorArray = [];
        $categoryIdArray = [];
        
        // speciális karakterek átalakítása (támadások ellen)
        $title = filter_var($_POST['upload']['title'], FILTER_SANITIZE_SPECIAL_CHARS);
        $description = filter_var($_POST['upload']['description'], FILTER_SANITIZE_SPECIAL_CHARS);
        $year = (int)($_POST['upload']['year']);
        $rating = (int)($_POST['upload']['rating']);
        $picture = $_FILES['picture'];
        
        $di=0;
        while(isset($_POST['director'.$di])){
            $director = filter_var($_POST['director'.$di], FILTER_SANITIZE_SPECIAL_CHARS);
            array_push($directorArray, $director);
            $di++;
        }
        $ai=0;
        while(isset($_POST['actor'.$ai])){
            $actor = filter_var($_POST['actor'.$ai], FILTER_SANITIZE_SPECIAL_CHARS);
            array_push($actorArray, $actor);
            $ai++;
        }
        $cat = getCategory();
        for($ci = 1; $ci <= (mysqli_num_rows($cat)); $ci++){
            if(isset($_POST['check_category'.$ci])){
                array_push($categoryIdArray, $_POST['check_category'.$ci]);
            }
        }
        
        
        $movies = getMovies();
        while($movie = mysqli_fetch_assoc($movies)){
            if($title == $movie['cim']){
                if($year == $movie['kiadas_eve']){
                    print("<div id=\"alert\" class=\"alert alert-warning position-fixed bottom-0 mb-0 w-100\" role=\"alert\">
                            A film valószínűleg már szerepel az adatbázisban. Kérem ellenőrizze!
                        </div>");
                    exit();
                }
            }
        }
        
        if(isset($_FILES['picture'])){
            if($_FILES['picture']['error'] === 0 && $_FILES['picture']['type'] == "image/jpeg"){
                $source = $_FILES['picture']['tmp_name'];
                $dest = './../assets/img/film/'.$_FILES['picture']['name'];

                $file = fopen($source, 'r');
                $header = fread($file, 120);
                fclose($file);

                $pos = strpos($header, 'JFIF');
                if($pos !== false){
                    if(copy($source, $dest)){
                        print("<div id=\"alert\" class=\"alert alert-warning position-fixed bottom-0 mb-0 w-100\" role=\"alert\">
                                Sikeres feltöltés!
                            </div>");
                    }
                    else{
                        print("<div id=\"alert\" class=\"alert alert-warning position-fixed bottom-0 mb-0 w-100\" role=\"alert\">
                                A file-t nem töltöttük fel!
                            </div>");
                    }
                }
                else{
                    print("<div id=\"alert\" class=\"alert alert-warning position-fixed bottom-0 mb-0 w-100\" role=\"alert\">
                            Nem jpg!
                        </div>");
                    exit();
                }
            }
            else{
                print("<div id=\"alert\" class=\"alert alert-warning position-fixed bottom-0 mb-0 w-100\" role=\"alert\">
                        Hiba a feltöltés során!
                    </div>");
                exit();
            }
        }

        
        $movieData['cim'] = $title;
        $movieData['kep_url'] = $_FILES['picture']['name'];
        $movieData['leiras'] = $description;
        $movieData['kiadas_eve'] = $year;
        $movieData['ertekeles'] = $rating;
        $movieData['torolve'] = "nem";
        $conn = dbConnect();
        $movie_id = dbInsert($conn, 'film', $movieData);
        
        
        for($d = 0; $d < count($directorArray); $d++){
            $directorExist = false;
            $dir = getDirector();
            while($directors = mysqli_fetch_assoc($dir)){
                if($directorArray[$d] == $directors['nev']){
                    $directorExist = true;
                }
            }
            if($directorExist){
                $movieDirector['rendezo_id'] = $directorArray[$d];
                $movieDirector['film_id'] = $movie_id;
                $movieDirector_id = dbInsert($conn, 'rendezo_film', $movieDirector);
            }
            if(!$directorExist){
                $directorData['nev'] = $directorArray[$d];
                $director_id = dbInsert($conn, 'rendezo', $directorData);

                $newMovieDirector['rendezo_id'] = $director_id;
                $newMovieDirector['film_id'] = $movie_id;
                $movieDirector_id = dbInsert($conn, 'rendezo_film', $newMovieDirector);
            }
        }
        
        for($a = 0; $a < count($actorArray); $a++){
            $actorExist = false;
            $act = getActor();
            while($actors = mysqli_fetch_assoc($act)){
                if($actorArray[$a] == $actors['nev']){
                    $actorExist = true;
                }
            }
            if($actorExist){
                $oldMovieActor['szinesz_id'] = $actorArray[$a];
                $oldMovieActor['film_id'] = $movie_id;
                $movieActor_id = dbInsert($conn, 'szinesz_film', $oldMovieActor);
            }
            if(!$actorExist){
                $actorData['nev'] = $actorArray[$a];
                $actor_id = dbInsert($conn, 'szinesz', $actorData);

                $newMovieActor['szinesz_id'] = $actor_id;
                $newMovieActor['film_id'] = $movie_id;
                $newMovieActor_id = dbInsert($conn, 'szinesz_film', $newMovieActor);
            }
        }
        
        for($c = 0; $c < count($categoryIdArray); $c++){
            
            $movieCategory['kategoria_id'] = $categoryIdArray[$c];
            $movieCategory['film_id'] = $movie_id;
            $movieCategory_id = dbInsert($conn, 'kategoria_film', $movieCategory);
        }
    }
}

function insertComment(){
    if(isset($_POST['comment'])){
        $comment = filter_var($_POST['comment'], FILTER_SANITIZE_SPECIAL_CHARS);
        $userId = $_SESSION['id'];
        $movieId = $_GET['id'];
        $date = date("Y-m-d");
        
        $commentData['hozzaszolas'] = $comment;
        $commentData['datum'] = $date;
        $commentData['user_id'] = $userId;
        $commentData['film_id'] = $movieId;
        $conn = dbConnect();
        $comment_id = dbInsert($conn, 'comment', $commentData);
        $_POST = array();
    }
}

