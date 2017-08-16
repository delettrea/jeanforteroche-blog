<?php

class Biography extends Contact
{

    public $sqlBiography = "SELECT * FROM `users` WHERE 1";
    public $sqlEditBiography = "UPDATE users SET biography=:biography";


    public function thisBiography(){
        $biography = $this->sqlPrepare2($this->sqlBiography);
        return $biography;
    }

    public function editBiography(){
        $editBiography = $this->sqlPrepare2($this->sqlEditBiography, $this->arrayEditBiography());
        return $editBiography;
    }

    /**
     * @return array Tableau pour la requête SQL qui modifie la biographie.
     */
    public function arrayEditBiography(){
        $array = $_POST['biography'];
        $return = array('biography' => $array);
        return $return;
    }

}