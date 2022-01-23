<?php 
require './menu.php';
$movById = getMoviesById();
while($movieByIdData = mysqli_fetch_assoc($movById)){
    $dataId = $movieByIdData['id'];
    $dataTitle = $movieByIdData['cim'];
    $dataDescription = $movieByIdData['leiras'];
    $dataYear = $movieByIdData['kiadas'];
    $dataRating = $movieByIdData['ertekeles'];
    $dataPicture = $movieByIdData['kep_url'];
} 

$dataDirector = [];
$dataActor = [];
$dataCategory = [];
$dataUser = [];
$dataUserId = [];
$dataUserPic = [];
$moviesDirector = getDirectorById();
while($moviesDirectorData = mysqli_fetch_assoc($moviesDirector)){
    array_push($dataDirector, $moviesDirectorData['rendezo']);
} 

$moviesActor = getActorById();
while($moviesActorData = mysqli_fetch_assoc($moviesActor)){
    array_push($dataActor, $moviesActorData['szinesz']);
} 

$moviesCategory = getCategoryById();
while($moviesCategoryData = mysqli_fetch_assoc($moviesCategory)){
    array_push($dataCategory, $moviesCategoryData['kategoria']);
}

$moviesUser = getUsers();
while($moviesUserData = mysqli_fetch_assoc($moviesUser)){
    array_push($dataUser, $moviesUserData['nev']);
    array_push($dataUserPic, $moviesUserData['kep_url']);
    array_push($dataUserId, $moviesUserData['id']);
}
?>

<div class="container-fluid px-0 mb-3">
    <img src="../assets/img/movie-bg.jpg" alt="alt" width="100%"/>
</div>

<div class="container text-center">
    <div class="row">
        <div class="col-10 text-center">
            <h2 class="section-heading text-uppercase py-5"><?php if(isset($dataTitle)){print($dataTitle);} ?></h2>
        </div>
        <div class="col-2 py-5">
            <h5>Értékelés:</h5>
            <p class="fs-3"><?php if(isset($dataRating)){print($dataRating);} ?> / 10</p>
        </div>
    </div>
</div>

<div class="container px-0 mb-3">
    <div class="row">
        <div class="col-2 h-100">
            <img class="card-img-top" src="../assets/img/film/<?php if(isset($dataPicture)){print($dataPicture);} ?>" alt="alt"/>
        </div>
        <div class="col-7">
            <p><?php if(isset($dataDescription)){print($dataDescription);} ?></p>
            <h5>Kategória:</h5>
<?php
    if(isset($dataCategory)){
        print($dataCategory[0]);
        if(isset($dataCategory[1])){
            for($o = 1; $o < count($dataCategory); $o++){
                print(', '.$dataCategory[$o]);
            }
        }
    }
?>
        </div>
        <div class="col-3">
            <h5>Rendező(k):</h5>
            <ul style="list-style-type: none;">
<?php
    if(isset($dataDirector)){
        for($m = 0; $m < count($dataDirector); $m++){
            print('<li>'.$dataDirector[$m].'</li>');
        }
    }
?>
            </ul>
            <h5>Színész(ek):</h5>
            <ul style="list-style-type: none;">
<?php
    if(isset($dataActor)){
        for($n = 0; $n < count($dataActor); $n++){
            print('<li>'.$dataActor[$n].'</li>');
        }
    }
?>
            </ul>
        </div>
    </div>
    <div class="row my-5">
        <div class="col">
            <h5>Kommentek:</h5>
        </div>
    </div>
    
        
<?php
    $moviesComment = getCommentsByMovieId($dataId);
    while($moviesCommentData = mysqli_fetch_assoc($moviesComment)){
        print('<div class="row my-3 p-2 border">
                    <div class="col-2">
                        <img class="card-img-top" src="../assets/img/user/'.$dataUserPic[((int)$moviesCommentData['user_id'])-1].'" alt="alt"/>
                    </div>
                    <div class="col-10">
                        <span class="fw-bold">'.$dataUser[((int)$moviesCommentData['user_id'])-1].'</span> - <span class="fst-italic">'.$moviesCommentData['datum'].'</span><br>
                        '.$moviesCommentData['hozzaszolas'].'
                    </div>
                </div>');
    } 
?>
        
   
</div>
<?php

require 'footer.php'; 
?>