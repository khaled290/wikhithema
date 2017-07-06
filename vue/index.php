<?php
//On vérifie que l'utilisateur est connecté pour afficher la page (toutes les pages sauf inscription et connexion l'ont

if (isset($_SESSION['user']['pseudo'])){
        if (isset($publications) && isset($thematiques)){
            include('header.inc.php');
?>
    <!-- Page Content -->
    <div class="container">

        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Catégories de publications</h1>
            </div>
            <?php foreach ($thematiques as $thematique){ ?>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="<?php  ?>"></i> <?php echo $thematique['nom']; ?></h4>
                    </div>
                    <div class="panel-body">
                        <a href="index.php?page=publications-cat&cat=<?php echo $thematique['id_thematique']; ?>" class="btn btn-default"> Voir les publications</a>
                    </div>
                </div>
            </div>
            <?php  }?>
        </div>
        <!-- /.row -->

        <!-- Features Section -->
        
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Dernieres publications</h2>
            </div>
            <?php 
                for ($i=0; $i<2 && $i< count($publications); $i++) {  
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
            <?php } ?>
        </div>
        
        <!-- /.row -->

        <hr><br><br>

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

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>

</html>
<?php }
    //Si les variables publications et thematiques ne sont pas présentes, on redirige
    else{
        header('Location: http://localhost/wikhitema/index.php?page=index');
    }
}
else{
    header('Location: http://localhost/wikhitema/index.php?page=connect');
}