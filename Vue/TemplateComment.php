<?php

class TemplateComment extends TemplateArticle {

    public function htmlAllComment(){
        ?>
        <div class="allComment">
            <?php
            while ($data = $this->request->fetch()) {
                ?>
                <div class="comment">
                    <p><span class="author_comment"><?= self::seeEmail($data) ?> </span> <br> <span class="span_comment">le <?php echo $data['com_day']; ?>
                            à <?php echo $data['com_hour']; ?></p></span>
                    <p><?php echo $data['comment']; ?></p>
                    <?php
                    echo self::commentEdit($data);
                    self::buttonAllCommentAdmin($data);
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }

    public function seeEmail($data){
        if(!empty($_SESSION) && $_SESSION['authorization_user'] == "admin"){
            return "<a class='e-mail' href='".$data['email']."'>".$data['author']."</a>";
        }
        else{
            return $data['author'];
        }
    }

    public function buttonAllCommentAdmin($data){
        if(!empty($_SESSION) && $_SESSION['authorization_user'] == "admin") {
            if($data['online'] == "off") {
                ?>
                <div>
                <div class="online">
                    <a class="button" id="online" href="<?= 'index.php?action=online&number=' . $data['id_article'] . '&numberCom=' . $data['id_com'] . '' ?>">Mettre en ligne</a>
                </div>
                <?php
            }
            ?>
            <div class="editComment">
                <a class="button" id="editCom" href="<?= 'index.php?action=editComment&number=' . $data['id_article'] . '&numberCom=' . $data['id_com'] . '' ?>">Modifier le commentaire</a>
            </div>
            <div class="delete">
                <a class="button" id="deleteCom" href="<?= 'index.php?action=deleteComment&number=' . $data['id_article'] . '&numberCom=' . $data['id_com'] . '' ?>">Supprimer</a>
            </div>
            </div>
            <?php
        }
    }

    public function NewComment(){
        ?>
        <section class="newComment">
            <form class="form" method="post" action="index.php?action=sendNewComment&number=<?= self::getNumber()?>">
                <h3>Ajouter un commentaire</h3>
                <div class="author">
                    <label>Votre nom : </label><input type="text" name="author" placeholder="Auteur du commentaire" value="<?php echo self::keepValueComment('email','comment','author') ?>" />
                    <?php self::error('author') ?>
                </div>
                <div class="email">
                    <label>Votre email : </label><input type="email" name="email" placeholder="Votre email" value="<?php echo self::keepValueComment('author','comment','email') ?>" />
                    <?php self::error('email') ?>
                </div>
                <textarea name="comment" class="comment" placeholder="Ecrivez votre commentaire ici" value="<?php echo self::keepValueComment('email','author','comment') ?>"></textarea>
                <?php self::error('comment') ?>
                <input class="button" type="submit" value="Ajouter ce commentaire" />
            </form>
        </section>
        <?php

    }

    public function editComment(){
        while ($data = $this->request->fetch()){
            ?>
            <section>
                <form class="form" method="post" action=<?= "index.php?action=sendEditComment&number=".$data['id_article']."&numberCom=" . $data['id_com'] . ""?>>
                    <h3>Modifier un commentaire</h3>
                    <textarea name="comment" class="comment" ><?= $data['comment'] ?></textarea>
                    <?php self::error('comment') ?>
                    <input class="button" type="submit" value="Modifier le commentaire" />
                </form>
            </section>
            <?php
        }

    }

    public function offlineComment(){
        if (!empty($_SESSION) && $_SESSION['authorization_user'] == "admin") {
            ?>
            <div class="offlineComment">
                <p>Vous avez des commentaires hors lignes à valider.</p> <a class="button" href="index.php?action=offlineComment">Voir les commentaires</a>
            </div>
            <?php
        }
    }

    public function seeOffline(){
        ?>
        <div class="allComment">
            <?php
            while ($data = $this->request->fetch()) {
                ?>
                <div class="comment">
                    <p> <span class="grey">Article :</span><?= $data['title'] ?></p>
                    <p> <span class="grey">Auteur du commentaire :</span> <?= $data['author'] ?></p>
                    <p> <span class="grey">Commentaire :</span> <?= $data['comment'] ?></p>
                    <?php
                    self::buttonAllCommentAdmin($data);
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }

}