<?php

class HomeController extends TemplateBiography {



    public function prepareSeeAllArticle($sql){
        self::sqlPrepare($this->sqlOfflineComment, self::emptyArray());
        self::offlineComment();
        self::sqlPrepare($sql, self::emptyArray());
        self::htmlAllArticle(self::admin());
    }

    public function prepareBiography(){
        self::sqlPrepare($this->sqlBiography, self::emptyArray());
        self::seeBiography();
    }

    public function prepareEditBiography(){
        self::sqlPrepare($this->sqlBiography, self::emptyArray());
        self::editBiography();
    }

    public function sendEditBiography(){
        if(isset($_POST['biography']) && !empty($_POST['biography'])){
            self::sqlPrepare($this->sqlEditBiography, self::arrayEditBiography());
            header('Location: index.php');
        }
        else{
            self::editBiographyAdmin();
        }
    }

    public function prepareCreateArticle(){
        self::newArticle();
    }

    public function sendContact(){
    if(isset($_POST) && !empty($_SESSION['name']) && !empty($_SESSION['email']) && !empty($_SESSION['objet'])&& !empty($_SESSION['mail'])){

    }
    else{
        self::contact();
    }
}

    public function sendNewArticle(){
        if (!empty($_POST['title'] && !empty($_POST['article']))) {
            self::sqlPrepare($this->sqlAdd, self::checkValue());
            header('Location: index.php');
        }
        else {
            self::createArticle();
        }
    }

    public function prepareEditThisArticle(){
        self::sqlPrepare($this->sqlViewEdit, self::testNumber());
        self::editArticle();
    }

    public function prepareSendEditArticle(){
        if (!empty($_POST['title'] && !empty($_POST['article']))) {
            self::sqlPrepare($this->sqlEdit, self::testAndCheck());
            header('Location: index.php');
        }
        else{
            self::editThisArticle();
        }
    }

    public function justOneArticle(){
        self::sqlPrepare($this->sqlViewOneArticle, self::testNumber());
        self::oneArticle(self::admin());
        self::sqlPrepare($this->sqlAllComment, self::commentAdmin());
        self::htmlAllComment();
    }

    public function prepareDeleteArticle(){
        self::sqlPrepare($this->sqlDeleteAllComment, self::testNumber());
        self::sqlPrepare($this->sqlDelete, self::testNumber());
        header('Location: index.php');
    }

    public function prepareDeleteComment(){
        self::sqlPrepare($this->sqlDeleteComment, self::testNumberCom());
        self::justOneArticle();
    }

    public function prepareEditComment(){
        self::sqlPrepare($this->sqlViewEditComment, self::testNumberCom());
        self::editComment();
    }

    public function createComment(){
        self::testNumber();
        self::NewComment();
    }

    public function sendNewComment(){
        if(self::testComment()){
            self::sqlPrepare($this->sqlAddComment, self::testNumberAndCheckComment());
            header('location: index.php?action=article&number='.self::getNumber().'&online=wait');
        }
        else {
            self::createComment();
        }
    }

    public function prepareSendEditComment(){
        if (!empty($_POST['comment'])) {
            self::sqlPrepare($this->sqlEditComment, self::testAndCheckEditComment());
            header('Location: index.php?action=article&number='.self::getNumber().'');
        }
        else{
            self::editThisComment();
        }
    }

    public function prepareOnlineComment(){
        self::sqlPrepare($this->sqlOnlineComment, self::testNumberCom());
        header('Location: index.php?action=article&number='.self::getNumber().'');
    }


    public function login(){
        self::htmlLogin();
    }

    public function sendLogin(){
        self::sqlPrepare($this->sqlLogin, self::checkValueLogin());
        self::log(self::login());
    }

    public function prepareSeeOfflineComment(){
        self::sqlPrepare($this->sqlOfflineComment, self::emptyArray());
        self::seeOffline();
    }




}