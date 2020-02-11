<h1 class="mb-4">Battleground</h1>

<?php

use App\Connection;
use App\Model\Personnage;
use App\Table\PersonnageTable;

$pdo = Connection::getPDO();
$table = new PersonnageTable($pdo);
$personnages = $table->all();

$sg = $personnages[0];
$vg = $personnages[1];
$sg->attaque($vg);

dump($personnages, $sg, $vg);

echo Personnage::getCount();

?>

<div class="row">
     <?php foreach($personnages as $p): ?>
          <?php 
               $type = $p->getType();
               $bg = ($type === 'ally') ? 'bg-success' : ( ($type === 'enemy') ? 'bg-danger' : 'bg-warning' );     
          ?>
          <div class="card mx-3 <?= $bg ?>">
               <div class="card-header">
                    <?= $p->getName() ?>
               </div>
               <ul class="list-group list-group-flush">
                    <li class="list-group-item">Attaque: <?= $p->getAtk() ?></li>
                    <li class="list-group-item">Points de vie: <?= $p->getHp() ?></li>
               </ul>
          </div>
     <?php endforeach ?>
</div>