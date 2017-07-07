<?php
//On vérifie que l'utilisateur est connecté pour afficher la page (toutes les pages sauf inscription et connexion l'ont
if (isset($_SESSION['user']['pseudo'])) {
    if ($_SESSION['user']['role']<3){
        if (isset($listeThematique)) {
        $token = generer_token();
        include('header.inc.php');
        ?>

        <section class="container-wiki-text-editor">
            <h2 class="title-new-publication">Création d'une nouvelle publication</h2><br>

                  
            <form action="index.php?page=ajoutPublication" name="textEditor" id="textEditor" method="post">
                <div class="form-group">
                    <label for="publicationTitle">Titre de votre publication</label>
                    <input type="text" name="titre" class="form-control" id="publicationTitle"
                           placeholder="EX: quelque chose blabla">
                </div>
                <br>
                <div class="form-group">
                    <label for="zone-text">Mise en texte</label>
                    <div id="form-group">
                        <input class="btn btn-text-format" type="button" onClick="iHorizontalRule()" value="HR"> 
                        <input class="btn btn-text-format" type="button" onClick="iBold()" value="B">
                        <input class="btn btn-text-format" type="button" onClick="iUnderline()" value="U">
                        <input class="btn btn-text-format" type="button" onClick="iItalic()" value="I">
                        <input class="btn btn-text-format" type="button" onClick="iFontSize()" value="Text Size">
                        <input class="btn btn-text-format" type="button" onClick="iForeColor()" value="Text Color">
                        <input class="btn btn-text-format" type="button" onClick="iHorizontalRule()" value="HR">
                        <input class="btn btn-text-format" type="button" onClick="iUnorderedList()" value="Liste : 1.">
                        <input class="btn btn-text-format" type="button" onClick="iOrderedList()" value="Liste : •">
                        <input class="btn btn-text-format" type="button" onClick="iLink()" value="Link">
                        <input class="btn btn-text-format" type="button" onClick="iUnLink()" value="UnLink">

                    </div>
                    <br><br>
                    <!-- Hide(but keep)your normal textarea and place in the iFrame replacement for it -->
                    <textarea style="display:none;" name="contenu" id="zone-saisie" cols="100" rows="14"></textarea>
                    <iframe name="richTextField" id="richTextField"
                            style="border:#000000 1px solid; width:100%; height:300px;"></iframe>
                    <!-- End replacing your normal textarea -->
                </div>
                <br>
                <?php
                echo "<select id='select' name='thematique'>";
                foreach ($listeThematique as $thematique) {
                    echo "<option value=" . $thematique['id_thematique'] . ">" . $thematique['nom'] . "</option>";
                }
                echo "</select>";
                ?>
                <div class="form-group">
                    <label for="fileUpload">Charger un fichier (optionnel)</label>
                    <input type="file" id="fileUpload" name="media" id="pathMedia"/>
                    <p class="help-block">Formats acceptés : mp3, jpeg</p>
                </div>
                <input type="hidden" name="token" id="token" value="<?php
                //Le champ caché a pour valeur le jeton
                echo $token;
                ?>"/>
                <br>
                <input class="btn btn-primary" name="btnSubmit" type="button" value="Publier"
                       onClick="javascript:submit_form();"/>
            </form>
        </section>

        <!-- jQuery -->
        <script src="vue/js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="vue/js/bootstrap.min.js"></script>
        <script src="vue/js/text-editor.js"></script>
        </html>
        <?php

        } else {
            header('Location: http://localhost/wikhitema/index.php?page=index');
        }
    
    }else {
        $_SESSION['user']['error']="Vous n'avez pas les droits pour publier quelque chose.";
        header('Location: http://localhost/wikhitema/index.php?page=index');
    }
} else {
    header('Location: http://localhost/wikhitema/index.php?page=connect');
}