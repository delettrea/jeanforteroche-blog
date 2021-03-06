<?php

class TemplateBiography extends TemplateContact {

    /**
     * Permet d'afficher la biographie de l'auteur et sa photo.
     */
    protected function htmlBiography($request){
        $data2 = $request->fetch();
        ?>
        <section id="section2">
            <?php
            echo '<p class="login-bio">'.$data2['login'].'</p>';
            ?>

            <img class="portrait" src="img/portrait.jpg" alt="JeanForteroche"/>

            <?php
            echo '<p class="biographie">'.$data2['biography'].'</p>';
            $this->buttonBiography();
            ?>
        </section>
        <?php

    }

    /**
     * Afficher les boutons de gestion de l'administrateur pour la biographie.
     */
    protected function buttonBiography(){
        if(!empty($_SESSION) && $_SESSION['authorization_user'] == 'admin'){
            ?>
            <div class="biography">
                <a class="button" href="index.php?action=editBiography">Modifier ma biographie</a>
            </div>
            <?php
        }

    }

    /**
     * Permet de visualiser un formulaire de modification de la biographie.
     */
    protected function htmlEditBiography($request){
        while($data = $request->fetch()) {
            ?>
            <div class="editBiography">
                <h2>Modifier ma biography</h2>
                <form class="form" method="post" action=<?= "index.php?action=sendEditBiography" ?>>
                    <div class="textarea">
                        <textarea name="biography"><?php echo $data['biography'] ?></textarea>
                        <?php $this->error('biographie') ?>
                    </div>
                    <input class="button" type="submit" value="Modifier ma biographie" />
                </form>
            </div>
            <?php
        }
    }


}
