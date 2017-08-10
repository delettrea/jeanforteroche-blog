<?php

class Biography extends Login{

    public $sqlBiography = "SELECT * FROM `users` WHERE 1";
    public $sqlEditBiography = "UPDATE users SET biography=:biography";

    public function arrayEditBiography(){
            $array = $_POST['biography'];
            $return = array('biography' => $array);
            return $return;
    }


    public $nom;
    public $mail;
    public $tel;
    public $sujet;
    public $message;
    public $webmaster = 'aline.delettre4@gmail.com';

    public function envoi_mail(){ //fonction qui envoie le mail

        $contenu_message = "Nom : ".$this->nom."\nMail : ".$this->mail."\nSujet : ".$this->sujet."\nTelephone : ".$this->tel."\nMessage : ".$this->message;
        $entete = "From: ".$this->nom." <".$this->mail."> \nContent-Type: text/html; charset=iso-8859-1";
        mail($this->webmaster,$this->sujet,$contenu_message,$entete);

    }

    public function sendEmail(){
        $this->nom      = $_POST['name'];
        $this->mail     = $_POST['email'];
        $this->sujet    = $_POST['object'];
        $this->message  = $_POST['mail'];
        $this->envoi_mail();
    }

}

?>