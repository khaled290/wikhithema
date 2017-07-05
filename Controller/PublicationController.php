<?php

if ($page === 'formPublication'){
    $listeThematique = THEMATIQUE::selectAllThematique();
    include '../vue/new-publication.php';

}
else if ($page === 'ajoutPublication'){
    $publication["titre"] = filter_input(INPUT_POST,"titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $publication["contenu"] = filter_input(INPUT_POST,"contenu", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $publication["id_user"] = $_SESSION['user']['id_user'];
    $publication["path_media"] = filter_input(INPUT_POST,"media", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $publication["id_thematique"]= filter_input(INPUT_POST,"thematique", FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    if ($publication["path_media"] && $publication["titre"] && $publication["contenu"] && $publication["id_user"] && $publication["id_thematique"]){
        echo Publication::createPublication($publication["titre"],$publication["contenu"],$publication["id_user"],$publication["path_media"],$publication["id_thematique"]);
        upload();
    }
    else if ($publication["titre"] && $publication["contenu"] && $publication["id_user"] && $publication["id_thematique"]){
        echo Publication::createPublication($publication["titre"],$publication["contenu"],$publication["id_user"],NULL,$publication["id_thematique"]);
    }else{
        [$_SESSION["user"]["pseudo"]," Nous n'avonns pas pu ajouter une publication, veuillez réessayer s'il vous plait"];
    }

}
function upload(){
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
