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

?>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js'></script>


<p>Sélectionnez un personnage en attaque et un en défense!</p>

<div class="row list">
     <?php foreach($personnages as $p): ?>
          <?php 
               $type = $p->getType();
               $bg = ($type === 'ally') ? 'bg-success' : ( ($type === 'enemy') ? 'bg-danger' : 'bg-warning' );     
               $alive = ($p->isAlive() === true) ? 'alive' : 'notAlive' ;
          ?>
          <div class="card m-3 <?= $bg.' '. $alive ?>" id="<?= $p->getId() ?>" data-type="<?= $type ?>">
               <div class="card-header">
                    <?= $p->getName() ?>
               </div>
               <ul class="list-group list-group-flush">
                    <li class="list-group-item">Attaque: <?= $p->getAtk() ?></li>
                    <li class="list-group-item">Points de vie: <?= $p->getHp() ?></li>
                    <li class="list-group-item">Type: <?= ($type === 'ally') ? 'Allié' : ( ($type === 'enemy') ? 'Ennemi' : 'Traître' ) ?></li>
               </ul>
          </div>
     <?php endforeach ?>
</div>

<div class="row my-5">
     <div class="col-6">
          <h2 class="selected text-center py-2 attack areas">Attaque:</h2>
     </div>
     <div class="col-6">
          <h2 class="text-center py-2 defense areas">Défense:</h2>
     </div>
</div>

<div class="row my-3">
     <div class="col-6">
          <div class="attack-area"></div>
     </div>
     <div class="col-6">
          <div class="defense-area"></div>
     </div>
</div>

<button class="btn btn-primary mt-3" id="attack">Attaquer</button>


<script>
     $(document).ready(()=>{
          $('.card.alive').click(function () {
               selected = selection()
               $(selected + "-area").children().appendTo('.list')
               $(this).appendTo(selected + "-area")
          })

          function selection() {
               if ($('.selected').hasClass('attack')){
                    $('.selected').removeClass('selected')
                    $('.defense').addClass('selected')
                    return '.attack'
               } else {
                    $('.selected').removeClass('selected')
                    $('.attack').addClass('selected')
                    return '.defense'
               }
          }

          $('.areas').click(function () {
               $('.selected').removeClass('selected')
               $(this).addClass('selected')
          })

          $('#attack').click(function (e) {
               e.preventDefault()
               let atkType = $('.attack-area').children().attr('data-type')
               let defType = $('.defense-area').children().attr('data-type')
               let atkId = $('.attack-area').children().attr('id')
               let defId = $('.defense-area').children().attr('id')
               canAtk = false
               if (typeof atkType != 'undefined' && typeof defType != 'undefined') {
                    if (atkType === 'ally') {
                         if (defType === 'enemy'){
                              canAtk = true
                         } else {
                              canAtk = false 
                              alert('Les alliés ne peuvent attaquer que les ennemis !')
                         }
                         
                    } else {
                         canAtk = true
                    }
               }

               if (canAtk) {
                    jQuery.ajax({
                         url: `/attack/${atkId}/${defId}`,
                         type: 'POST'
                    })
                    location.reload(true)
               }


          })
     })
</script>