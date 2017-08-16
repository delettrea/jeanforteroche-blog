<?php

class Article extends Sql {

    public $sqlEdit = "UPDATE article SET author=:author,title= :title,article=:article,date = NOW() WHERE id =:number";
    public $sqlDelete ="DELETE FROM article WHERE id=:number";
    public $sqlAdd = "INSERT INTO article(author, title, article, date) VALUES (:author,:title,:article,NOW())";
    public $sqlViewOneArticle = "SELECT id, author, title, article,DATE_FORMAT(date, '%d/%m/%Y') AS day,DATE_FORMAT(date, '%Hh%i') AS hour FROM article WHERE id =:number";
    public $sqlViewEdit = "SELECT id, author, title, article FROM article WHERE id =:number";
    protected $sqlViewAllArticle = "SELECT `id`,article.author,`title`,`article`, article.date, DATE_FORMAT(article.date,'%d/%m/%Y') AS day, DATE_FORMAT(article.date,'%Hh%i') AS hour,`id_com`, `id_article`, comment.date AS dateCom,GROUP_CONCAT(DISTINCT comment.date) AS dateCom, SUM(IF(comment.online = 'on',1,0)) AS `nbCommentaire` 
                                  FROM `article` LEFT JOIN comment 
                                  ON article.id = comment.id_article
                                  GROUP BY `id` ORDER BY article.date DESC";


    /**
     * Permet de tester si le $_GET est bien un nombre.
     * @return array Retourne un tableau avec le nombre.
     */
    public function testNumber(){
        $recup = $_GET['number'];
        if(preg_match('#[0-9]#', $recup)) {
            $number = array('number' => $recup);
            return $number;
        }
    }


    public function allArticle(){
        $allArticle = $this->sqlPrepare2($this->sqlViewAllArticle);
        return $allArticle;
    }

    public function oneArticle(){
        $oneArticle = $this->sqlPrepare2($this->sqlViewOneArticle, $this->testNumber());
        return $oneArticle;
    }

    public function sendArticle(){
        $sendArticle = $this->sqlPrepare2($this->sqlAdd, $this->checkValue());
        return $sendArticle;
    }

    public function editArticle(){
        $editArticle = $this->sqlPrepare2($this->sqlViewEdit, $this->testNumber());
        return $editArticle;
    }

    public function sendEditThisArticle(){
        $sendEditArticle = $this->sqlPrepare2($this->sqlEdit, $this->checkValue('testNumber'));
        return $sendEditArticle;
    }

    public function deleteArticle(){
        $deleteArticle = $this->sqlPrepare2($this->sqlDelete, $this->testNumber());
        return $deleteArticle;
    }

    /**
     * Test si le $_Post n'est pas vide sur chacun de ses paramètres.
     * @return bool
     */
    public function testArticle(){
        $return = (!empty($_POST) || !empty($_POST['author'] && !empty($_POST['title']) && !empty($_POST['article'])));
        return $return;
    }

    /**
     * @return array Retourne un tableau prêt pour compléter une requête SQL.
     */
    public function checkValue($function = null){
        extract($_POST);
        $title = htmlspecialchars($title);
        $articleArray = array('author'=> $_SESSION['login'], 'title' => $title, 'article' => $article);
        if($function){
            $articleArray = array_merge($articleArray, $this->$function());
        }
        return $articleArray;

    }

}