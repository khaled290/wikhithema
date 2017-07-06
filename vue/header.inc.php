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
                        <a href="index.php?page=formPublication" class="btn-new-post">Ajouter une publication</a>
                    </button>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Catégories <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php foreach($thematiques as $thematique){ ?>
                        <li>
                            <a href="index.php?page=publications&cat=<?php echo $thematique['id_thematique']; ?>"><?php echo $thematique['nom']; ?></a>
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