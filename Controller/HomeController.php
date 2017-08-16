<?php

class HomeController extends TemplateLegal {


    /**
     * Prepare la fonction pour visualiser les articles.
     */
    public function prepareSeeAllArticle(){
        $this->htmlWithOfflineComment($this->offlineComment());
        $this->htmlAllArticle($this->admin(), $this->allArticle());
    }

    /**
     * Prepare la fonction pour visualiser la biographie de l'auteur.
     */
    public function prepareBiography(){
        $this->htmlBiography($this->thisBiography());
    }

    /**
     * Prepare la fonction pour créé un nouvel article.
     */
    public function prepareCreateArticle(){
        $this->newArticle();
    }

    /**
     * Prepare la fonction pour envoyer un mail de contact.
     */
    public function prepareEmail(){
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
    public function justOneArticle(){
        $this->htmlOneArticle($this->admin(), $this->oneArticle());
        $this->htmlAllComment($this->allComment());
    }



    /**
     * Prepare la fonction pour créer des commentaires.
     */
    public function createComment(){
        $this->testNumber();
        $this->htmlNewComment();
    }

    /**
     * Prepare la fonction pour envoyer le nouveau commentaire.
     */
    public function sendNewComment(){
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
    public function login(){
        $this->htmlLogin();
    }

    /**
     * Prépare la fonction qui vérifie si les données de connexion sont exactes.
     */
    public function sendLogin(){
        $this->log('login', $this->sendThisLogin());
        header('Location: index.php');
    }





}