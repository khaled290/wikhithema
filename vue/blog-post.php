<?php
//On vérifie que l'utilisateur est connecté pour afficher la page (toutes les pages sauf inscription et connexion l'ont
if (isset($_SESSION['user']['pseudo'])) {
    if (isset($publication) && $publication !== NULL){
    include('header.inc.php');
    ?>


    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $publication['titre']; ?>
                </h1>

            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <hr>

                <!-- Date/Time -->
                <p><i class="fa fa-clock-o"></i> Publié le <?php echo date_format(date_create($publication['date']), 'd/m/Y H:i' ); ?> par <?php echo $publication['pseudo']; ?></p>

                <hr>

                <!-- Preview Image -->
                <?php if (isset($publication['path_media'])&&$publication['path_media']!==NULL){ ?>
                <img class="img-responsive" src="<?php echo $publication['path_media']; ?>" alt="">

                <hr>
                <?php } ?>
                <!-- Post Content -->
                <p class="lead"><?php echo $publication['contenu']; ?></p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form 
                <div class="well">
                    <h4>Ecrire un commentaire :</h4>
                    <form role="form">
                        <div class="form-group">
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Commenter</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments 

                <!-- Comment
                <div class="media">
                    <a class="pull-left" href="#">
                        <!--<img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Auteur
                            <small>Publié le 04/07/2017</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin
                        commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum
                        nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>-->

            </div>

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
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    </body>

    </html>
<?php } else{
    header('Location: http://localhost/wikhitema/index.php?page=index');
}

}else {
    header('Location: http://localhost/wikhitema/index.php?page=connect');
}