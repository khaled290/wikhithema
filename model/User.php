<?php
require_once 'connect.php';

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
    
    public function getId_user() {
        return $this->id_user;
    }

    public function getPseudo() {
        return $this->pseudo;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getMdp() {
        return $this->mdp;
    }

    public function getRole() {
        return $this->role;
    }

    public function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setMdp($mdp) {
        $this->mdp = $mdp;
    }

    public function setRole($role) {
        $this->role = $role;
    }
    
    public function createUser ($pseudo, $email, $mdp, $role){
        global $pdo;
        $pseudo = filter_var($pseudo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $mdp = filter_var($mdp, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $role = filter_var($role, FILTER_VALIDATE_INT);
        
        if ($pseudo && $email && $mdp && $role){
            $requete="INSERT INTO user VALUES (default , ?, ?, ?, ?);";
            $pdo->prepare($requete);
            $rowCount = $pdo->execute(array($pseudo, $email, $mdp, $role));
        }
    }
    
    public function deleteUser ($id_user){
        global $pdo;
        $requete= "DELETE FROM user WHERE id = ?";
        $pdo->prepare($requete);
        $rowCount = $pdo->execute(array($id_user));
    }
    
    public function updateUser($id_user, Array $user){
        global $pdo;
        
        $requete = "UPDATE user SET pseudo= ?, email= ?, mdp= ?, role= ?";
        $pdo->prepare($requete);
        
        //Les lignes suivantes sont des conditions ternaire, cela permet d'aller plus vite
        //Et pour notre cas je trouve ça plus simple à comprendre... Si la nouvelle valeur est vide, on met l'ancienne
        $isPseudoChanged = !empty($user->pseudo) || $user->pseudo === NULL || $user->pseudo !== $this->getPseudo() || $user->pseudo !== '';
        $pseudo = $isPseudoChanged && filter_var($user->pseudo, FILTER_SANITIZE_FULL_SPECIAL_CHARS) ? $user->pseudo : $this->getPseudo();
        
        $isEmailChanged = !empty($user->email) || $user->email === NULL || $user->email !== $this->getEmail() || $user->email !== '';
        $email = $isEmailChanged && filter_var($user->email, FILTER_SANITIZE_EMAIL) ? $user->email : $this->getEmail();
        
        $isMdpChanged = !empty($user->mdp) || $user->mdp === NULL || $user->mdp !== $this->getMdp() || $user->mdp !== '';
        $mdp = $isMdpChanged && filter_var($user->mdp) ? $user->mdp : $this->getMdp();
        
        $isRoleChanged = !empty($user->role) || $user->role === NULL || $user->role !== $this->getRole() || $user->role !== '';
        $role = $isRoleChanged && filter_var($user->role, FILTER_VALIDATE_INT) ? $user->role : $this->getRole();
        
        $rowCount = $pdo->execute(array($pseudo, $email, $mdp, $role, $id_user));
    }
}
