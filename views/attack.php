<?php

use App\Connection;
use App\Table\PersonnageTable;

$pdo = Connection::getPDO();

$table = new PersonnageTable($pdo);

$attacker = $table->getOneById($attackerId);
$defender = $table->getOneById($defenderId);

$attacker->attack($defender); 

$data = [
     'hp' => $defender->getHp()
];

$table->update($data, $defenderId);

?>