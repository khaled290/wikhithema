<?php
include_once 'connect.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class User {
    private $id_user;
    private $pseudo;
    private $email;
    private $mdp;
    private $role;
    
    function getId_user() {
        return $this->id_user;
    }

    function getPseudo() {
        return $this->pseudo;
    }

    function getEmail() {
        return $this->email;
    }

    function getMdp() {
        return $this->mdp;
    }

    function getRole() {
        return $this->role;
    }

    function setId_user($id_user) {
        $this->id_user = $id_user;
    }

    function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setMdp($mdp) {
        $this->mdp = $mdp;
    }

    function setRole($role) {
        $this->role = $role;
    }
    
    function createUser ($pseudo, $email, $mdp, $role){
        $pseudo = filter_var($pseudo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $mdp = filter_var($mdp, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        
    }
}
