<?php

namespace App\Table;
use App\Model\Personnage;

final class PersonnageTable extends Table {

     protected $table = "personnage";

     protected $class = Personnage::class;

}