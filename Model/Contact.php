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
     * Permet d'envoyer un email si les champs ne sont pas vides.
     * @param $function
     */
    protected function email($function){
        $this->message();
        if(!empty($this->message)&& !empty($this->objet)&& !empty($this->expediteur)&& !empty($this->email) && (filter_var($this->email, FILTER_VALIDATE_EMAIL) == false)){
            $this->$function();
        }
        else{
            $this->sendEmail();
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
        mail($destinataire, $objet, $message, $headers);

    }

}