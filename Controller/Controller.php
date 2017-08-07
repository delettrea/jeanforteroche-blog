<?php

class Controller extends AdminController {

    public $action;


    public function blog(){
        if (isset($_GET['action'])){
            $this->action = $_GET['action'];
            self::action();
        }
        else{
            self::seeAllArticle();
            self::prepareBiography();
        }

    }

    public function action(){
        if ($this->action == "new") {
            self::createArticle();
        }
        elseif ($this->action == "sendNew"){
            self::sendCreateArticle();
        }
        elseif($this->action == "edit"){
            self::editThisArticle();
        }
        elseif ($this->action == "sendEdit"){
            self::sendEditArticle();
        }
        elseif ($this->action == "article"){
            self::justOneArticle();
        }
        elseif ($this->action == "delete"){
            self::deleteArticle();
        }
        elseif($this->action == "deleteComment"){
            self::deleteComment();
        }
        elseif($this->action == "newComment"){
            self::createComment();
        }
        elseif($this->action == "sendNewComment"){
            self::sendNewComment();
        }
        elseif ($this->action == "editComment"){
            self::editThisComment();
        }
        elseif ($this->action == "sendEditComment"){
            self::sendEditComment();
        }
        elseif ($this->action == "online"){
            self::onlineComment();
        }
        elseif ($this->action == "login"){
            self::login();
        }
        elseif ($this->action == "sendLogin"){
            self::sendLogin();
        }
        elseif ($this->action == "logout"){
            self::logout();
        }
        elseif ($this->action == "offlineComment"){
            self::seeOfflineComment();
        }
        elseif ($this->action == "about"){
            self::prepareBiography();
        }
        elseif ($this->action == "contact"){
            self::contact();
        }
        elseif ($this->action == "editBiography"){
            self::editBiographyAdmin();
        }
        elseif ($this->action == "sendEditBiography"){
            self::sendEditBiographyAdmin();
        }
    }



}