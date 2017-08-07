<?php

class Comment extends Article {

    public $sqlAllComment = "SELECT id ,online , edit,DATE_FORMAT(comment.date, '%d/%m/%Y') AS com_day,DATE_FORMAT(comment.date, '%Hh%i') AS com_hour, email,id_com, comment.author, comment, id_article
                                  FROM article INNER JOIN comment
                                  ON article.id = comment.id_article
                                  WHERE id =:number AND (online = 'on' OR online=:online) ORDER BY comment.date DESC";
    public $sqlDeleteComment = "DELETE FROM comment WHERE id_com =:numberCom";
    public $sqlDeleteAllComment = "DELETE FROM comment WHERE id_article=:number";
    public $sqlAddComment = "INSERT INTO comment(id_article, author, email, comment, date, edit) VALUES (:number,:author,:email,:comment,NOW(), 'off')";
    public $sqlViewEditComment = "SELECT id_com,id_article, comment FROM `comment` WHERE id_com=:numberCom";
    public $sqlEditComment = "UPDATE comment SET comment=:comment,date=NOW(), edit='on' WHERE id_com=:numberCom";
    public $sqlOnlineComment = "UPDATE comment SET online='on'WHERE id_com=:numberCom";
    public $sqlOfflineComment = "SELECT `id_com`,comment.online, `id_article`, comment.author, article.id, `comment`, title, comment.date as date 
                                 FROM `comment` INNER JOIN article ON comment.id_article = article.id 
                                 WHERE comment.online = 'off' ORDER BY date DESC";


    protected function testNumberCom(){
        $recup = $_GET['numberCom'];
        if(preg_match('#[0-9]#', $recup)){
            $numberComment = array('numberCom' => $recup);
            return $numberComment;
        }
    }

    public function testComment(){
        $return = (!empty($_POST['author'] && !empty($_POST['comment'])));
        return $return;
    }

    public function keepValueComment($empty,$empty2, $keep){
        if((empty($_POST[$empty]) || empty($_POST[$empty2])) && !empty($_POST[$keep])){
            return $_POST[$keep];
        }
    }

    public function checkValueEditComment(){
        extract($_POST);
        $articleArray = array('comment' => $comment);
        return $articleArray;
    }

    public function checkValueComment(){
        extract($_POST);
        $author = htmlspecialchars($author);
        $email = htmlspecialchars($email);
        $articleArray = array('author'=> $author, 'email' => $email,  'comment' => $comment);
        return $articleArray;
    }

    public function testNumberAndCheckComment(){
        $testAndCheck = array_merge(self::testNumber(), self::checkValueComment());
        return $testAndCheck;
    }

    public function testAndCheckComment(){
        $testAndCheck = array_merge(self::testNumberCom(), self::checkValueComment());
        return $testAndCheck;
    }

    public function testAndCheckEditComment(){
        $testAndCheck = array_merge(self::testNumberCom(), self::checkValueEditComment());
        return $testAndCheck;
    }

    public function getNumber(){
        extract(self::testNumber());
        $getNumber = $number;
        return $getNumber;
    }

    public function commentEdit($data){
        if($data['edit'] === 'on'){
            return '<p class="editAdmin">Commentaire editer par l\'administrateur</p>';
        }
    }

    public function commentAdmin(){
        if(!empty($_SESSION) && $_SESSION['authorization_user'] == "admin"){
            $on = array(':online' => 'off');
            $commentAdmin = array_merge(self::testNumber(), $on);
            return $commentAdmin;
        }
        else{
            $on = array(':online' => 'on');
            $commentAdmin = array_merge(self::testNumber(), $on);
            return $commentAdmin;
        }
    }

    public function emptyArray(){
        $emptyArray = array();
        return $emptyArray;
    }

}