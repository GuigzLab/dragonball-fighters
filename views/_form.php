<form action="" method="POST">
     <div class="form-group">
          <label for="name">Nom du personnage</label>
          <input type="text" class="form-control" id="name" value="<?= $personnage->getName() ?>" name="name" required>
     </div>
     <div class="form-group">
          <label for="atk">Valeur d'attaque</label>
          <input type="number" class="form-control" id="atk" step="10" min="10" max="500"
               value="<?= $personnage->getAtk() ?>" name="atk" required>
     </div>
     <div class="form-group">
          <label for="hp">Nombre de points de vie</label>
          <input type="number" class="form-control" id="hp" step="100" min="100" max="5000"
               value="<?= $personnage->getHp() ?>" name="hp" required>
     </div>
     <?php 
          $radioValues = [
               ['name' => 'ally', 'label' => 'Allié'],
               ['name' => 'traitor', 'label' => 'Traître'],
               ['name' => 'enemy', 'label' => 'Ennemi']
          ];
     ?>
     <div class="form-group">
          <?php foreach($radioValues as $value): ?>
          <div class="form-check form-check-inline">
               <input class="form-check-input" type="radio" name="type" id="<?= $value['name'] ?>" value="<?= $value['name'] ?>" <?= ($personnage->getType() === $value['name'])? 'checked': '' ?> required>
               <label class="form-check-label" for="<?= $value['name'] ?>"><?= $value['label'] ?></label>
          </div>
          <?php endforeach ?>
     </div>
     <button type="submit" class="btn btn-primary"><?= $button ?></button>
</form>