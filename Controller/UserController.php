<?php



/*---------------------------------------------------------------------------------------
 * -------------------------- USER CONTROLLER -------------------------------------------
 ---------------------------------------------------------------------------------------*/



/*---------------------------------------------------------------------------------------
 * -------------------------- CONNEXION -------------------------------------------------
 ---------------------------------------------------------------------------------------*/
if ($page === 'connect') {
    if (!isset($_SESSION["user"]["pseudo"])) {
        include 'vue/connexion.php';
    } else {
        header('Location: http://localhost/wikhitema/index.php?page=index');
    }
} else if ($page === 'connexion') {
    $login = filter_input(INPUT_POST, "login", FILTER_SANITIZE_EMAIL);
    $mdp = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

    if (isset($login) && $login !== false) {
        $_SESSION["user"] = USER::connexion($login, $mdp);
        if ($_SESSION["user"] === false) {
        } else {
            $_SESSION["user"] = $_SESSION["user"]->to_array();
        }
    } else {
        $_SESSION["user"]["error"] = "Nous ne pouvons pas vous connecter avec les informations saisies, veuillez réessayer.";
    }

    if ($_SESSION["user"] === false) {
        include 'vue/connexion.php';
    } else {
        include 'vue/index.php';
    }
} 

/*---------------------------------------------------------------------------------------
 * -------------------------- DECONNECION -----------------------------------------------
 ---------------------------------------------------------------------------------------*/
else if ($page === 'deconnexion') {
    session_destroy();
    header('Location: http://localhost/wikhitema/index.php?page=connect');
}

/*---------------------------------------------------------------------------------------
 * -------------------------- INSCRIPTION -----------------------------------------------
 ---------------------------------------------------------------------------------------*/
else if ($page === 'formInscription') {
    include_once 'vue/inscription.php';
} 
else if ($page === 'inscription') {
    $user["pseudo"] = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $user["email"] = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $user["mdp"] = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    $user["mdpConfirme"] = filter_input(INPUT_POST, "passwordConfirm", FILTER_SANITIZE_STRING);

    if ($user["mdp"] !== $user["mdpConfirme"]) {
        echo [$user["pseudo"] && $user["email"], "Les mots de passes sont différents"];
    } else {
        unset($user["mdpConfirme"]);
        if (User::selectUserByEmail($user["email"])->getEmail() === $user["email"]) {
            $email = true;
            include_once 'vue/user.php';
        } else if (User::selectUserByPseudo($user["pseudo"])->getPseudo() === $user["pseudo"]) {
            $pseudo = true;
            include_once 'vue/inscription.php';
        } else {
            if ($user["pseudo"] && $user["email"] && $user["mdp"]) {
                if ($user["pseudo"] && $user["email"] && $user["mdp"]) {
                    echo USER::createUser($user["pseudo"], $user["email"], $user["mdp"], 3);
                    header('Location: http://localhost/wikhitema/index.php?page=connect');
                } else {
                    include_once 'vue/inscription.php';
                }
            }
        }
    }

} 

/*---------------------------------------------------------------------------------------
 * -------------------------- SUPPRESSION -----------------------------------------------
 ---------------------------------------------------------------------------------------*/
else if ($page === 'supprimerCompte' && $_SESSION['user']['role'] == 1) {
    $listeUsers = User::selectAllUser();
    include 'vue/admin-users.php';

    $userDelete["id_user"] = filter_input(INPUT_POST, "id_user", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $PubUserDelete = Publication::selectPublicationByIdUser($userDelete["id_user"]);
    if (!empty($userDelete)) {
        updatePubli($PubUserDelete);
        User::deleteUser($userDelete["id_user"]);
    } else {
        [$_SESSION["user"]["pseudo"], " Nous n'avonns pas pu supprimer cette utilisateur, veuillez réessayer s'il vous plait"];
    }
} 

/*---------------------------------------------------------------------------------------
 * -------------------------- MODIFICATION -----------------------------------------------
 ---------------------------------------------------------------------------------------*/
else if ($page === 'formModifierCompte') {
    include_once 'vue/user.php';
} else if ($page === 'modifierCompte') {
    $referer = filter_input(INPUT_POST, "token", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (verifier_token($referer)) {
        $user["pseudo"] = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $user["email"] = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $user["mdp"] = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
        $user["mdpConfirme"] = filter_input(INPUT_POST, "passwordConfirme", FILTER_SANITIZE_STRING);
        $mdpChanged = $user["mdp"] !== '' && $user["mdpConfirme"] !== '' && $user["mdp"] !== NULL && $user["mdpConfirme"] !== NULL;
        if ($mdpChanged && $user["mdp"] !== $user["mdpConfirme"]) {
            $_SESSION['user']['error'] = "Les mots de passes sont différents";
            include_once 'vue/user.php';
        } else {
            unset($user["mdpConfirme"]);
            if (!$mdpChanged) {
                $user["mdp"] = NULL;
            }

            if (User::selectUserByEmail($user["email"])->getEmail() !== $_SESSION['user']['email'] && User::selectUserByEmail($user["email"])->getEmail() === $user["email"]) {
                $email = true;
                include_once 'vue/user.php';
            } else if (User::selectUserByPseudo($user["pseudo"])->getPseudo() !== $_SESSION['user']['pseudo'] && User::selectUserByPseudo($user["pseudo"])->getPseudo() === $user["pseudo"]) {
                $pseudo = true;
                include_once 'vue/user.php';
            } else {
                if ($user["pseudo"] != NULL || $user["email"] != NULL || $user["mdp"] != NULL) {
                    USER::updateUser($_SESSION['user']['id_user'], array(
                        "pseudo" => $user["pseudo"],
                        "email" => $user["email"],
                        "mdp" => $user["mdp"],
                        "role" => $_SESSION['user']['role']
                    ));
                    $_SESSION['user'] = User::selectUserByPseudo($user["pseudo"])->to_array();
                    header('Location: http://localhost/wikhitema/index.php?page=formModifierCompte');
                } else {
                    include_once 'vue/user.php';
                }
            }
        }
    } else {
        $_SESSION['user']['error'] = 'le token n\'a pas passer la vérification, veuillez réessayer l\'opération.';
        include_once 'vue/user.php';
    }
}



/*---------------------------------------------------------------------------------------
 * -------------------------- FONCTION UTILES -------------------------------------------
 ---------------------------------------------------------------------------------------*/

//FONCTION UTILISEE DANS LA SUPPRESSION D'UN UTILISATEUR POUR CHANGER LE CREATEUR DES
//PUBICATIONS QUI LUI SONT ATTACHEE
function updatePubli($publi)
{
    var_dump($publi);
    if (!empty($publi)) {
        foreach ($publi as $delete) {
            Publication::updatePubDelUser($delete["id_publication"]);
        }
    }
}