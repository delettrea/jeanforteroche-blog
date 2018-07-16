<?php

/**
 * Class Sql
 * Prépare PDO pour la base de données et l'exécute.
 */
class Sql extends Data{

    /**
     * Permet de lancer une requête sql prepare ou une requête query.
     * @param $sql string Requête SQL.
     * @param $array array ou vide permettant de le lancer execute après le prepare ou de faire un query.
     * @return pdoStatement requête sql
     */
     protected function sqlPrepare($sql,$array = null){
         if($array){
             $request=$this->bdd->prepare($sql);
             $request->execute($array);
             return $request;
         }
         else{
             $request = $this->bdd->query($sql);
             return $request;
         }

     }

}