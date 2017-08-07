<?php

 class Sql extends Data{


     public $request;
     public $requestBio;

     protected function sqlPrepare($sql,$array){
         $this->request=$this->bdd->prepare($sql);
         $this->request->execute($array);
     }


 }