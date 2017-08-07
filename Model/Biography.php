<?php

class Biography extends Login{

    public $sqlBiography = "SELECT * FROM `users` WHERE 1";
    public $sqlEditBiography = "UPDATE users SET biography=:biography";

    public function arrayEditBiography(){
            $array = $_POST['biography'];
            $return = array('biography' => $array);
            return $return;
    }



}