<?php
session_start();
//adatbázis kapcsolat
function dbConnect(){
    require './dbconfig.php';
    
    $conn = mysqli_connect($host, $username, $password, $dbname);
    if (!$conn) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
    }
    return $conn;
}

//összes kategória kilistázása
function getCategory(){
    $sql = "SELECT * FROM kategoria";
    $result = mysqli_query(dbConnect(), $sql);
   
    return $result;
}

//összes komment kilistázása film szerint
function getCommentsByMovieId($id){
    $sql = "SELECT * FROM comment WHERE film_id = ".$id;
    $result = mysqli_query(dbConnect(), $sql);
   
    return $result;
}

//összes felhasználó kilistázása
function getUsers(){
    $sql = "SELECT * FROM user";
    $result = mysqli_query(dbConnect(), $sql);
   
    return $result;
}

//összes film kilistázása
function getMovies(){
    $sql = "SELECT * FROM film";
    $result = mysqli_query(dbConnect(), $sql);
   
    return $result;
}

//filmek kilistázása id szerint
function getMoviesById(){
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT id, cim, leiras, kiadas_eve as kiadas, ertekeles, kep_url FROM film 
                        WHERE id=".$id.";";
        $result = mysqli_query(dbConnect(), $sql);

        return $result;
    }
}

function getDirectorById(){
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT film.id as id, rendezo.nev as rendezo FROM film
                        LEFT JOIN rendezo_film ON(film.id = rendezo_film.film_id)
                        LEFT JOIN rendezo ON(rendezo.id = rendezo_film.rendezo_id)
                        WHERE film.id=".$id.";";
        $result = mysqli_query(dbConnect(), $sql);

        return $result;
    }
}

function getActorById(){
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT film.id as id, szinesz.nev as szinesz FROM film 
                        LEFT JOIN szinesz_film ON(film.id = szinesz_film.film_id)
                        LEFT JOIN szinesz ON(szinesz.id = szinesz_film.szinesz_id)
                        WHERE film.id=".$id.";";
        $result = mysqli_query(dbConnect(), $sql);

        return $result;
    }
}

function getCategoryById(){
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT film.id as id,kategoria.id as kat_id, kategoria.megnevezes as kategoria FROM film 
                        LEFT JOIN kategoria_film ON(film.id = kategoria_film.film_id)
                        LEFT JOIN kategoria ON(kategoria.id = kategoria_film.kategoria_id)
                        WHERE film.id=".$id.";";
        $result = mysqli_query(dbConnect(), $sql);

        return $result;
    }
}

//filmek kilistázása kategória szerint
function getMoviesByCategoryId(){
    if(isset($_GET['category-id'])){
        $categoryId = $_GET['category-id'];
        $sql = "SELECT * FROM film, kategoria_film WHERE ".$categoryId." = kategoria_film.kategoria_id AND kategoria_film.film_id = film.id";
        $result = mysqli_query(dbConnect(), $sql);

        return $result;
    }
}

//KERESÉS funkció
function getMoviesBySearch(){
    if(isset($_POST['search'])){
        $search = $_POST['search'];
        $sql = "SELECT film.id as id, film.cim as cim, szinesz.nev as szinesz, rendezo.nev as rendezo, film.kep_url as kep_url, film.torolve as torolve FROM film 
                        LEFT JOIN szinesz_film ON(film.id = szinesz_film.film_id)
                        LEFT JOIN szinesz ON(szinesz.id = szinesz_film.szinesz_id)
                        LEFT JOIN rendezo_film ON(film.id = rendezo_film.film_id)
                        LEFT JOIN rendezo ON(rendezo.id = rendezo_film.rendezo_id)
                        WHERE film.cim LIKE '%".$search."%' OR szinesz.nev LIKE '%".$search."%' OR rendezo.nev LIKE '%".$search."%'";
        $result = mysqli_query(dbConnect(), $sql);

        return $result;
    }
}

//legújabb filmek kilistázása
function getNewestMovies(){
    $sql = "SELECT * FROM film ORDER BY kiadas_eve DESC";
    $result = mysqli_query(dbConnect(), $sql);
   
    return $result;
}

//összes színész kilistázása
function getActor(){
    $sql = "SELECT * FROM szinesz";
    $result = mysqli_query(dbConnect(), $sql);
   
    return $result;
}

//összes rendező kilistázása
function getDirector(){
    $sql = "SELECT * FROM rendezo";
    $result = mysqli_query(dbConnect(), $sql);
   
    return $result;
}

