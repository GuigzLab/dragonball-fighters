<?php

namespace App\Model;

use \Exception;

class Personnage {

     private $id;

     private $name;
     
     private $atk;
     
     private $hp;

     private $type;

     protected static $count = 0;

     public function __construct(array $data)
     {
          foreach ($data as $key => $value){
               $method = 'set'.ucfirst($key);
               if (method_exists($this, $method)) {
                    $this->$method($value);
               }
          }
          self::$count++;
     }

     public function getId (): ?int 
     {
          return $this->id;
     }

     public function setId (int $id): self
     {
          $this->id = $id;
          return $this;
     }

     public function getName (): ?string 
     {
          return $this->name;
     }

     public function setName (string $name): self
     {
          $this->name = $name;
          return $this;
     }

     public function getType (): ?string 
     {
          return $this->type;
     }

     public function setType (string $type): self
     {
          $this->type = $type;
          return $this;
     }

     public function getAtk (): ?int 
     {
          return $this->atk;
     }

     public function setAtk (int $atk): self
     {
          ($atk > 10) ? $this->atk = $atk : $this->atk = 10;
          return $this;
     }

     public function getHp (): ?int 
     {
          return $this->hp;
     }

     public function setHp (int $hp): self
     {
          ($hp > 0) ? $this->hp = $hp : $this->hp = 0;
          return $this;
     }

     public function canAttack(Personnage $target)
     {
          if ($this->isAlive() && $target->isAlive()){
               if ($this->getType() === 'ally'){
                    return ($target->getType() === 'enemy') ? true : false;
               } else {
                    return true;
               }
          }
          return false;
     }

     public function isAlive(){
          return ($this->getHp() > 0) ? true : false;
     }

     public function attack(Personnage $target)
     {
          if ($this->canAttack($target)){
               ($target->getHp() - $this->getAtk() > 0) ? $target->setHp($target->getHp() - $this->getAtk()) : $target->setHp(0);
          } else {
               throw new Exception('Impossible d\'attaquer ce personnage');
          }
     }

     public static function getCount() {
          return self::$count;
     }

}