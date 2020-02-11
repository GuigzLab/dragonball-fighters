<?php

namespace App\Model;

class Guerisseur extends Personnage {

     private $type = "Guerisseur";

     public function regenerer(?int $amount = NULL):void
     {
          if (is_null($amount)){
               $this->pv = $this->maxPv;
          } else {
               // if ($this->pv + $amount <= $this->maxPv){
               //      $this->pv += $amount;
               // } else {
               //      $this->pv = $this->maxPv;
               // }
               if ($this->pv + $amount <= self::MAXLIFE){
                    $this->pv += $amount;
               } else {
                    $this->pv = self::MAXLIFE;
               }
          }
     }
}