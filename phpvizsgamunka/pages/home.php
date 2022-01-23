
<?php 
require './menu.php'; 
?>
        <!-- Masthead-->
        <header class="masthead">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                  <img src="../assets/img/movie1.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <div class="masthead-heading text-uppercase">Movie Channel</div>
                    <div class="masthead-subheading">Keresse meg kedvenc filmjeit!</div>
                    <a class="btn btn-primary btn-xl text-uppercase" href="movies.php">Keresek</a>
                </div>
              </div>
              <div class="carousel-item">
                <img src="../assets/img/movie2.jpeg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <div class="masthead-subheading">Nézze meg legújabb filmkínálatunkat!</div>
                    <a class="btn btn-primary btn-xl text-uppercase" href="home.php#movies">Megnézem</a>
                </div>
              </div>
              <div class="carousel-item">
                <img src="../assets/img/movie3.jpeg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  <div class="masthead-subheading">Böngéssszen kategóriák között!</div>
                  <a class="btn btn-primary btn-xl text-uppercase" href="home.php#category">Lássuk</a>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Előző</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Következő</span>
            </button>
          </div>
        </header>
        <!-- Services-->
        <section class="page-section" id="category">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Kategóriák</h2>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-borderless text-center">
                        <tbody>
                            <?php 
                            $categories = getCategory();
                            $num = 0;
                            print("<tr>");
                            while($categoryData = mysqli_fetch_assoc($categories)){
                                $num++;
                                print("<td><a href=\"./home.php?category-id=".$categoryData['id']."#movies\">".$categoryData['megnevezes']."</a></td>");
                                if($num % 5 == 0){
                                    print("</tr><tr>");
                                }
                            }
                            print("</tr>");
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- Portfolio Grid-->
        <section class="page-section bg-light" id="movies">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Filmek</h2>
                </div>
                
                <div class="row row-cols-1 row-cols-md-5 g-4" id="film-cards">
                    <?php 
                    if(isset($_GET['category-id'])){
                        $movies = getMoviesByCategoryId();
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
                <a class="btn btn-primary btn-xl text-uppercase float-end m-3" href="movies.php">Tovább</a>
            </div>  
        </section>
        
        <!-- Clients-->
        <div class="py-5" id="contactUs">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Kapcsolatfelvétel</h2>
                    <p>Kérjük vegye fel velünk a kapcsolatot amennyiben hibát észlel oldalunkon vagy más probléma merül fel!</p>
                    <ul style="list-style: none;">
                        <li>email: movie@channel.com</li>
                        <li>telefon: +36 30 147 2589</li>
                    </ul>
                </div>
                
            </div>
        </div>
        
        
<?php require_once 'footer.php'; ?>