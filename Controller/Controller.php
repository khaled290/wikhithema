<?php
session_start();
//session_destroy();
require 'model/Publication.php';
require 'model/thematique.php';
require 'model/User.php';

//ICI CA FONCTIONNE

$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$option = filter_input(INPUT_GET, 'otpion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);



require_once 'PublicationController.php';

require_once 'UserController.php';

require_once 'ThematiqueController.php';


if ($page === 'index'){
    
    $thematiques = thematique::selectAllThematique();
    
    $publications = Publication::selectAllPublication();
    
    require_once 'vue/index.php';
}


//Cette fonction génère, sauvegarde et retourne un token
//Vous pouvez lui passer en paramètre optionnel un nom pour différencier les formulaires
function generer_token($nom = '')
{
	$token = uniqid(rand(), true);
	$_SESSION[$nom.'_token'] = $token;
	$_SESSION[$nom.'_token_time'] = time();
	return $token;
}

function verifier_token($referer, $nom = '')
{
    $temps = 60*10;
    if(isset($_SESSION[$nom.'_token']) && isset($_SESSION[$nom.'_token_time']) && isset($_POST['token'])){
            if($_SESSION[$nom.'_token'] == $_POST['token']){
                    if($_SESSION[$nom.'_token_time'] >= (time() - $temps)){
                        return true;
                    }
            }
    }

    return false;
}