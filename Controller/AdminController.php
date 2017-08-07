<?php

class AdminController extends HomeController{

    public function testAdmin($function){
        if (!empty($_SESSION) && $_SESSION['authorization_user'] == "admin"){
            self::$function();
        }
        else{
            echo $this->errorAdmin;

        }
    }

    public function seeAllArticle(){
        self::prepareSeeAllArticle($this->sqlViewAllArticle);
    }

    public function sendCreateArticle(){
        self::testAdmin('sendNewArticle');
    }

    public function createArticle(){
        self::testAdmin('prepareCreateArticle');
    }

    public function editThisArticle(){
        self::testAdmin('prepareEditThisArticle');
    }

    public function sendEditArticle(){
        self::testAdmin('prepareSendEditArticle');
    }

    public function deleteArticle(){
        self::testAdmin('prepareDeleteArticle');
    }

    public function editThisComment(){
        self::testAdmin('prepareEditComment');
    }

    public function sendEditComment(){
        self::testAdmin('prepareSendEditComment');
    }

    public function deleteComment(){
        self::testAdmin('prepareDeleteComment');
    }

    public function onlineComment(){
        self::testAdmin('prepareOnlineComment');
    }

    public function seeOfflineComment(){
        self::testAdmin('prepareSeeOfflineComment');
    }

    public function editBiographyAdmin(){
        self::testAdmin('prepareEditBiography');
    }

    public function sendEditBiographyAdmin(){
        self::testAdmin('sendEditBiography');
    }


}