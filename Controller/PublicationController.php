<?php


/*---------------------------------------------------------------------------------------
 * -------------------------- FORMULAIRE AJOUT/MODIFICATION -----------------------------
 ---------------------------------------------------------------------------------------*/
if ($page === 'formPublication'){
    $listeThematique = THEMATIQUE::selectAllThematique();
    include 'vue/new-publication.php';
}

/*---------------------------------------------------------------------------------------
 * -------------------------- AJOUT -----------------------------------------------------
 ---------------------------------------------------------------------------------------*/
else if ($page === 'ajoutPublication'){
    if (verifier_token($referer)){
        $publication["titre"] = filter_input(INPUT_POST,"titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $publication["contenu"] = filter_input(INPUT_POST,"contenu", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $publication["id_user"] = $_SESSION['user']['id_user'];
        $publication["path_media"] = filter_input(INPUT_POST,"media", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $publication["id_thematique"]= filter_input(INPUT_POST,"thematique", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($publication["path_media"] && $publication["titre"] && $publication["contenu"] && $publication["id_user"] && $publication["id_thematique"]){
            Publication::createPublication($publication["titre"],$publication["contenu"],$publication["id_user"],$publication["path_media"],$publication["id_thematique"]);
            upload();
            header('Location: http://localhost/wikhitema/index.php?page=index');
        }
        else if ($publication["titre"] && $publication["contenu"] && $publication["id_user"] && $publication["id_thematique"]){
            Publication::createPublication($publication["titre"],$publication["contenu"],$publication["id_user"],NULL,$publication["id_thematique"]);
            header('Location: http://localhost/wikhitema/index.php?page=index'); 
        }else{
            $_SESSION["user"]["error"]=" Nous n'avonns pas pu ajouter une publication, veuillez réessayer s'il vous plait";
        }
    }
}
// FONCTION PERMETTANT D'AJOUTER UN MEDIA
//NON FONCTIONNEL
else if ($page === "ajoutMedia"){
    if (isset($_FILES['media']) AND $_FILES['media']['error'] == 0)
    {
        // Testons si le fichier n'est pas trop gros
        if ($_FILES['media']['size'] <= 1000000)
        {
            // Testons si l'extension est autorisée
            $infosfichier = pathinfo($_FILES['media']['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png', 'mp3');
            if (in_array($extension_upload, $extensions_autorisees))
            {
                // On peut valider le fichier et le stocker définitivement
                move_uploaded_file($_FILES['media']['tmp_name'], '../uploads/' . basename($_FILES['media']['name']));
                echo "L'envoi a bien été effectué !";
            }
        }
    }
}
/*---------------------------------------------------------------------------------------
 * -------------------------- MODIFICATION ----------------------------------------------
 ---------------------------------------------------------------------------------------*/
else if ($page ==='modifPublications'){
    $listeThematique = THEMATIQUE::selectAllThematique();
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);  
    $publication = Publication::selectPublication($id);
    if ($id !== '' && $id !== NULL && ($publication['id_user']===$_SESSION['user']['id_user'] || $_SESSION['user']['role']==1)){
        include_once 'vue/new-publication.php';
    }
    else{
        $_SESSION['user']['error']="Vous n'avez pas l'accès à cette page.";
        header('Location: http://localhost/wikhitema/index.php?page=index');
    }
}
else if ($page == 'modifierPublication'){
    $publication["titre"] = filter_input(INPUT_POST,"titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $publication["contenu"] = filter_input(INPUT_POST,"contenu", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $publication["id_user"] = $_SESSION['user']['id_user'];
    $publication["path_media"] = filter_input(INPUT_POST,"media", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $publication["id_thematique"]= filter_input(INPUT_POST,"thematique", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $publication["id_publication"] = filter_input(INPUT_POST,"id", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    Publication::updatePublication($publication["id_publication"], $publication);
    header('Location: http://localhost/wikhitema/index.php?page=index');
}

/*---------------------------------------------------------------------------------------
 * -------------------------- SUPPRESSION -----------------------------------------------
 ---------------------------------------------------------------------------------------*/
else if ($page ==='supprPublications'){
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $publication = Publication::selectPublication($id);
    if ($id !== '' && $id !== NULL && ($publication['id_user']===$_SESSION['user']['id_user'] || $_SESSION['user']['role']==1)){
        Publication::deletePublication($id);
        header('Location: http://localhost/wikhitema/index.php?page=index'); 
    }
    else{
        $_SESSION['user']['error']="Nous n'avons pas pus supprimer la publication, veuillez réessayer";
        header('Location: http://localhost/wikhitema/index.php?page=index');
    }
}


/*---------------------------------------------------------------------------------------
 * -------------------------- RECHERCHE PAR THEME ---------------------------------------
 ---------------------------------------------------------------------------------------*/
elseif ($page === 'publications-cat') {
    $option = filter_input(INPUT_GET, 'cat', FILTER_VALIDATE_INT);
    if (isset($option) && $option!=false){
        $publications = Publication::selectPublicationByCat($option);
        include 'vue/publications-cat.php';
    }
    else{
        header('Location: http://localhost/wikhitema/index.php?page=index'); 
    }

}

/*---------------------------------------------------------------------------------------
 * -------------------------- RECHERCHE PAR ID ---------------------------------------
 ---------------------------------------------------------------------------------------*/
elseif ($page === 'afficherPublication') {
    $option = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if (isset($option) && $option!=false){
        $publication = Publication::selectPublication($option);
        $publication ['pseudo'] = User::selectUserById($publication['id_user'])->to_array()['pseudo'];
        include 'vue/blog-post.php';
    }
    else{
        header('Location: http://localhost/wikhitema/index.php?page=index'); 
    }

}

/*---------------------------------------------------------------------------------------
 * -------------------------- RECHERCHE GLOBALE -----------------------------------------
 ---------------------------------------------------------------------------------------*/
else if ($page === "recherchePublication"){
    $recherche = filter_input(INPUT_POST, "recherche", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $publications = Publication::recherchePublications($recherche);
    include_once 'vue/publicationsRecherche.php';
}