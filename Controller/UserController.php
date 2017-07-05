<?php

require '../model/User.php';
/**
 * Description of UserController
 *
 * @author jason
 */

if($page==='connexion'){
    $login = filter_input(INPUT_POST, "login", FILTER_SANITIZE_EMAIL);
    $mdp = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    
    if(isset($login) && $login !== false){
        $_SESSION["user"]=USER::connexion($login, $mdp)->to_array();  
    }else{
        $_SESSION["user"]["error"]="Nous ne pouvons pas accèder à votre requêtes avec les informations saisies, veuillez réessayer.";
    }
    
    if ($_SESSION["user"]===false){
        include '../vue/connexion.php';
    }
    else{
        include '../vue/index.php';
    }
}
else if ($page ==='inscription'){
    $user["pseudo"] = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $user["email"] = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $user["mdp"] = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    $user["mdpConfirme"] = filter_input(INPUT_POST, "passwordConfirm", FILTER_SANITIZE_STRING);
    
    if ($user["mdp"] !== $user["mdpConfirme"]){
        echo [$user["pseudo"] && $user["email"],"Les mots de passes sont différents"];
    }else{
        unset($user["mdpConfirme"]);
        if ($user["pseudo"] && $user["email"] && $user["mdp"]){
            echo USER::createUser($user["pseudo"], $user["email"], $user["mdp"]);
        }else{
            echo [$user["pseudo"] && $user["email"],"Nous n'avonns pas pu créer l'utilisateur, veuillez réessayer s'il vous plait"];
        }
    }
    header('Location: http://localhost/wikhitema/vue/connexion.php');
}
else if ($page === 'modification'){
    
}
else if ($page=== 'user'){
    
}
 else if ($page==='supprimerCompte'){
    
}