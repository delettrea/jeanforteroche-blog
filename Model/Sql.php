<?php

/**
 * Class Sql
 * Prépare PDO pour la base de données et l'exécute.
 */
class Sql extends Data{


     public $request;
     public $requestBio;

    /**
     * @param $sql Requête SQL.
     * @param $array Tableau permettant le lancer execute après le prepare.
     */
     protected function sqlPrepare($sql,$array){
         $this->request=$this->bdd->prepare($sql);
         $this->request->execute($array);
     }


 }