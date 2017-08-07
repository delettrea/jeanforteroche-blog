<?php

class TemplateLogin extends TemplateComment {

    public function htmlLogin(){
        ?>
        <form class="login" method="post" action="<?php echo 'index.php?action=sendLogin' ?>">
            <div>
            <h3>Connexion</h3>
                <div class="pseudo">
            <label>Pseudo : </label><input type="text" name="login" value="<?php echo self::keepValue('password','login') ?>"/>
                <?php self::error('login') ?>
                </div>
            <div class="password">
            <label>Mot de passe : </label><input type="password" name="password"/>
                <?php self::error('password') ?>
            </div>
            <input class="button" type="submit" value="Connexion" />
            </div>
        </form>
        <?php
    }


}