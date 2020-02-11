<?php

use App\Connection;
use App\Table\PersonnageTable;

$pdo = Connection::getPDO();
$table = new PersonnageTable($pdo);
$personnages = $table->all();

?>
<?php if(isset($_GET['delete'])):?>
     <div class="alert alert-danger alert-dismissible fade show" role="alert">
          Le personnage à bien été supprimé
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
          </button>
     </div>
<?php endif ?>

<table class="table mb-5">
     <thead>
          <tr>
               <th scope="col">#</th>
               <th scope="col">Nom</th>
               <th scope="col">Attaque</th>
               <th scope="col">Points de vie</th>
               <th scope="col">Type</th>
               <th scope="col">Action</th>
          </tr>
     </thead>
     <tbody>
          <?php foreach($personnages as $personnage): ?>
          <tr>
               <th scope="row"><?= $personnage->getId() ?></th>
               <td><?= $personnage->getName() ?></td>
               <td><?= $personnage->getAtk() ?></td>
               <td><?= $personnage->getHp() ?></td>
               <td><?= $personnage->getType() ?></td>
               <td>
                    <a href="<?= url('edit', ['id' => $personnage->getId()]) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i>Editer</a>
                    <form action="<?= url('delete', ['id' => $personnage->getId()]) ?>" method="POST" class="d-inline" onsubmit="return confirm('Voulez vous vraiment effectuer cette action ?')">
                         <button class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i> Supprimer</button>
                    </form>
               </td>
          </tr>
          <?php endforeach ?>
     </tbody>
</table>

<a href="<?= url('new') ?>" class="btn btn-primary">Créer un nouveau personnage</a>

<hr class="mt-5">
<small>Ally: Allié <br> Traitor: Traître <br> Enemy: Ennemi</small>