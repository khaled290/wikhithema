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
    <link rel="stylesheet" type="text/css" href="css/admin-style.css">
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

    <section class="container-infos-user">
    	<h2 class="text-center">Modifiez les champs que vous voulez mettre à jour</h3><br><br>
		<div class="row row-sm-offset-3">
            <div class="col-xs-12 col-sm-6">
                <form>
                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control" autofocus/>
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-info add-thematique">Ajouter la thématique</button>
                        </span>
                    </div>                      
                </form><br><br><hr><hr>
                <form class="loginForm" action="" autocomplete="off" method="POST" id="modifThematique">
                    <div class="input-group">
                        <span class="bg-info zone-title-thematique">Thematique machin truc</span>
                        <input class="btn btn-warning btn-modif" value="Modifier la thématique"></input>
                    </div><hr>
                    <button class="btn btn-info">Envoyer les modifications</button>
                    <span class="help-block"></span>
                </form>
            </div>
        </div>

    </section>

    <style type="text/css">
    	h1 {
    		color: #993333;
    	}
    	.btn-primary {
    		display: none;
    	}
    </style>
    <script type="text/javascript">
        $('#modifThematique').on('click','.btn-modif',function() {
            $(this).siblings().each(
                function(){
                    if ($(this).find('input').length){
                        $(this).text($(this).find('input').val());
                    }
                    else {
                        var t = $(this).text();
                        $(this).html($('<input />',{'value' : t}).val(t));
                    }
                });
        });

    </script>
</body>
</html>