<?php

class AdminController extends HomeController{

    /**
     * Permet de tester si les function sont lancées par l'administrateur ou non.
     * @param $function Fonction à tester.
     */
    protected function testAdmin($function){
        if (!empty($_SESSION) && $_SESSION['authorization_user'] == "admin"){
            $this->$function();
        }
        else{
            echo $this->errorAdmin;

        }
    }

    protected function sendCreateArticle(){
        $this->testAdmin('sendNewArticle');
    }

    /**
     * Prepare la fonction pour envoyer un nouvel article.
     */
    protected function sendNewArticle(){
        if (!empty($_POST['title'] && !empty($_POST['article']))) {
            $this->sendArticle();
            header('Location: index.php');
        }
        else {
            $this->prepareCreateArticle();
        }
    }

    protected function createArticle(){
        $this->testAdmin('prepareCreateArticle');
    }

    /**
     * Prepare la fonction pour créé un nouvel article.
     */
    protected function prepareCreateArticle(){
        $this->newArticle();
    }

    protected function editThisArticle(){
        $this->testAdmin('prepareEditThisArticle');
    }

    /**
     * Prepare l'édition d'un article.
     */
    protected function prepareEditThisArticle(){
        $this->htmlEditArticle($this->editArticle());
    }

    protected function sendEditArticle(){
        $this->testAdmin('prepareSendEditArticle');
    }

    /**
     * Prépare l'envoi de l'édition de l'article.
     */
    protected function prepareSendEditArticle(){
        if (!empty($_POST['title'] && !empty($_POST['article']))) {
            $this->sendEditThisArticle();
            header('Location: index.php');
        }
        else{
            $this->prepareEditThisArticle();
        }
    }

    protected function deleteArticle(){
        $this->testAdmin('prepareDeleteArticle');
    }

    /**
     * Prepare la fonction pour supprimer les articles ainsi que tous ces commentaires.
     */
    protected function prepareDeleteArticle(){
        $this->deleteComment();
        $this->deleteArticle();
        header('Location: index.php');
    }

    protected function editThisComment(){
        $this->testAdmin('prepareEditComment');
    }

    /**
     * Prepare la fonction pour éditer des commentaires.
     */
    protected function prepareEditComment(){
        $this->htmlEditComment($this->editComment());
    }

    protected function sendEditComment(){
        $this->testAdmin('prepareSendEditComment');
    }

    /**
     * Prepare la fonction pour envoyer la modification d'un commentaire.
     */
    protected function prepareSendEditComment(){
        if (!empty($_POST['comment'])) {
            $this->sendEditComment();
            header('Location: index.php?action=article&number='.$this->getNumber().'');
        }
        else{
            $this->prepareEditComment();
        }
    }

    protected function deleteComment(){
        $this->testAdmin('prepareDeleteComment');
    }

    /**
     * Prepare la fonction pour supprimer des commentaires.
     */
    protected function prepareDeleteComment(){
        $this->deleteThisComment();
        $this->justOneArticle();
    }

    protected function onlineComment(){
        $this->testAdmin('prepareOnlineComment');
    }

    /**
     * Prepare la fonction pour mettre en ligne un article.
     */
    protected function prepareOnlineComment(){
        $this->onlineComment();
        header('Location: index.php?action=article&number='.$this->getNumber().'');
    }

    protected function seeOfflineComment(){
        $this->testAdmin('prepareSeeOfflineComment');
    }

    /**
     * Prepare la fonction pour visualiser les commentaires hors ligne.
     */
    protected function prepareSeeOfflineComment(){
        $this->htmlSeeOfflineComment($this->offlineComment());
    }

    protected function editBiographyAdmin(){
        $this->testAdmin('prepareEditBiography');
    }

    /**
     * Prepare la fonction pour éditer la biographie de l'auteur.
     */
    protected function prepareEditBiography(){
        $this->htmlEditBiography($this->thisBiography());
    }

    protected function sendEditBiographyAdmin(){
        $this->testAdmin('sendEditBiography');
    }

    /**
     * Prepare la fonction pour envoyer l'édition de la biographie de l'auteur.
     */
    protected function sendEditBiography(){
        if(isset($_POST['biography']) && !empty($_POST['biography'])){
            $this->editBiography();
            header('Location: index.php');
        }
        else{
            $this->prepareEditBiography();
        }
    }

    protected function confirmDeleteArticle(){
        $this->testAdmin('htmlDeleteArticle');
    }

    protected function confirmDeleteComment(){
        $this->testAdmin('htmlDeleteComment');
    }


}