<?php

namespace App\Model;

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
          $this->atk = $atk;
          return $this;
     }

     public function getHp (): ?int 
     {
          return $this->hp;
     }

     public function setHp (int $hp): self
     {
          $this->hp = $hp;
          return $this;
     }

     public function attaque(Personnage $target)
     {
          $target->setHp($target->getHp() - $this->getAtk());
     }

     public static function getCount() {
          return self::$count;
     }

}