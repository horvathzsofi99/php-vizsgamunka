<?php 
require './menu.php';
?>

<div class="container-fluid px-0 mb-3">
    <img src="../assets/img/movie-bg.jpg" alt="alt" width="100%"/>
</div>
<div class="container pb-5">
    <div class="text-center">
        <h2 class="section-heading text-uppercase py-5">Filmek</h2>
    </div>
    <nav class="navbar navbar-light mb-4">
        <div class="container-fluid">
            <form class="d-flex" method="POST">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" id="search">
                <button class="btn btn-primary" type="submit">Keress</button>
            </form>
        </div>
    </nav>
    <div class="row row-cols-1 row-cols-md-5 g-4" id="film-cards">
        <?php 
        if(isset($_POST['search'])){
            $searches = getMoviesBySearch();
            $movieArray = [];
            if(mysqli_num_rows($searches) > 0){
                while($searchData = mysqli_fetch_assoc($searches)){
                    if(!(in_array($searchData['cim'], $movieArray))){
                        if($searchData['torolve'] == "nem"){
                            print("<a href=\"movie_data_sheet.php?id=".$searchData['id']."\" class=\"text-decoration-none\">
                                        <div class=\"col\">
                                            <div class=\"card h-100\">
                                                <img src=\"../assets/img/film/".$searchData['kep_url']."\" class=\"card-img-top\" alt=\"...\">
                                                <div class=\"card-body\">
                                                  <h5 class=\"card-title\">".$searchData['cim']."</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </a>");
                        }
                    }
                array_push($movieArray, $searchData['cim']);
                }
            }
            else{
                print('Nincs találat.');
            }
        }
        else{
            $movies = getNewestMovies();
            while($movieData = mysqli_fetch_assoc($movies)){
                if($movieData['torolve'] == "nem"){
                    print("<a href=\"movie_data_sheet.php?id=".$movieData['id']."\" class=\"text-decoration-none\">
                    <div class=\"col\">
                        <div class=\"card h-100\">
                            <img src=\"../assets/img/film/".$movieData['kep_url']."\" class=\"card-img-top\" alt=\"...\">
                            <div class=\"card-body\">
                              <h5 class=\"card-title\">".$movieData['cim']."</h5>
                            </div>
                        </div>
                    </div>
                </a>");
                }
            }
        }
        ?>
        
    </div>  
</div>

<?php require_once 'footer.php'; ?>