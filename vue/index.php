<?php
//On vérifie que l'utilisateur est connecté pour afficher la page (toutes les pages sauf inscription et connexion l'ont
if (isset($_SESSION['user']['pseudo'])){
        if (isset($publications) && isset($thematiques)){
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="meilleur wiki au monde - WikHiTema">
    <meta name="author" content="AMLYS KHALED JASON">
    <title>WikHiTema</title>
    <link href="../vue/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../vue/css/wiki-style.css">
    <link href="../vue/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../vue/css/wiki-blog-articles.css">
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand logo" href="index.php">WikHiTema</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <button class="btn btn-warning add-publication-btn">
                            <a href="../Controller/Controller.php?page=formPublication" class="btn-new-post">Ajouter une publication</a>
                        </button>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Catégories <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?php foreach($thematiques as $thematique){ ?>
                            <li>
                                <a href="../Controller/Controller.php?page=publications&cat=<?php echo $thematique['id_thematique']; ?>"><?php echo $thematique['nom']; ?></a>
                            </li>     
                            <?php  }?>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Compte <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                Pseudo : <?php echo $_SESSION['user']['pseudo']; ?>
                            </li>
                            <li>
                                <a href="index.php">Parametres</a>
                            </li>
                            <li>
                                <a href="index.php">Mes publication</a>
                            </li>
                            <li>
                                <a href="index.php">Déconnexion</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


    <!-- Page Content -->
    <div class="container">

        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Catégories de publications
                </h1>
            </div>
            <?php foreach ($thematiques as $thematique){ ?>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="<?php  ?>"></i> <?php echo $thematique['nom']; ?></h4>
                    </div>
                    <div class="panel-body">
                        <a href="../Controller/Controller.php?page=publications&cat=<?php echo $thematique['id_thematique']; ?>" class="btn btn-default"> Voir les publications</a>
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
                <p>
                    <?php echo $publication['contenu']; ?>
                </p>
                <?php if($_SESSION['user']['id_user']===$publication['id_user'] && $_SESSION['user']['role'] === 2 || $_SESSION['user']['role']===1) {
                    ?>
                        
                    <?php
                } 
                var_dump($_SESSION['user']);
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
    <script src="../vue/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vue/js/bootstrap.min.js"></script>

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
        header('Location: http://localhost/wikhitema/Controller/Controller.php?page=index');
    }
}
else{
    header('Location: http://localhost/wikhitema/vue/connexion.php');
}