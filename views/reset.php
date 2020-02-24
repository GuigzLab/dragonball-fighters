<?php

use App\Connection;
use App\Table\PersonnageTable;

$pdo = Connection::getPDO();
$table = new PersonnageTable($pdo);
$table->reset();

http_response_code(200);
header('Location:'.url('all'));
exit();

?>