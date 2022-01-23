<?php 
require './user.php';
if(isset($_GET['login'])){
    session_destroy();
    header('Location: home.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Movie Channel</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="../js/jquery-3.6.0.min.js"></script>
        <script src="../js/js.js"></script>
    </head>
    <body id="page-top" class="position-relative">
<!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="home.php"><img src="../assets/img/menu-logo.png" alt="..." /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="home.php#category">Kategóriák</a></li>
                        <li class="nav-item"><a class="nav-link" href="home.php#movies">Filmek</a></li>
                        <li class="nav-item"><a class="nav-link" href="home.php#contactUs">Kontakt</a></li>
                        <?php 
                        if(isset($_SESSION['email'])){
                            print('<li class="nav-item"><a class="nav-link" href="home.php?login=false">Kijelentkezés</a></li>');
                        }
                        else{
                            print('<li class="nav-item"><a class="nav-link" href="login.php">Bejelentkezés</a></li>
                                <li class="nav-item"><a class="nav-link" href="signup.php">Regisztráció</a></li>');
                        }
                        ?>
                        
                    </ul>
                </div>
            </div>
        </nav>