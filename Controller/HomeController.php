<?php

class HomeController extends TemplateLegal {


    /**
     * Prepare la fonction pour visualiser les articles.
     */
    protected function prepareSeeAllArticle(){
        $this->htmlWithOfflineComment($this->offlineComment());
        $this->htmlAllArticle($this->admin(), $this->allArticle());
    }

    /**
     * Prepare la fonction pour visualiser la biographie de l'auteur.
     */
    protected function prepareBiography(){
        $this->htmlBiography($this->thisBiography());
    }

    /**
     * Prepare la fonction pour créé un nouvel article.
     */
    protected function prepareCreateArticle(){
        $this->newArticle();
    }

    /**
     * Prepare la fonction pour envoyer un mail de contact.
     */
    protected function prepareEmail(){
        if(isset($_POST) && !empty($_SESSION['name']) && !empty($_SESSION['email']) && !empty($_SESSION['objet'])&& !empty($_SESSION['mail'])){
            $this->sendEmail();
            header('Location: index.php');
        }
        else{
            $this->contact();
        }
    }

    /**
     * Prépare la fonction pour afficher un article et ses commentaires.
     */
    protected function justOneArticle(){
        $this->htmlOneArticle($this->admin(), $this->oneArticle());
        $this->htmlAllComment($this->allComment());
    }



    /**
     * Prepare la fonction pour créer des commentaires.
     */
    protected function createComment(){
        $this->testNumber();
        $this->htmlNewComment();
    }

    /**
     * Prepare la fonction pour envoyer le nouveau commentaire.
     */
    protected function sendNewComment(){
        if($this->testComment()){
            $this->newComment();
            header('location: index.php?action=article&number='.$this->getNumber().'&online=wait');
        }
        else {
            $this->createComment();
        }
    }

    /**
     * Prepare la fonction pour se connecter au site.
     */
    protected function login(){
        $this->htmlLogin();
    }

    /**
     * Prépare la fonction qui vérifie si les données de connexion sont exactes.
     */
    protected function sendLogin(){
        $this->log('login', $this->sendThisLogin());
        header('Location: index.php');
    }





}