<?php

class AdminController extends HomeController{

    /**
     * Permet de tester si les function sont lancées par l'administrateur ou non.
     * @param $function Fonction à tester.
     */
    public function testAdmin($function){
        if (!empty($_SESSION) && $_SESSION['authorization_user'] == "admin"){
            $this->$function();
        }
        else{
            echo $this->errorAdmin;

        }
    }

    public function sendCreateArticle(){
        $this->testAdmin('sendNewArticle');
    }

    /**
     * Prepare la fonction pour envoyer un nouvel article.
     */
    public function sendNewArticle(){
        if (!empty($_POST['title'] && !empty($_POST['article']))) {
            $this->sendArticle();
            header('Location: index.php');
        }
        else {
            $this->prepareCreateArticle();
        }
    }

    public function createArticle(){
        $this->testAdmin('prepareCreateArticle');
    }

    /**
     * Prepare la fonction pour créé un nouvel article.
     */
    public function prepareCreateArticle(){
        $this->newArticle();
    }

    public function editThisArticle(){
        $this->testAdmin('prepareEditThisArticle');
    }

    /**
     * Prepare l'édition d'un article.
     */
    public function prepareEditThisArticle(){
        $this->htmlEditArticle($this->editArticle());
    }

    public function sendEditArticle(){
        $this->testAdmin('prepareSendEditArticle');
    }

    /**
     * Prépare l'envoi de l'édition de l'article.
     */
    public function prepareSendEditArticle(){
        if (!empty($_POST['title'] && !empty($_POST['article']))) {
            $this->sendEditThisArticle();
            header('Location: index.php');
        }
        else{
            $this->prepareEditThisArticle();
        }
    }

    public function deleteArticle(){
        $this->testAdmin('prepareDeleteArticle');
    }

    /**
     * Prepare la fonction pour supprimer les articles ainsi que tous ces commentaires.
     */
    public function prepareDeleteArticle(){
        $this->deleteComment();
        $this->deleteArticle();
        header('Location: index.php');
    }

    public function editThisComment(){
        $this->testAdmin('prepareEditComment');
    }

    /**
     * Prepare la fonction pour éditer des commentaires.
     */
    public function prepareEditComment(){
        $this->htmlEditComment($this->editComment());
    }

    public function sendEditComment(){
        $this->testAdmin('prepareSendEditComment');
    }

    /**
     * Prepare la fonction pour envoyer la modification d'un commentaire.
     */
    public function prepareSendEditComment(){
        if (!empty($_POST['comment'])) {
            $this->sendEditComment();
            header('Location: index.php?action=article&number='.$this->getNumber().'');
        }
        else{
            $this->prepareEditComment();
        }
    }

    public function deleteComment(){
        $this->testAdmin('prepareDeleteComment');
    }

    /**
     * Prepare la fonction pour supprimer des commentaires.
     */
    public function prepareDeleteComment(){
        $this->deleteThisComment();
        $this->justOneArticle();
    }

    public function onlineComment(){
        $this->testAdmin('prepareOnlineComment');
    }

    /**
     * Prepare la fonction pour mettre en ligne un article.
     */
    public function prepareOnlineComment(){
        $this->onlineComment();
        header('Location: index.php?action=article&number='.$this->getNumber().'');
    }

    public function seeOfflineComment(){
        $this->testAdmin('prepareSeeOfflineComment');
    }

    /**
     * Prepare la fonction pour visualiser les commentaires hors ligne.
     */
    public function prepareSeeOfflineComment(){
        $this->htmlSeeOfflineComment($this->offlineComment());
    }

    public function editBiographyAdmin(){
        $this->testAdmin('prepareEditBiography');
    }

    /**
     * Prepare la fonction pour éditer la biographie de l'auteur.
     */
    public function prepareEditBiography(){
        $this->htmlEditBiography($this->thisBiography());
    }

    public function sendEditBiographyAdmin(){
        $this->testAdmin('sendEditBiography');
    }

    /**
     * Prepare la fonction pour envoyer l'édition de la biographie de l'auteur.
     */
    public function sendEditBiography(){
        if(isset($_POST['biography']) && !empty($_POST['biography'])){
            $this->editBiography();
            header('Location: index.php');
        }
        else{
            $this->prepareEditBiography();
        }
    }

    public function confirmDeleteArticle(){
        $this->testAdmin('htmlDeleteArticle');
    }

    public function confirmDeleteComment(){
        $this->testAdmin('htmlDeleteComment');
    }


}