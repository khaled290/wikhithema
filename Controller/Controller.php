<?php
session_start();

$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


require_once 'UserController.php';

//require_once 'ThematiqueController.php';

