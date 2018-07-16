<?php

/**
 * Class Data
 * Permet de se connecter à la base de données.
 */
class Data{

    const HOST = 'localhost';
    const DBNAME = 'projet3';
    const USERNAME = 'root';
    const PASSWORD = '';
    protected $bdd;

    /**
     * Data constructor.
     * Se connecte à la base de données.
     */
    public function __construct(){
        try{
            $this->bdd = new PDO('mysql:host='.self::HOST.';dbname='.self::DBNAME.';charset=utf8', ''.self::USERNAME .'', ''.self::PASSWORD.'');
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
        return $this->bdd;
    }

}