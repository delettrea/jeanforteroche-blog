<?php

class HomeController extends TemplateBiography {


    /**
     * Prepare la fonction pour visualiser les articles.
     * @param $sql Requête sql.
     */
    public function prepareSeeAllArticle($sql){
        $this->sqlPrepare($this->sqlOfflineComment, $this->emptyArray());
        $this->offlineComment();
        $this->sqlPrepare($sql, $this->emptyArray());
        $this->htmlAllArticle($this->admin());
    }

    /**
     * Prepare la fonction pour visualiser la biographie de l'auteur.
     */
    public function prepareBiography(){
        $this->sqlPrepare($this->sqlBiography, $this->emptyArray());
        $this->seeBiography();
    }

    /**
     * Prepare la fonction pour éditer la biographie de l'auteur.
     */
    public function prepareEditBiography(){
        $this->sqlPrepare($this->sqlBiography, $this->emptyArray());
        $this->editBiography();
    }

    /**
     * Prepare la fonction pour envoyer l'édition de la biographie de l'auteur.
     */
    public function sendEditBiography(){
        if(isset($_POST['biography']) && !empty($_POST['biography'])){
            $this->sqlPrepare($this->sqlEditBiography, $this->arrayEditBiography());
            header('Location: index.php');
        }
        else{
            $this->editBiographyAdmin();
        }
    }

    /**
     * Prepare la fonction pour créé un nouvel article.
     */
    public function prepareCreateArticle(){
        $this->newArticle();
    }

    /**
     * Prepare la fonction pour envoyer un mail de contact.
     */
    public function prepareEmail(){
    if(isset($_POST) && !empty($_SESSION['name']) && !empty($_SESSION['email']) && !empty($_SESSION['objet'])&& !empty($_SESSION['mail'])){
        $this->sendEmail();
        header('Location: index.php');
    }
    else{
        $this->contact();
    }
}

    /**
     * Prepare la fonction pour envoyer un nouvel article.
     */
    public function sendNewArticle(){
        if (!empty($_POST['title'] && !empty($_POST['article']))) {
            $this->sqlPrepare($this->sqlAdd, $this->checkValue());
            header('Location: index.php');
        }
        else {
            $this->prepareCreateArticle();
        }
    }

    /**
     * Prepare l'édition d'un article.
     */
    public function prepareEditThisArticle(){
        $this->sqlPrepare($this->sqlViewEdit, $this->testNumber());
        $this->editArticle();
    }

    /**
     * Prépare l'envoi de l'édition de l'article.
     */
    public function prepareSendEditArticle(){
        if (!empty($_POST['title'] && !empty($_POST['article']))) {
            $this->sqlPrepare($this->sqlEdit, $this->testAndCheck());
            header('Location: index.php');
        }
        else{
            $this->prepareEditThisArticle();
        }
    }

    /**
     * Prépare la fonction pour afficher un article et ses commentaires.
     */
    public function justOneArticle(){
        $this->sqlPrepare($this->sqlViewOneArticle, $this->testNumber());
        $this->oneArticle($this->admin());
        $this->sqlPrepare($this->sqlAllComment, $this->commentAdmin());
        $this->htmlAllComment();
    }

    /**
     * Prepare la fonction pour supprimer les articles ainsi que tous ces commentaires.
     */
    public function prepareDeleteArticle(){
        $this->sqlPrepare($this->sqlDeleteAllComment, $this->testNumber());
        $this->sqlPrepare($this->sqlDelete, $this->testNumber());
        header('Location: index.php');
    }

    /**
     * Prepare la fonction pour supprimer des commentaires.
     */
    public function prepareDeleteComment(){
        $this->sqlPrepare($this->sqlDeleteComment, $this->testNumberCom());
        $this->justOneArticle();
    }

    /**
     * Prepare la fonction pour éditer des commentaires.
     */
    public function prepareEditComment(){
        $this->sqlPrepare($this->sqlViewEditComment, $this->testNumberCom());
        $this->editComment();
    }

    /**
     * Prepare la fonction pour créer des commentaires.
     */
    public function createComment(){
        $this->testNumber();
        $this->NewComment();
    }

    /**
     * Prepare la fonction pour envoyer le nouveau commentaire.
     */
    public function sendNewComment(){
        if($this->testComment()){
            $this->sqlPrepare($this->sqlAddComment, $this->testNumberAndCheckComment());
            header('location: index.php?action=article&number='.$this->getNumber().'&online=wait');
        }
        else {
            $this->createComment();
        }
    }

    /**
     * Prepare la fonction pour envoyer la modification d'un commentaire.
     */
    public function prepareSendEditComment(){
        if (!empty($_POST['comment'])) {
            $this->sqlPrepare($this->sqlEditComment, $this->testAndCheckEditComment());
            header('Location: index.php?action=article&number='.$this->getNumber().'');
        }
        else{
            $this->editThisComment();
        }
    }

    /**
     * Prepare la fonction pour mettre en ligne un article.
     */
    public function prepareOnlineComment(){
        $this->sqlPrepare($this->sqlOnlineComment, $this->testNumberCom());
        header('Location: index.php?action=article&number='.$this->getNumber().'');
    }

    /**
     * Prepare la fonction pour se connecter au site.
     */
    public function login(){
        $this->htmlLogin();
    }

    /**
     * Prépare la fonction qui vérifie si les données de connexion sont exactes.
     */
    public function sendLogin(){
        $this->sqlPrepare($this->sqlLogin, $this->checkValueLogin());
        $this->log($this->login());
        header('Location: index.php');
    }

    /**
     * Prepare la fonction pour visualiser les commentaires hors ligne.
     */
    public function prepareSeeOfflineComment(){
        $this->sqlPrepare($this->sqlOfflineComment, $this->emptyArray());
            $this->seeOffline();

    }





}