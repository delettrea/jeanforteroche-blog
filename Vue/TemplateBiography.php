<?php

class TemplateBiography extends TemplateLogin{

    public function seeBiography(){
        $data2 = $this->request->fetch();
        ?>
        <section id="section2">
            <?php
            echo '<p class="login-bio">'.$data2['login'].'</p>';
            ?>

            <img class="portrait" src="img/portrait.jpg" alt="JeanForteroche"/>

            <?php
            echo '<p class="biographie">'.$data2['biography'].'</p>';
            self::buttonBiography();
            ?>
        </section>
        <?php

    }


    public function buttonBiography(){
        if(!empty($_SESSION) && $_SESSION['authorization_user'] == 'admin'){
            ?>
            <div class="biography">
                <a class="button" href="index.php?action=editBiography">Modifier ma biographie</a>
            </div>
            <?php
        }

    }

    public function editBiography(){
        while($data = $this->request->fetch()) {
            ?>
            <div class="editBiography">
                <h2>Modifier ma biography</h2>
                <form class="form" method="post" action=<?= "index.php?action=sendEditBiography" ?>>
                    <div class="textarea">
                        <textarea name="biography"><?php echo $data['biography'] ?></textarea>
                        <?php self::error('biographie') ?>
                    </div>
                    <input class="button" type="submit" value="Modifier ma biographie" />
                </form>
            </div>
            <?php
        }
    }

    public function contact(){
        ?>
        <section class="contact">
            <form class="form" method="post" action=<?= "index.php?action=sendEmail" ?>>
                <h2>Contacter l'auteur du blog</h2>
                <div class="name">
                    <label>Votre nom : </label><input type="text" name="name" placeholder="Titre de l'article" value="" "/>
                </div>
                <div class="email">
                    <label>Votre email : </label><input type="email" name="email" placeholder="Titre de l'article" value="" "/>
                </div>
                <div class="object">
                    <label>Sujet de votre contact : </label><input type="text" name="object" placeholder="Titre de l'article" value="" "/>
                </div>
                <div class="textarea">
                    <textarea name="mail" class="article"></textarea>
                </div>
                <input class="button" type="submit" value="Contacter l'auteur" />
            </form>
        </section>
        <?php
    }

}
