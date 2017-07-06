<?php
//On vérifie que l'utilisateur est connecté pour afficher la page (toutes les pages sauf inscription et connexion l'ont
if (isset($_SESSION['user']['pseudo'])){
    if(isset($page)&&isset($option) && isset($publications)){
        include('header.inc.php');
?>

    <!-- Page Content -->
    <div class="container container-publications">

 
        <!-- /.row -->

        <!-- Blog Post Row -->
        <div class="row">
            
            
            <hr>
            <?php 
            $numPage = filter_input(INPUT_GET, 'numPage', FILTER_SANITIZE_NUMBER_INT);
            $numPage = isset($numPage) ? $numPage : 1 ;
            for($i=($numPage*4-1); $i< (($numPage)*4); $i++){ 
               $publication = $publications[$i];
            ?>
           
            <article class="col-md-6">
                <h3><a href="file:///C:/Users/LAM/Desktop/Wiki-Project/bootstrap/blog-post.php" class="titre-article-link"> <?php echo $publication['titre']; ?></a></h3>
                <span><strong>Date de mise à jour :</strong> <?php echo date_format(date_create($publication['date']), 'd/m/Y H:i' ) ?></span>
                <p>
                    <?php echo $publication['contenu']; ?>
                </p>
                <?php if(($_SESSION['user']['id_user']===$publication['id_user'] && $_SESSION['user']['role'] < 3) || $_SESSION['user']['role']==1) {
                    ?>
                    <a href="index.php?page=modifPublications&id=<?php echo $publication['id_publication']; ?>" class="btn btn-default" >modifier</a> 
                    <a href="index.php?page=supprPublications&id=<?php echo $publication['id_publication']; ?>" class="btn btn-default" >supprimer</a>
                <?php
                } 
                //var_dump($_SESSION['user']);
                    ?>
            </article>
            
            
            <?php 
            if ($i%4>1){
                echo '<hr>';
            }
            
            } ?>

            

        </div>
        <!-- /.row -->
        <hr>

        <div class="row text-center">
            <nav aria-label="Page navigation">
              <ul class="pagination">
                <li>
                  <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <li><a class="active" href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li>
                  <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav>
        </div>


        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>WikHiTema - 2017</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="vue/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vue/js/bootstrap.min.js"></script>

</body>

</html>
<?php 
    }else{
        header('Location: http://localhost/wikhitema/index.php?page=index');
    }
}

else{
    header('Location: http://localhost/wikhitema/index.php?page=connect');
}