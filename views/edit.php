
<?php

use App\Connection;
use App\Table\PersonnageTable;

$pdo = Connection::getPDO();
$table = new PersonnageTable($pdo);
$personnage = $table->getOneById($id);
// dump($personnage);

$button = "Modifier";



if (isset($_POST['name'], $_POST['atk'], $_POST['hp'], $_POST['type'])){
     $data = [
          'name' => $_POST['name'], 
          'atk' => (int)$_POST['atk'], 
          'hp' => (int)$_POST['hp'],
          'type' => $_POST['type']
     ];
     $table->update($data, $id);
     http_response_code(200);
     header('Location:'.url('all'));
     exit();
}



?>


<h1>Modifier <?= $personnage->getName() ?></h1>

<?php include '_form.php' ?>

