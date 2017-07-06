<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="meilleur wiki au monde - WikHiTema">
    <meta name="author" content="AMLYS KHALED JASON">
    <title>WikHiTema -- Compte utilisateur</title>
    <link href="vue/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="vue/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="vue/css/wiki-style.css">
    <script type="text/javascript" src="vue/js/text-editor.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>

<body onLoad="iFrameOn();">
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
        <h2 class="title-new-publication">Création d'une nouvelle catégorie</h2><br>
        <form action="index.php?page=creationThematique" name="thematique" id="thematique" method="post">
            
            <div class="form-group">
                <label for="publicationTitle">Titre de votre catégorie</label>
                <input type="text" class="form-control" id="publicationTitle" placeholder="EX: quelque chose blabla">
            </div>

            <input class="btn btn-primary btn-submit-publication" name="btnSubmit" type="button" value="Publier" onClick="javascript:submit_form();"/>
        </form>
    </section>
</body>
</html>