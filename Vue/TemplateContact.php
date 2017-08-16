<?php

class TemplateContact extends TemplateLogin{

    /**
     * Formulaire permettant de prendre contact avec l'auteur du blog.
     */
    protected function contact(){
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