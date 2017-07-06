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
    private $role;
    
    public function __construct($id_user, $pseudo, $email, $role) {
        $this->id_user = $id_user;
        $this->pseudo = $pseudo;
        $this->email  = $email;
        $this->role = $role;
    }

    public function getId_user() {
        return $this->id_user;
    }

    public function getPseudo() {
        return $this->pseudo;
    }

    public function getEmail() {
        return $this->email;
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

    public function setRole($role) {
        $this->role = $role;
    }
    
    public function to_json(){
        return json_encode(
            $this->to_array()
        );
    }
    
    public function to_array(){
        return array(
            "id_user" => $this->getId_user(),
            "pseudo" => $this->getPseudo(),
            "email" => $this->getEmail(),
            "role" => $this->getRole()
        );
    }
    
    public function to_array_mdp(){
        $array = $this->to_array();
        $array['mdp'] = $this->selectMdp();
        return $array;
    }

    private function selectMdp(){
        global $pdo;
        $requete = "SELECT * FROM user where id_user = ?";
        $sth=$pdo->prepare($requete);
        $sth->execute(array($this->id_user));
        $result=$sth->fetch(PDO::FETCH_ASSOC);
        return $result['mdp'];
    }

    public static function json_to_user($json){
        $tab=json_decode($json);
        return new User(
            filter_var($tab['id_user'], FILTER_VALIDATE_INT),
            filter_var($tab['pseudo'], FILTER_SANITIZE_FULL_SPECIAL_CHARS), 
            filter_var($tab['email'], FILTER_VALIDATE_EMAIL), 
            filter_var($tab['role'], FILTER_VALIDATE_INT)
        );
    }
    
    // Le role par défaut est 3, c'est l'utilisateur de base de l'application
    public static function createUser ($pseudo, $email, $mdp, $role=3){
        global $pdo;
        $pseudo = filter_var($pseudo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $mdp = USER::cryptMdp(filter_var($mdp, FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $role = filter_var($role, FILTER_VALIDATE_INT);
        
        $user = USER::selectUserByPseudo($pseudo);
        $user2 = USER::selectUserByEmail($email);
        
        if ($pseudo && $email && $mdp && $role && $user->getPseudo()!==$pseudo && $user2->getEmail() !== $email){
            $requete="INSERT INTO user VALUES (default , ?, ?, ?, ?);";
            $sth=$pdo->prepare($requete);
            $rowCount = $sth->execute(array($pseudo, $email, $mdp, $role));
            return $rowCount;
        }else{
            return selectUserByPseudo($pseudo);
        }
    }
    
    public static function deleteUser ($id_user){
        global $pdo;
        
        $requete= "DELETE FROM user WHERE id_user = ?";
        $sth=$pdo->prepare($requete);
        $rowCount = $sth->execute(array($id_user));
        return $rowCount;
    }
    
    public static function updateUser($id_user, Array $user){
        global $pdo;
        $requete = "UPDATE user SET pseudo = ?, email = ?, mdp = ?, role = ? WHERE id_user = ?";
        $sth=$pdo->prepare($requete);
        
        $oldUser = USER::selectUserById($id_user)->to_array_mdp();
        If ($user["mdp"]!==NULL){
            $user["mdp"]=USER::cryptMdp($user["mdp"]);
            $isMdpChanged = !empty($user["mdp"]) && $user["mdp"] !== $oldUser["mdp"] && $user["mdp"] !== '';
            $mdp = $isMdpChanged ? $user["mdp"] : $oldUser["mdp"];
        }
        else{
            $mdp = $oldUser["mdp"];                     
        }
        //Les lignes suivantes sont des conditions ternaire, cela permet d'aller plus vite
        //Et pour notre cas je trouve ça plus simple à comprendre... Si la nouvelle valeur est vide, on met l'ancienne
        $isPseudoChanged = !empty($user["pseudo"]) && $user["pseudo"] !== NULL && $user["pseudo"] !== $oldUser["pseudo"] && $user["pseudo"] !== '';
        $pseudo = $isPseudoChanged && filter_var($user["pseudo"], FILTER_SANITIZE_FULL_SPECIAL_CHARS) !==NULL ? $user["pseudo"] : $oldUser["pseudo"];
        
        $isEmailChanged = !empty($user["email"]) && $user["email"] !== NULL && $user["email"] !== $oldUser["email"] && $user["email"] !== '';
        $email = $isEmailChanged && filter_var($user["email"], FILTER_SANITIZE_EMAIL) !==NULL ? $user["email"] : $oldUser["email"];
        
        $isRoleChanged = !empty($user["role"]) && $user["role"] !== NULL && $user["role"] !== $oldUser["role"] && $user["role"] !== '';
        $role = $isRoleChanged && filter_var($user["role"], FILTER_VALIDATE_INT) !==NULL ? $user["role"] : $oldUser["role"];
        
        $rowCount = $sth->execute(array($pseudo, $email, $mdp, $role, $id_user));
        return $rowCount;
    }
    
    public static function selectUserById($id_user){
        global $pdo;
        $requete = "SELECT * FROM user where id_user = ?";
        $sth=$pdo->prepare($requete);
        $sth->execute(array($id_user));
        $result=$sth->fetch(PDO::FETCH_ASSOC);
        return new User($result['id_user'],$result['pseudo'], $result['email'], $result['role']);
    }
    
    public static function selectUserByEmail($email){
        global $pdo;
        $requete = "SELECT * FROM user where email = ?";
        $sth=$pdo->prepare($requete);
        $sth->execute(array($email));
        $result=$sth->fetch(PDO::FETCH_ASSOC);
        return new User($result['id_user'],$result['pseudo'], $result['email'], $result['role']);
    }
    
    public static function selectUserByPseudo($pseudo){
        global $pdo;
        $requete = "SELECT * FROM user where pseudo = ?";
        $sth=$pdo->prepare($requete);
        $sth->execute(array($pseudo));
        $result=$sth->fetch(PDO::FETCH_ASSOC);
        return new User($result['id_user'],$result['pseudo'], $result['email'], $result['role']);
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
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if ($result['id_user']!==NULL){
            return new User($result['id_user'], $result['pseudo'], $result['email'], $result['role']);
        }else{
            return false;
        }
    }
    
    public static function cryptMdp($mdp){
        $options = [
            'cost' => 11,
            'salt' => "Wikhitema,lesitelecoderenphp",
        ];
        return password_hash($mdp, PASSWORD_BCRYPT, $options);
    }

    public static function selectAllUser(){
        global $pdo;
        $req = $pdo->prepare('SELECT * FROM user');
        $req->execute();
        $rowCount = $req->fetchAll(PDO::FETCH_ASSOC);
        return $rowCount;
    }


    
}
