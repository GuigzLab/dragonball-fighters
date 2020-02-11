<?php

namespace App\Model;

class Guerrier extends Personnage {
     const BONUS = 20;
     private $bonusAtk = self::BONUS;
     private $type = "Guerrier";

     public function attaque(Personnage $target)
     {
          $this->atk += self::BONUS;
          parent::attaque($target);
     }
}