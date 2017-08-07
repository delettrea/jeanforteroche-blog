<?php

class Login extends Comment {

    public $errorAdmin = "<p class='error'> Vous devez être administrateur pour acceder à cette page </p>";
    public $sqlLogin = "SELECT id, authorization_user, login, COUNT(id) AS findLogin FROM users WHERE `login` =:login AND `password` =:password";

    public function error($name){
        if(isset($_POST[$name]) && empty($_POST[$name])) {
            if($name == "login") {
                echo "<p class='error'>Veuillez renseigner votre login </p>";
            }
            elseif($name == "password"){
                echo "<p class='error'>Veuillez renseigner votre mot de passe </p>";
            }
            elseif($name == "author"){
                echo "<p class='error'>Veuillez renseigner votre nom </p>";
            }
            elseif($name == "title"){
                echo "<p class='error'>Veuillez renseigner un titre </p>";
            }
            elseif($name == "article"){
                echo "<p class='error'>Veuillez renseigner votre article</p>";
            }
            elseif($name == "comment"){
                echo "<p class='error'>Veuillez renseigner votre commentaire </p>";
            }
            elseif($name == "email"){
                echo "<p class='error'>Veuillez renseigner votre email </p>";
            }
            elseif($name == "biographie"){
                echo "<p class='error'>Veuillez renseigner votre biographie </p>";
            }
        }
    }


    public function keepValue($empty, $keep){
        if(empty($_POST[$empty]) && !empty($_POST[$keep])){
            return $_POST[$keep];
        }
    }

    public function keepValueData($data, $empty, $keep){
        if(empty($_POST)){
            return $data;
        }
        elseif(empty($_POST[$empty]) && !empty($_POST[$keep])){
            return $_POST[$keep];
        }
    }


    public function checkValueLogin(){
        extract($_POST);
        $login = htmlspecialchars($login);
        $password = sha1($password);
        $password = htmlspecialchars($password);
        $loginArray = array('login'=> $login, 'password' => $password);
        return $loginArray;
    }

    public function log($function){
        while ($data = $this->request->fetch()){
            if($data['findLogin'] == 1){
                $_SESSION['login'] = $data['login'];
                $_SESSION['authorization_user'] = $data['authorization_user'];
                header('location: index.php');
            }
            elseif ($data['findLogin'] != 1){
                $function;
                echo '<p class="error bottom-error">connexion impossible, veuillez verifier votre pseudo et votre mot de passe</p>';
            }
        }
    }

    public function logout(){
        session_destroy();
        header('location: index.php');
    }

    public function admin(){
        if(empty($_SESSION)){
            return 'member';
        }
        elseif ($_SESSION['authorization_user'] == "admin") {
            return 'admin';
        }
        else{
            return 'member';
        }
    }

    public function errorTest(){
        echo $this->errorAdmin;
    }
}