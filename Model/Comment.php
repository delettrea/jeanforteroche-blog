<?php

class Comment extends Article {

    public $sqlAllComment = "SELECT id ,online , edit,DATE_FORMAT(comment.date, '%d/%m/%Y') AS com_day,DATE_FORMAT(comment.date, '%Hh%i') AS com_hour, email,id_com, comment.author, comment, id_article
                                  FROM article INNER JOIN comment
                                  ON article.id = comment.id_article
                                  WHERE id =:number AND (online = 'on' OR online=:online) ORDER BY comment.date DESC";
    public $sqlDeleteComment = "DELETE FROM comment WHERE id_com =:numberCom";
    public $sqlDeleteAllComment = "DELETE FROM comment WHERE id_article=:number";
    public $sqlAddComment = "INSERT INTO comment(id_article, author, email, comment, date, edit, online) VALUES (:number,:author,:email,:comment,NOW(), 'off', 'off')";
    public $sqlViewEditComment = "SELECT id_com,id_article, comment FROM `comment` WHERE id_com=:numberCom";
    public $sqlEditComment = "UPDATE comment SET comment=:comment,date=NOW(), edit='on' WHERE id_com=:numberCom";
    public $sqlOnlineComment = "UPDATE comment SET online='on'WHERE id_com=:numberCom";
    public $sqlOfflineComment = "SELECT `id_com`,comment.online, `id_article`, comment.author, article.id, `comment`, title, comment.date as date 
                                 FROM `comment` INNER JOIN article ON comment.id_article = article.id 
                                 WHERE comment.online = 'off' ORDER BY date DESC";




    public function allComment(){
        $allComment = $this->sqlPrepare2($this->sqlAllComment, $this->commentAdmin());
        return $allComment;
    }

    public function deleteComment(){
        $deleteComment = $this->sqlPrepare2($this->sqlDeleteAllComment, $this->testNumber());
        return $deleteComment;
    }

    public function editComment(){
        $editComment = $this->sqlPrepare2($this->sqlViewEdit, $this->testNumber());
        return $editComment;
    }

    public function sendEditComment(){
        $sendEditComment = $this->sqlPrepare2($this->sqlEditComment, $this->checkValueEditComment('testNumberCom'));
        return $sendEditComment;
    }

    public function newComment(){
        $newComment = $this->sqlPrepare2($this->sqlAddComment, $this->checkValueComment('testNumber'));
        return $newComment;
    }
     public function onlineComment(){
         $onlineComment = $this->sqlPrepare2($this->sqlOnlineComment, $this->testNumberCom());
         return $onlineComment;

     }

     public function offlineComment(){
         $offlineComment = $this->sqlPrepare2($this->sqlOfflineComment);
         return $offlineComment;
     }

    /**
     *  Permet de tester si le $_GET du commentaire est bien un nombre.
     * @return array Retourne un tableau avec le nombre.
     */
    protected function testNumberCom(){
        $recup = $_GET['numberCom'];
        if(preg_match('#[0-9]#', $recup)){
            $numberComment = array('numberCom' => $recup);
            return $numberComment;
        }
    }

    /**
     * Test si le $_Post du commentaire n'est pas vide sur chacun de ses paramètres.
     * @return bool
     */
    public function testComment(){
        $return = (!empty($_POST['author'] && !empty($_POST['comment'])&& !empty($_POST['email'])));
        return $return;
    }

    /**
     * Permet de garder en mémoire une valeur si les autres sont vides.
     * @param $empty string Première valeur possiblement vide.
     * @param $empty2 string Seconde valeur possiblement vide.
     * @param $keep string Valeur à sauvegarder.
     * @return mixed array avec la valeur à sauvegarder.
     */
    public function keepValueComment($empty,$empty2, $keep){
        if((empty($_POST[$empty]) || empty($_POST[$empty2])) && !empty($_POST[$keep])){
            return $_POST[$keep];
        }
    }

    /**
     * Vérifie si le $_Post du commentaire n'est pas vide
     * @return array Tableau prêt pour une requête SQL avec comment en valeur.
     */
    public function checkValueEditComment($function = null){
        extract($_POST);
        $articleArray = array('comment' => $comment);
        if($function){
            $articleArray = array_merge($articleArray, $this->$function());
        }
        return $articleArray;
    }

    /**
     * Vérifie si le $_Post de l'auteur, de l'email et du commentaire ne sont pas vides.
     * @return array Tableau prêt pour une requête SQL avec l'auteur, l'email et le commentaire.
     */
    public function checkValueComment($function = null){
        extract($_POST);
        $author = htmlspecialchars($author);
        $email = htmlspecialchars($email);
        $comment = htmlspecialchars($comment);
        $articleArray = array('author'=> $author, 'email' => $email,  'comment' => $comment);
        if(($function) && ($function == 'testNumber' || $function == 'testNumberCom()')){
            $articleArray = array_merge($articleArray, $this->$function());
        }
        return $articleArray;
    }

    public function getNumber(){
        extract($this->testNumber());
        $getNumber = $number;
        return $getNumber;
    }

    /**
     * @param $data array sur la requête SQL si le commentaire à été ou non modifié.
     * @return string Retourne un message d'erreur.
     */
    public function commentEdit($data){
        if($data['edit'] === 'on'){
            return '<p class="editAdmin">Commentaire edité par l\'administrateur</p>';
        }
    }

    /**
     * @return array Permet de montrer tous les commentaires si on est Admin ou seulement ceux en ligne.
     */
    public function commentAdmin(){
        if(!empty($_SESSION) && $_SESSION['authorization_user'] == "admin"){
            $on = array(':online' => 'off');
            $commentAdmin = array_merge($this->testNumber(), $on);
            return $commentAdmin;
        }
        else{
            $on = array(':online' => 'on');
            $commentAdmin = array_merge($this->testNumber(), $on);
            return $commentAdmin;
        }
    }
}