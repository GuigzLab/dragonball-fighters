<?php

namespace App\Table;
use App\Model\Personnage;

final class PersonnageTable extends Table {

     protected $table = "personnage";

     protected $class = Personnage::class;
     
     public function reset (){
          $this->pdo->query("TRUNCATE $this->table");
          $this->pdo->query("INSERT INTO `personnage` (`id`, `name`, `atk`, `hp`, `type`) VALUES
          (1, 'Son Goku', 100, 1300, 'ally'),
          (2, 'Vegeta', 200, 800, 'traitor'),
          (3, 'Son Gohan', 50, 600, 'ally'),
          (4, 'Freezer', 300, 2000, 'enemy'),
          (5, 'Piccolo', 50, 800, 'ally'),
          (6, 'Cell', 200, 2000, 'enemy');");
     }

}