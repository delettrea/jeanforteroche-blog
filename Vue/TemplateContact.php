<?php

class TemplateContact extends TemplateLogin{

    /**
     * Formulaire permettant de prendre contact avec l'auteur du blog.
     */
    protected function contact(){
        ?>
        <section class="contact">
            <form class="formContact form" method="post" action="index.php?action=sendContact">
                <div class="space white name">
                    <label class="fade5">Votre nom : </label><input class="fade5" type="text" name="name" id="name" value="<?php echo $this->keepValueContact('email','object','mail','name') ?>"/>
                </div>
                <div class="space white email ">
                    <label class="fade5">Votre email : </label><input class="fade5" type="email" name="email" id="email" placeholder=""/>
                </div>
                <div class="space white object">
                    <label class="fade5">Sujet de votre message : </label><input class="fade5" type="text" name="object" id="object" placeholder=""/>
                </div>
                <div class="space white">
                    <label class="fade5">Votre message : </label>
                    <textarea name="mail" id="mail" class="article fade5"></textarea>
                </div>
                <div class="space white">
                    <input id="this" class="button fade5" type="submit" value="Contacter" />
                </div>
            </form>
            <div id="messages" class="space white fade5"></div>
        </section>
        <?php
    }


}