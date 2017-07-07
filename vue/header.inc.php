<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="meilleur wiki au monde - WikHiTema">
    <meta name="author" content="AMLYS KHALED JASON">
    <title>WikHiTema</title>
    <link href="vue/css/bootstrap.css" rel="stylesheet">
    <link href="vue/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="vue/css/wiki-style.css">
    <link rel="stylesheet" type="text/css" href="vue/css/wiki-blog-articles.css">
    <link rel="stylesheet" type="text/css" href="vue/css/admin-style.css">
</head>

<body onLoad="iFrameOn();">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header mobile-menu">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand logo" href="index.php"><i class="fa fa-graduation-cap" aria-hidden="true"></i> WikHiTema</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left ">
                    <form action="index.php?page=recherchePublication" method="POST" class="input-group input-group-md zone-search col-xs-12">
                        <input type="text" name="recherche" id="recherche" class="form-control col-xs-8" autofocus/>
                        <button type="submit" class="btn btn-info col-xs-2"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown" <?php if ($_SESSION['user']['role'] == 3){ ?>
                            disabled="disabled"
                         <?php } ?>>
                         <?php if ($_SESSION['user']['role'] < 3){ ?>
                            <a href="index.php?page=formPublication" class="btn-new-post">
                         <?php } ?> 
                         <button class="btn btn-warning add-publication-btn">
                                Ajouter une publication                            
                        </button>
                        <?php if ($_SESSION['user']['role'] < 3){ ?>
                            </a>
                        <?php } ?>
                    </li>


                    <li class="dropdown">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Compte <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Profil</li>
                            <li>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pseudo : <?php echo $_SESSION['user']['pseudo']; ?>
                            </li>
                            <?php if ($_SESSION['user']['role']==2){ ?>
                            <li>
                                <a href="index.php">Mes publications</a>
                            </li>
                            <?php } ?>
                            <li>
                                <a href="index.php?page=formModifierCompte">Parametres</a>
                            </li>
                            
                            <?php if ($_SESSION['user']['role']==1){ ?>
                            <li class="dropdown-header">Administration</li>
                            <li>
                                <a href="index.php?page=supprimerCompte">Gestion des utilisateurs</a>
                            </li>
                            <?php } ?>
                            <?php if ($_SESSION['user']['role']==1){ ?>
                            <li>
                                <a href="index.php?page=formThematique">Gestion des thématiques</a>
                            </li>
                            <?php } ?>
                            <li>
                                <a href="index.php?page=faq">Aide ?</a>
                            </li>
                            <li>
                                <a href="index.php?page=deconnexion">Déconnexion</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="col-xs-12 zone-search-mobile">
        <center>
            <form action="index.php?page=recherchePublication" method="POST" class="input-group input-group-md">
                <input type="text" name="recherche" id="recherche" class="form-control col-xs-8 to-left" autofocus/>
                <button type="submit" class="btn btn-info col-xs-2 to-right"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
        </center>
    </div>