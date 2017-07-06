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
        <h2 class="title-new-publication">Création d'une nouvelle publication</h2><br>
        <form action="index.php?page=ajoutPublication" name="textEditor" id="textEditor" method="post">
            <div class="form-group">
                <label for="publicationTitle">Titre de votre publication</label>
                <input type="text" name="titre" class="form-control" id="publicationTitle" placeholder="EX: quelque chose blabla">
            </div>
            <br>
            <div class="form-group">
                <label for="zone-text">Mise en texte</label>
                <div id="zone-text form-group">
                  <input class="btn" type="button" onClick="iBold()" value="B">
                  <input class="btn" type="button" onClick="iUnderline()" value="U">
                  <input class="btn" type="button" onClick="iItalic()" value="I">
                  <input class="btn" type="button" onClick="iFontSize()" value="Text Size">
                  <input class="btn" type="button" onClick="iForeColor()" value="Text Color">
                  <input class="btn" type="button" onClick="iHorizontalRule()" value="HR"> 
                  <input class="btn" type="button" onClick="iUnorderedList()" value="UL">
                  <input class="btn" type="button" onClick="iOrderedList()" value="OL">
                  <input class="btn" type="button" onClick="iLink()" value="Link">
                  <input class="btn" type="button" onClick="iUnLink()" value="UnLink">

                </div><br><br>
                <!-- Hide(but keep)your normal textarea and place in the iFrame replacement for it -->
                <textarea style="display:none;" name="contenu" id="zone-saisie" cols="100" rows="14"></textarea>
                <iframe name="richTextField" id="richTextField" style="border:#000000 1px solid; width:100%; height:300px;"></iframe>
                <!-- End replacing your normal textarea -->
            </div>
            <br>
                <?php
                echo "<select id='select' name='thematique'>";
                foreach ($listeThematique as $thematique) {
                    echo "<option value=".$thematique['id_thematique'].">".$thematique['nom']."</option>";
                }
                echo "</select>";
                ?>
            <div class="form-group">
                <label for="fileUpload">Charger un fichier (optionnel)</label>
                <input type="file" id="fileUpload" name="media" >
                <p class="help-block">Formats acceptés : mp3, jpeg</p>
            </div>
            <br>
            <input class="btn btn-primary" name="btnSubmit" type="button" value="Publier" onClick="javascript:submit_form();"/>
        </form>
    </section>
</body>
</html>