<?php

class HomeController extends TemplateBiography {


    /**
     * Prepare la fonction pour visualiser les articles.
     * @param $sql Requête sql.
     */
    public function prepareSeeAllArticle($sql){
        self::sqlPrepare($this->sqlOfflineComment, self::emptyArray());
        self::offlineComment();
        self::sqlPrepare($sql, self::emptyArray());
        self::htmlAllArticle(self::admin());
    }

    /**
     * Prepare la fonction pour visualiser la biographie de l'auteur.
     */
    public function prepareBiography(){
        self::sqlPrepare($this->sqlBiography, self::emptyArray());
        self::seeBiography();
    }

    /**
     * Prepare la fonction pour éditer la biographie de l'auteur.
     */
    public function prepareEditBiography(){
        self::sqlPrepare($this->sqlBiography, self::emptyArray());
        self::editBiography();
    }

    /**
     * Prepare la fonction pour envoyer l'édition de la biographie de l'auteur.
     */
    public function sendEditBiography(){
        if(isset($_POST['biography']) && !empty($_POST['biography'])){
            self::sqlPrepare($this->sqlEditBiography, self::arrayEditBiography());
            header('Location: index.php');
        }
        else{
            self::editBiographyAdmin();
        }
    }

    /**
     * Prepare la fonction pour créé un nouvel article.
     */
    public function prepareCreateArticle(){
        self::newArticle();
    }

    /**
     * Prepare la fonction pour envoyer un mail de contact.
     */
    public function prepareEmail(){
    if(isset($_POST) && !empty($_SESSION['name']) && !empty($_SESSION['email']) && !empty($_SESSION['objet'])&& !empty($_SESSION['mail'])){
        self::sendEmail();
        header('Location: index.php');
    }
    else{
        self::contact();
    }
}

    /**
     * Prepare la fonction pour envoyer un nouvel article.
     */
    public function sendNewArticle(){
        if (!empty($_POST['title'] && !empty($_POST['article']))) {
            self::sqlPrepare($this->sqlAdd, self::checkValue());
            header('Location: index.php');
        }
        else {
            self::prepareCreateArticle();
        }
    }

    /**
     * Prepare l'édition d'un article.
     */
    public function prepareEditThisArticle(){
        self::sqlPrepare($this->sqlViewEdit, self::testNumber());
        self::editArticle();
    }

    /**
     * Prépare l'envoi de l'édition de l'article.
     */
    public function prepareSendEditArticle(){
        if (!empty($_POST['title'] && !empty($_POST['article']))) {
            self::sqlPrepare($this->sqlEdit, self::testAndCheck());
            header('Location: index.php');
        }
        else{
            self::prepareEditThisArticle();
        }
    }

    /**
     * Prépare la fonction pour afficher un article et ses commentaires.
     */
    public function justOneArticle(){
        self::sqlPrepare($this->sqlViewOneArticle, self::testNumber());
        self::oneArticle(self::admin());
        self::sqlPrepare($this->sqlAllComment, self::commentAdmin());
        self::htmlAllComment();
    }

    /**
     * Prepare la fonction pour supprimer les articles ainsi que tous ces commentaires.
     */
    public function prepareDeleteArticle(){
        self::sqlPrepare($this->sqlDeleteAllComment, self::testNumber());
        self::sqlPrepare($this->sqlDelete, self::testNumber());
        header('Location: index.php');
    }

    /**
     * Prepare la fonction pour supprimer des commentaires.
     */
    public function prepareDeleteComment(){
        self::sqlPrepare($this->sqlDeleteComment, self::testNumberCom());
        self::justOneArticle();
    }

    /**
     * Prepare la fonction pour éditer des commentaires.
     */
    public function prepareEditComment(){
        self::sqlPrepare($this->sqlViewEditComment, self::testNumberCom());
        self::editComment();
    }

    /**
     * Prepare la fonction pour créer des commentaires.
     */
    public function createComment(){
        self::testNumber();
        self::NewComment();
    }

    /**
     * Prepare la fonction pour envoyer le nouveau commentaire.
     */
    public function sendNewComment(){
        if(self::testComment()){
            self::sqlPrepare($this->sqlAddComment, self::testNumberAndCheckComment());
            header('location: index.php?action=article&number='.self::getNumber().'&online=wait');
        }
        else {
            self::createComment();
        }
    }

    /**
     * Prepare la fonction pour envoyer la modification d'un commentaire.
     */
    public function prepareSendEditComment(){
        if (!empty($_POST['comment'])) {
            self::sqlPrepare($this->sqlEditComment, self::testAndCheckEditComment());
            header('Location: index.php?action=article&number='.self::getNumber().'');
        }
        else{
            self::editThisComment();
        }
    }

    /**
     * Prepare la fonction pour mettre en ligne un article.
     */
    public function prepareOnlineComment(){
        self::sqlPrepare($this->sqlOnlineComment, self::testNumberCom());
        header('Location: index.php?action=article&number='.self::getNumber().'');
    }

    /**
     * Prepare la fonction pour se connecter au site.
     */
    public function login(){
        self::htmlLogin();
    }

    /**
     * Prépare la fonction qui vérifie si les données de connexion sont exactes.
     */
    public function sendLogin(){
        self::sqlPrepare($this->sqlLogin, self::checkValueLogin());
        self::log(self::login());
        header('Location: index.php');
    }

    /**
     * Prepare la fonction pour visualiser les commentaires hors ligne.
     */
    public function prepareSeeOfflineComment(){
        self::sqlPrepare($this->sqlOfflineComment, self::emptyArray());
            self::seeOffline();

    }





}