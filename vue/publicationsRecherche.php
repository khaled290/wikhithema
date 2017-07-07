<?php
//On vérifie que l'utilisateur est connecté pour afficher la page (toutes les pages sauf inscription et connexion l'ont
if (isset($_SESSION['user']['pseudo'])){
    if(isset($page) && isset($publications)){
        include('header.inc.php');
?>

    <!-- Page Content -->
    <div class="container container-publications">

 
        <!-- /.row -->

        <!-- Blog Post Row -->
        <div class="row">
            <?php 
            $numPage = filter_input(INPUT_GET, 'numPage', FILTER_SANITIZE_NUMBER_INT);
            $i=0;
                foreach($publications as $publication){ 
                    
           
            if ($i%4===0){
                echo '<hr>';
            }
            ?>
            <article class="col-md-6">
                <h3><a href="index.php?page=afficherPublication&id=&id=<?php echo $publication['id_publication']; ?>" class="titre-article-link"> <?php echo $publication['titre']; ?></a></h3>
                <span><strong>Date de mise à jour :</strong> <?php echo date_format(date_create($publication['date']), 'd/m/Y H:i' ) ?></span>
                <p>
                    <?php echo strlen($publication['contenu'])<300 ? $publication['contenu'] : substr($publication['contenu'], 0, 300).'...'; ?>
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
            $i++;
            } ?>

        </div>
        <!-- /.row -->
        <hr>


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