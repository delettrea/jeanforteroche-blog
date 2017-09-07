<?php

class Biography extends Contact
{

    protected $sqlBiography = "SELECT * FROM `users` WHERE 1";
    protected $sqlEditBiography = "UPDATE users SET biography=:biography";

    /**
     * Fonction sql permettant de voir la biography.
     * @return pdoStatement
     */
    protected function thisBiography(){
        $biography = $this->sqlPrepare($this->sqlBiography);
        return $biography;
    }

    /**
     * Fonction sql permettant d'éditer la biographie.
     * @return pdoStatement
     */
    protected function editBiography(){
        $editBiography = $this->sqlPrepare($this->sqlEditBiography, $this->arrayEditBiography());
        return $editBiography;
    }

    /**
     * @return array Tableau pour la requête SQL qui modifie la biographie.
     */
    protected function arrayEditBiography(){
        $array = $_POST['biography'];
        $return = array('biography' => $array);
        return $return;
    }

}