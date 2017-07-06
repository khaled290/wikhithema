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
            for($i=($numPage-1); $i< (($numPage)*4); $i++){ ?>
                <div class="col-md-6">
                    <h3>
                        <a href="blog-post.php">Titre publication</a>
                    </h3>
                    <p>Publié par <strong>User</strong> dans la catégorie <strong>Informatique</strong></p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                    <a class="btn btn-primary" href="blog-post.php">Lire l'article <i class="fa fa-angle-right"></i></a>
                </div>
            
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