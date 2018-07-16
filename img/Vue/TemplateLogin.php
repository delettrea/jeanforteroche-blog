<?php

class TemplateLogin extends TemplateComment {

    /**
     * Formulaire de connexion au site.
     */
    protected function htmlLogin(){
        ?>
        <form class="login" method="post" action="<?php echo 'index.php?action=sendLogin' ?>">
            <div>
            <h3>Connexion</h3>
                <div class="pseudo">
            <label>Pseudo : </label><input type="text" name="login" value="<?php echo $this->keepValue('password','login') ?>"/>
                <?php $this->error('login') ?>
                </div>
            <div class="password">
            <label>Mot de passe : </label><input type="password" name="password"/>
                <?php $this->error('password') ?>
            </div>
            <input class="button" type="submit" value="Connexion" />
            </div>
        </form>
        <?php
    }


}