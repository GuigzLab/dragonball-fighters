<?php

use App\Connection;
use App\Table\PersonnageTable;


$pdo = Connection::getPDO();
$table = new PersonnageTable($pdo);
$table->delete((int)$id);

$url = url('all').'?delete=true';
header('Location:'.$url);
exit();

?>