<?php
session_start();
require '../model/Publication.php';
require '../model/thematique.php';
require '../model/User.php';

$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

require_once 'PublicationController.php';

require_once 'UserController.php';

//require_once 'ThematiqueController.php';


if ($page === 'index'){
    
    $thematiques = thematique::selectAllThematique();
    
    $publications = Publication::selectAllPublication();
    
    require_once '../vue/index.php';
}