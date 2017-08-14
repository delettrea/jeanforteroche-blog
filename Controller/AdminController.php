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

    public function seeAllArticle(){
        $this->prepareSeeAllArticle($this->sqlViewAllArticle);
    }

    public function sendCreateArticle(){
        $this->testAdmin('sendNewArticle');
    }

    public function createArticle(){
        $this->testAdmin('prepareCreateArticle');
    }

    public function editThisArticle(){
        $this->testAdmin('prepareEditThisArticle');
    }

    public function sendEditArticle(){
        $this->testAdmin('prepareSendEditArticle');
    }

    public function deleteArticle(){
        $this->testAdmin('prepareDeleteArticle');
    }

    public function editThisComment(){
        $this->testAdmin('prepareEditComment');
    }

    public function sendEditComment(){
        $this->testAdmin('prepareSendEditComment');
    }

    public function deleteComment(){
        $this->testAdmin('prepareDeleteComment');
    }

    public function onlineComment(){
        $this->testAdmin('prepareOnlineComment');
    }

    public function seeOfflineComment(){
        $this->testAdmin('prepareSeeOfflineComment');
    }

    public function editBiographyAdmin(){
        $this->testAdmin('prepareEditBiography');
    }

    public function sendEditBiographyAdmin(){
        $this->testAdmin('sendEditBiography');
    }


}