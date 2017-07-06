<?php

require_once './Controller/Controller.php';

if (!isset($page)){
    header('Location: http://localhost/wikhitema/index.php?page=connect');
}