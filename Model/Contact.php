<?php
class Contact extends Login{
    protected $message;
    protected $objet;
    protected $expediteur;
    protected $email;
    protected $destinataire = 'aline.delettre4@gmail.com';


    protected function keepValueContact($empty,$empty2,$empty3, $keep){
        if((empty($_POST[$empty]) || empty($_POST[$empty2]) || empty($_POST[$empty3])) && !empty($_POST[$keep])){
            return $_POST[$keep];
        }
    }


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
    protected function email(){
        if(!empty($_POST['message']) && !empty($_POST['objet']) && !empty($_POST['expediteur']) && !empty($_POST['email']) && (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == true)){
           echo 'ICI';
            $this->sendEmail();
        }
        else{
            header('Location:index.php?action=contact');
        }
    }
    /**
     * Envoie un mail suite au formulaire de contact.
     */
    protected function sendEmail(){
        echo 'ICI2';
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