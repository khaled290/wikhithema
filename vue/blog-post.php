<?php
session_start();
//On vérifie que l'utilisateur est connecté pour afficher la page (toutes les pages sauf inscription et connexion l'ont
if (isset($_SESSION['user']['pseudo'])) {
    include('header.inc.php');
    ?>


    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Titre articles
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
                <p><i class="fa fa-clock-o"></i> Publié le 04/07/2017 par User</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut,
                    error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni
                    recusandae laborum minus inventore?</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos
                    iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat.
                    Temporibus, voluptatibus.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, doloribus, dolorem iusto blanditiis
                    unde eius illum consequuntur neque dicta incidunt ullam ea hic porro optio ratione repellat
                    perspiciatis. Enim, iure!</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas
                    placeat totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem
                    obcaecati?</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo,
                    aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam
                    recusandae? Qui, necessitatibus, est!</p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
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

                <!-- Posted Comments -->

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <!--<img class="media-object" src="http://placehold.it/64x64" alt="">-->
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Auteur
                            <small>Publié le 04/07/2017</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin
                        commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum
                        nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>

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
<?php } else {
    header('Location: http://localhost/wikhitema/index.php?page=connect');
}