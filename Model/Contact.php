<?php

class Contact extends Login{

    public $message;
    public $objet;
    public $expediteur;
    public $email;
    public $destinataire = 'aline.delettre4@gmail.com';

    /**
     * Permet de vérifier le $_Post du formulaire de contact.
     */
    public function message(){
        extract($_POST);
        $this->message = $mail;
        $this->objet = htmlspecialchars($object);
        $this->expediteur = htmlspecialchars($name);
        $this->email = $email;
    }

    /**
     * Envoie un mail suite au formulaire de contact.
     */
    public function sendEmail(){
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
        mail($destinataire, $objet, $message, $headers);

    }

}