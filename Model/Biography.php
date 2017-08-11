<?php

class Biography extends Contact
{

    public $sqlBiography = "SELECT * FROM `users` WHERE 1";
    public $sqlEditBiography = "UPDATE users SET biography=:biography";

    /**
     * @return array Tableau pour la requête SQL qui modifie la biographie.
     */
    public function arrayEditBiography(){
        $array = $_POST['biography'];
        $return = array('biography' => $array);
        return $return;
    }

}