<?php

class Controller extends AdminController {

    public $action;


    /**
     * Fonction permettant le lancement des autres fonctions.
     */
    public function blog(){
        if (isset($_GET['action'])){
            $this->action = $_GET['action'];
            $this->action();
        }
        else{
            $this->prepareSeeAllArticle();
            $this->prepareBiography();
        }

    }

    protected function action(){
        if ($this->action == "new") {
            $this->createArticle();
        }
        elseif ($this->action == "sendNew"){
            $this->sendCreateArticle();
        }
        elseif($this->action == "edit"){
            $this->editThisArticle();
        }
        elseif ($this->action == "sendEdit"){
            $this->sendEditArticle();
        }
        elseif ($this->action == "article"){
            $this->justOneArticle();
        }
        elseif ($this->action == "delete"){
            $this->deleteArticleComment();
        }
        elseif ($this->action == "confirmDelete"){
            $this->htmlDeleteArticle();
        }
        elseif($this->action == "deleteThisComment"){
            $this->deleteJustThisComment();
        }
        elseif($this->action == "deleteComment"){
            $this->deleteComment();
        }
        elseif ($this->action == "confirmDeleteComment"){
            $this->confirmDeleteComment();
        }
        elseif($this->action == "newComment"){
            $this->createComment();
        }
        elseif($this->action == "sendNewComment"){
            $this->sendNewComment();
        }
        elseif ($this->action == "editComment"){
            $this->editThisComment();
        }
        elseif ($this->action == "sendEditComment"){
            $this->sendEditComment();
        }
        elseif ($this->action == "online"){
            $this->prepareOnlineComment();
        }
        elseif ($this->action == "login"){
            $this->login();
        }
        elseif ($this->action == "sendLogin"){
            $this->sendLogin();
        }
        elseif ($this->action == "logout"){
            $this->logout();
        }
        elseif ($this->action == "offlineComment"){
            $this->seeOfflineComment();
        }
        elseif ($this->action == "about"){
            $this->prepareBiography();
        }
        elseif ($this->action == "contact"){
            $this->contact();
        }
        elseif ($this->action == "sendContact"){
            $this->emailTest();
        }
        elseif ($this->action == "editBiography"){
            $this->editBiographyAdmin();
        }
        elseif ($this->action == "sendEditBiography"){
            $this->sendEditBiographyAdmin();
        }
        elseif ($this->action == "ml"){
            $this->seeLegal();
        }
    }



}