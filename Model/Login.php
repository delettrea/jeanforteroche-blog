<?php

class Login extends Comment {

    public $errorAdmin = "<p class='error'> Vous devez être administrateur pour acceder à cette page </p>";
    public $sqlLogin = "SELECT id, authorization_user, login, COUNT(id) AS findLogin FROM users WHERE `login` =:login AND `password` =:password";


    public function sendThisLogin(){
        $sendLogin = $this->sqlPrepare2($this->sqlLogin, $this->checkValueLogin());
        return $sendLogin;
    }

    /**
     * Envoie un message d'erreur si le name de l'input passé en paramètre est vide.
     * @param $name Nom du champ a vérifié.
     */
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

    /**
     * Garde en mémoire un paramètre remplit si un autre est vide.
     * @param $empty Paramètre potentiellement vide.
     * @param $keep Paramètre à garder en mémoire.
     * @return mixed paramètre à garder en mémoire.
     */
    public function keepValue($empty, $keep){
        if(empty($_POST[$empty]) && !empty($_POST[$keep])){
            return $_POST[$keep];
        }
    }

    /**
     * Garde en mémoire un paramètre remplit si un autre est vide sinon renvoie ce qui est sur la bdd.
     * @param $data Donnée sql.
     * @param $empty Paramètre potentiellement vide.
     * @param $keep Paramètre à garder en mémoire.
     * @return mixed paramètre à afficher.
     */
    public function keepValueData($data, $empty, $keep){
        if(empty($_POST)){
            return $data;
        }
        elseif(empty($_POST[$empty]) && !empty($_POST[$keep])){
            return $_POST[$keep];
        }
    }

    /**
     * Verifie les données envoyées via le formulaire.
     * @return array Tableau prêt pour une requête sql.
     */
    public function checkValueLogin(){
        extract($_POST);
        $login = htmlspecialchars($login);
        $password = sha1($password);
        $password = htmlspecialchars($password);
        $loginArray = array('login'=> $login, 'password' => $password);
        return $loginArray;
    }

    /**
     * Permet de vérifier si tous les paramètres de connexion sont exacts.
     * @param $function string à lancer si les données sont fausses.
     */
    public function log($function, $request){
        while ($data = $request->fetch()){
            if($data['findLogin'] == 1){
                $_SESSION['login'] = $data['login'];
                $_SESSION['authorization_user'] = $data['authorization_user'];
            }
            elseif ($data['findLogin'] != 1){
                $this->$function();
                echo '<p class="error bottom-error">connexion impossible, veuillez verifier votre pseudo et votre mot de passe</p>';
            }
        }
    }

    /**
     * Deconnexion de l'utilisateur.
     */
    public function logout(){
        session_destroy();
        header('location: index.php');
    }

    /**
     * Permet de vérifier si la personne connectée est administrateur ou non.
     * @return string Retourne admin ou member.
     */
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

    /**
     * Renvoi une phrase d'erreur si un non administrateur essaye d'aller sur une page qu'il n'a pas l'autorisation.
     */
    public function errorTest(){
        echo $this->errorAdmin;
    }
}