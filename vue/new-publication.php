<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="meilleur wiki au monde - WikHiTema">
    <meta name="author" content="AMLYS KHALED JASON">
    <title>WikHiTema -- Compte utilisateur</title>
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/wiki-style.css">
    <link href="../vue/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../vue/css/wiki-style.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
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
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Catégories <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="publications-cat.php">Informatique</a>
                            </li>
                            <li>
                                <a href="publications-cat.php">High Tech</a>
                            </li>
                            <li>
                                <a href="publications-cat.php">Sport</a>
                            </li>
                            <li>
                                <a href="publications-cat.php">Cuisine</a>
                            </li>
                            <li>
                                <a href="publications-cat.php">Managment</a>
                            </li>
                            
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Compte <b class="caret"></b></a>
                        <ul class="dropdown-menu">
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

    <section class="container-wiki-text-editor">
        <form action="../Controller/Controller.php?page=ajoutMedia" method="post" enctype="multipart/form-data">
            <p>
                Formulaire d'envoi de fichier :<br />
                <input type="file" name="media" /><br />
                <input type="submit" value="Envoyer le fichier" />
            </p>
        </form>
        <form class="" action="../Controller/UserController.php?page=ajoutPublication" autocomplete="on" method="POST">

            <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span>
                <input type="text" size="25" class="form-control " name="" placeholder="" autofocus autocomplete="on" required>
            </div>
            <span class="help-block"></span>

            <?php
            echo "<select id='select'>";
            foreach ($listeThematique as $thematique) {
                    echo "<option value=".$thematique['id_thematique'].">".$thematique['nom']."</option>";
            }
            echo "</select>";
            ?>
            <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span>
                <textarea name="" id =""></textarea>
            </div>

            <button class="btn btn-lg btn-success btn-block" type="submit">Ajout publication</button>
        </form>
    </section>
</body>
</html>