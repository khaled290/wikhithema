<?php
if ($page === 'formThematique' && $_SESSION['user']['role'] == 1) {
    $listeThematique = THEMATIQUE::selectAllThematique();
    include 'vue/admin-thematiques.php';
} else if ($_SESSION['user']['role'] == 1 && $page === 'modifierThematique') {
    $thematique["id_thematique"] = filter_input(INPUT_POST, "id_thematique", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $thematique["nom"] = filter_input(INPUT_POST, "titre_thematique", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (empty($thematique["nom"])) {
        echo "<style color='red'>Name field is empty.</style><br/>";
    } else {
        thematique::updateThematique($thematique["id_thematique"], $thematique["nom"]);
        header('Location: http://localhost/wikhitema/index.php?page=index');
    }
} else if ($_SESSION['user']['role'] == 1 && $page === 'ajoutThematique') {
    $thematique["nom"] = filter_input(INPUT_POST, "titre_thematique", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if ($thematique["nom"]) {
        echo thematique::createThematique($thematique["nom"]);
        header('Location: http://localhost/wikhitema/index.php?page=formThematique');
    } else {
        [$_SESSION["user"]["pseudo"], " Nous n'avonns pas pu ajouter une publication, veuillez réessayer s'il vous plait"];
    }
}
