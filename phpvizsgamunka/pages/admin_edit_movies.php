<?php 
require './admin_menu.php';
if(isset($_GET['id'])){
    dbDeleteById($_GET['id']);
}
?>

<div class="container-fluid px-0 mb-3">
    <img src="../assets/img/movie-bg.jpg" alt="alt" width="100%"/>
</div>

<div class="container table-responsive" id="wrap-container">
    <table class="table table-striped table-hover text-center">
        <thead>
            <tr>
                <th scope="col">Cím</th>
                <th scope="col">Kiadás éve</th>
                <th scope="col">Értékelés</th>
                <th scope="col" colspan="2">Műveletek</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $allMovies = getMovies();
                while($allMovieData = mysqli_fetch_assoc($allMovies)){
                    if($allMovieData['torolve'] == "nem"){
                        print('<tr>
                            <td class="text-start ps-5">'.$allMovieData['cim'].'</td>
                            <td>'.$allMovieData['kiadas_eve'].'</td>
                            <td>'.$allMovieData['ertekeles'].'</td>
                            <td><a href="admin_movies_modification.php?id='.$allMovieData['id'].'"><button class="btn btn-warning">Módosítás</button></a></td>
                            <td><button class="btn btn-danger" id="wrap-delete" value="'.$allMovieData['id'].'" data-bs-toggle="modal" data-bs-target="#exampleModal'.$allMovieData['id'].'">Törlés</button></td>
                        </tr>
                        <div class="modal fade" id="exampleModal'.$allMovieData['id'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Törlés</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  Biztosan törölni szeretné az adott filmet?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezárás</button>
                                  <a href="admin_edit_movies.php?id='.$allMovieData['id'].'"><button type="submit" class="btn btn-danger" id="deleteMovie" data-bs-dismiss="modal">Törlés</button></a>
                                </div>
                              </div>
                            </div>
                          </div>');
                    }
                }
                
            ?>
        </tbody>
      </table>
</div>

<?php 
if(isset($deleteId)){
    dbDeleteById($deleteId);
}
require_once 'footer.php';
?>
