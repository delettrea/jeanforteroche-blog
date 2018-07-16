<?php


class TemplateArticle extends  Biography {

    /**
     * Permet de visualiser tous les articles.
     * @param $type Fonction admin().
     */
    protected function htmlAllArticle($type, $request){
        ?>
        <section id="section1">
            <?php
            $this->buttonNewArticle($type);
            while ($data = $request->fetch()){
                ?>
                <div class="article">
                    <a href="<?= 'index.php?action=article&number='.$data['id'].''?>"><h2><?= $data['title'] ?></h2>
                    </a>
                    <p><?= $data['article'] ?></p>
                    <h6>Article écrit par <?= $data['author'] ?> le <?= $data['date'] ?>
                        à <?= $data['hour'] ?></h6>
                    <?php
                    $this->testNumberCommentArticle($data);
                    ?>
                    <a class="button" id="ajoutCommentaire" href="<?= "index.php?action=newComment&number=" . $data['id'] . "" ?>">Ajouter un commentaire</a>
                    <?php
                    $this->buttonArticleAdmin($type, $data);
                    ?>
                </div>
                <?php
            }
            ?>
        </section>
        <?php
    }

    /**
     * Afficher le bouton de création d'article de l'administrateur.
     * @param $type $type hérité de la fonction htmlAllArticle().
     */
    protected function buttonNewArticle($type){
        if($type == "admin"){
            ?>
            <div class="buttonNewArticle">
                <a class="button" href="index.php?action=new">Ajouter un article</a>
            </div>
            <?php
        }
    }

    /**
     * Afficher les boutons de gestion de l'administrateur.
     * @param $type $type hérité de la fonction htmlAllArticle().
     * @param $data $data hérité de la fonction htmlAllArticle().
     */
    protected function buttonArticleAdmin($type, $data){
        if($type == "admin") {
            ?>
            <div class="buttonAdmin">
                <div class="new">
                    <a class="button" id="modifier" href="index.php?action=edit&number=<?= $data['id']?> ">Modifier l'article</a>
                </div>
                <div class="delete">
                    <a class="button" id="supprimer" href="<?= "index.php?action=confirmDelete&number=" . $data['id'] . "" ?>">Supprimer l'article</a>
                </div>
            </div>
            <?php
        }
        else{
            ?>
            <?php
        }
    }

    /**
     * Permet de vérifier le nombre de commentaires dans chaque article.
     * @param $data résultat d'une requête sql.
     */
    private function testNumberCommentArticle($data){
        $holds = $data['dateCom'];
        $holds = explode(',', $holds);
        if($data['nbCommentaire'] < 1){
            ?><a href="<?= 'index.php?action=article&number='.$data['id'].''?>"><p>Aucun commentaire</p></a>
            <?php
        }
        else if($data['nbCommentaire'] <= 1){
            ?><a href="<?= 'index.php?action=article&number='.$data['id'].''?>"><p><?= $data['nbCommentaire']?> commentaire. <br/>Dernier commentaire le <?= end($holds) ?></p>
            </a><?php
        }
        else{
            ?><a href="<?= 'index.php?action=article&number='.$data['id'].''?>"><p><?= $data['nbCommentaire']?> commentaires. <br/>Dernier commentaire le <?= end($holds) ?></p>
            </a><?php
        }
    }

    /**
     * Permet de visualiser de quoi créer un nouvel article.
     */
    protected function newArticle(){
        ?>
        <section>
            <form class="form" method="post" action="index.php?action=sendNew">
                <h2>Ajouter un article</h2>
                <div class="title">
                    <label>Titre de votre article : </label><input type="text" name="title" placeholder="Titre de l'article" value="<?php echo $this->keepValue('article','title') ?>" "/>
                    <?php $this->error('title') ?>
                </div>
                <div class="textarea">
                    <textarea name="article" class="article" placeholder="Ecrivez votre article ici"><?php echo $this->keepValue('title','article') ?></textarea>
                    <?php $this->error('article') ?>
                </div>
                <input class="button" type="submit" value="Créer l'article" />
            </form>
        </section>
        <?php

    }

    /**
     * Permet de visualiser un formulaire de modification d'article.
     */
    protected function htmlEditArticle($request){
        while ($data = $request->fetch()) {
            ?>
            <section>
                <form class="form" method="post" action=<?= "index.php?action=sendEdit&number=" . $data['id'] . "" ?>>
                    <h2>Editer un article</h2>
                    <div class="title">
                        <label>Titre de votre article : </label><input type="text" name="title" placeholder="Titre de l'article" value="<?php echo $data['title'] ?>" "/>
                        <?php $this->error('title') ?>
                    </div>
                    <div class="textarea">
                        <textarea name="article" class="article"><?php echo $data['article'] ?></textarea>
                        <?php $this->error('article') ?>
                    </div>
                    <input class="button" type="submit" value="Modifier l'article" />
                </form>
            </section>
            <?php
        }
    }

    /**
     * Permet de visualiser un seul article.
     * @param $type string Fonction admin().
     * @param
     */
    protected function htmlOneArticle($type, $request){
        while ($data = $request->fetch()){
            if(!empty($_GET['online'])&& $_GET['online'] == "wait" ){
                echo '<p class="wait">Veuillez attendre que l\'administrateur valide votre commentaire, s\'il vous plait.</p>';
            }
            ?>
            <div class="oneArticle">
                <h2><?= $data['title'] ?></h2>
                <p><?= $data['article'] ?></p>
                <h6>Article écrit par <?= $data['author'] ?> le <?= $data['day'] ?> à <?= $data['hour'] ?></h6>
                <div class="addComment">
                    <a class="button" id="ajoutCommentaire" href="<?= "index.php?action=newComment&number=" . $data['id'] . "" ?>">Ajouter un commentaire</a>
                </div>
                <?php
                $this->buttonOneArticle($type)
                ?>
            </div>
            <?php
        }
    }

    /**
     * Afficher les boutons de gestion de l'administrateur pour un article.
     * @param $type $type hérité de la fonction oneArticle().
     */
    protected function buttonOneArticle($type){
        if($type == "admin"){
            ?>
            <div class="editComment">
                <a class="button" id="modifier" href="<?="index.php?action=edit&number=".$data['id']."" ?>">Modifier l'article</a>
            </div>
            <br>
            <div class="delete">
                <a class="button" id="supprimer" href="<?= "index.php?action=delete&number=" . $data['id'] . "" ?>">Supprimer l'article</a>
            </div>
            <?php
        }
    }

    protected function htmlDeleteArticle(){
        if(isset($_GET['number']) && preg_match('#[0-9]#',$_GET['number'])){
            ?>
            <div class="confirmDelete">
                <p class="error">Souhaitez vous vraiment supprimer l'article <?= $_GET['number']?> ?</p>
                <div class="buttonAdmin">
                    <div class="no">
                        <a class="button" id="no" href="index.php">Non</a>
                    </div>
                    <div class="delete">
                        <a class="button" id="supprimer" href="<?= "index.php?action=delete&number=" . $_GET['number'] . "" ?>">Oui</a>
                    </div>
                </div>
            </div>
            <?php
        }
        else{
            echo '<p class="error">Il est impossible de supprimer cet article</p>';
        }
    }
}