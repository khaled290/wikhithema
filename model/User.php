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
    
    public static function createUser ($pseudo, $email, $mdp, $role=3){
        global $pdo;
        $pseudo = filter_var($pseudo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $mdp = USER::cryptMdp(filter_var($mdp, FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $role = filter_var($role, FILTER_VALIDATE_INT);
        
        if ($pseudo && $email && $mdp && $role){
            $requete="INSERT INTO user VALUES (default , ?, ?, ?, ?);";
            $sth=$pdo->prepare($requete);
            $rowCount = $sth->execute(array($pseudo, $email, $mdp, $role));
            return $rowCount;
        }else{
            return array($pseudo, $email, $mdp, $role);
        }
    }
    
    public static function deleteUser ($id_user){
        global $pdo;
        
        $requete= "DELETE FROM user WHERE id = ?";
        $sth=$pdo->prepare($requete);
        $rowCount = $sth->execute(array($id_user));
        return $rowCount;
    }
    
    public static function updateUser($id_user, Array $user){
        global $pdo;
        $requete = "UPDATE user SET pseudo = ?, email = ?, mdp = ?, role = ? WHERE id_user = ?";
        $sth=$pdo->prepare($requete);
        
        $oldUser = USER::selectUser($id_user);
        
        $user["mdp"]=USER::cryptMdp($user["mdp"]);
        
        //Les lignes suivantes sont des conditions ternaire, cela permet d'aller plus vite
        //Et pour notre cas je trouve ça plus simple à comprendre... Si la nouvelle valeur est vide, on met l'ancienne
        $isPseudoChanged = !empty($user["pseudo"]) && $user["pseudo"] !== NULL && $user["pseudo"] !== $oldUser["pseudo"] && $user["pseudo"] !== '';
        $pseudo = $isPseudoChanged && filter_var($user["pseudo"], FILTER_SANITIZE_FULL_SPECIAL_CHARS) ? $user["pseudo"] : $oldUser["pseudo"];
        
        $isEmailChanged = !empty($user["email"]) && $user["email"] !== NULL && $user["email"] !== $oldUser["email"] && $user["email"] !== '';
        $email = $isEmailChanged && filter_var($user["email"], FILTER_SANITIZE_EMAIL) ? $user["email"] : $oldUser["email"];
        
        $isMdpChanged = !empty($user["mdp"]) && $user["mdp"] !== NULL && $user["mdp"] !== $oldUser["mdp"] && $user["mdp"] !== '';
        $mdp = $isMdpChanged && filter_var($user["mdp"]) ? $user["mdp"] : $oldUser["mdp"];
        
        $isRoleChanged = !empty($user["role"]) && $user["role"] !== NULL && $user["role"] !== $oldUser["role"] && $user["role"] !== '';
        $role = $isRoleChanged && filter_var($user["role"], FILTER_VALIDATE_INT) ? $user["role"] : $oldUser["role"];
        
        $rowCount = $sth->execute(array($pseudo, $email, $this->cryptMdp($mdp), $role, $id_user));
        return $rowCount;
    }
    
    public static function selectUser($id_user){
        global $pdo;
        $requete = "SELECT * FROM user where id_user = ?";
        $sth=$pdo->prepare($requete);
        $sth->execute(array($id_user));
        $rowCount=$sth->fetch(PDO::FETCH_ASSOC);
        return $rowCount;
    }
    
    public static function connexion($login, $mdp){
        global $pdo;
        //Je crypte le MDP de la même façon que celui en base pour pouvoir vérifier que c'est le même
        $mdpCrypt=USER::cryptMdp($mdp);
        
        if(strpos($login, '@')){
            $requete = "SELECT * FROM user WHERE email = ? and mdp = ?";
        }
        //On vérifie que l'association pseudo mdp renvoi bien l'utilisateur
        else{
            $requete = "SELECT * FROM user WHERE pseudo = ? and mdp = ?";
        }
        $sth = $pdo->prepare($requete);
        $sth->execute(array($login, $mdpCrypt));
        $user = $sth->fetch(PDO::FETCH_ASSOC);
        unset($user["mdp"]);
        return $user;
    }
    
    public static function cryptMdp($mdp){
        $options = [
            'cost' => 11,
            'salt' => "Wikhitema,lesitelecoderenphp",
        ];
        return password_hash($mdp, PASSWORD_BCRYPT, $options);
    }
    
    
}
