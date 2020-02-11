<?php

use App\Connection;
use App\Model\Personnage;
use App\Table\PersonnageTable;

$personnage = new Personnage([]);
// dump($personnage);

$button = "Créer";



if (isset($_POST['name'], $_POST['atk'], $_POST['hp'], $_POST['type'])){
     $pdo = Connection::getPDO();
     $table = new PersonnageTable($pdo);
     $data = [
          'name' => $_POST['name'], 
          'atk' => (int)$_POST['atk'], 
          'hp' => (int)$_POST['hp'],
          'type' => $_POST['type']
     ];
     $table->create($data);
     http_response_code(200);
     header('Location:'.url('all'));
     exit();
}

?>

<h1>Créer un personnage</h1>

<?php include '_form.php' ?>

