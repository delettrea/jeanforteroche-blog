<?php
class Contact extends Login{
    protected $message;
    protected $objet;
    protected $expediteur;
    protected $email;
    protected $destinataire = 'aline.delettre4@gmail.com';

    /**
     * Permet de vérifier le $_Post du formulaire de contact.
     */
    protected function message(){
        extract($_POST);
        $this->message = htmlspecialchars($mail);
        $this->objet = htmlspecialchars($object);
        $this->expediteur = htmlspecialchars($name);
        $this->email = htmlspecialchars($email);
    }

    /**
     * Permet de vérifier le $_Post du formulaire de contact.
     */
    public function emailTest(){
        if(!empty($_POST['mail']) && !empty($_POST['object']) && !empty($_POST['name']) && !empty($_POST['email'])){
            $this->sendEmail();
        }
        else{
            $this->contact();
            echo "<div class='error'>Veuillez remplir tous les champs pour contacter l'auteur du site</div>";
        }
    }

    /**
     * Envoie un mail suite au formulaire de contact.
     */
    protected function sendEmail(){
        $this->message();
        $destinataire = $this->destinataire;
        $expediteur = $this->expediteur;
        $objet = $this->objet;
        $email = $this->email;
        $headers = 'MIME-Version: 1.0' . "\n";
        $headers .= 'Content-type: text/html; charset=ISO-8859-1' . "\n";
        $headers .= 'Reply-To: ' . $email . "\n";
        $headers .= 'From: "Expediteur"<' . $expediteur . '>' . "\n";
        $headers .= 'Delivered-to: ' . $destinataire . "\n";
        $message = '<div style="width: 100%; text-align: center; font-weight: bold">' . $this->message . '</div>';
        if(mail($destinataire, $objet, $message, $headers)){
            echo "<div class='wait'>L'email a bien été envoyé</div>";
        }
        else{
            echo "<div class='error'>Une erreur est survenue. L'email n'a pas été envoyé.</div>";
        }
    }
}