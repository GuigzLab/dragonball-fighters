<?php

namespace App\Table;

use App\Model\Personnage;
use \PDO;

abstract class Table {

     protected $pdo;

     protected $table = null;
     
     protected $class = null;

     function __construct(PDO $pdo)
     {
          if ($this->table === null) {
               throw new \Exception("La classe ".get_class($this)." n'a pas de propriété \$table");
          }
          if ($this->class === null) {
               throw new \Exception("La classe ".get_class($this)." n'a pas de propriété \$class");
          }
          $this->pdo = $pdo;
     }

     public function all (): ?array
     {
          // return $this->pdo
          // ->query("SELECT * from $this->table")
          // ->fetchAll(PDO::FETCH_CLASS, $this->class);
          $query = $this->pdo
          ->query("SELECT * from $this->table")
          ->fetchAll(PDO::FETCH_ASSOC);

          $results = [];
          foreach ($query as $value)

               $results[] = new $this->class($value);

          return $results;
     }

     public function getOneById (int $id)     
     {
          return new $this->class($this->pdo
          ->query("SELECT * from $this->table WHERE id = $id")
          ->fetch());
     }

     public function create (array $data)
     {
          $sqlFields = [];
          foreach ($data as $key => $value){
               $sqlFields[] = "$key = :$key";
          }
          $query = $this->pdo->prepare("INSERT INTO {$this->table} SET ". implode(', ', $sqlFields));
          $ok = $query->execute($data);
          if (!$ok) {
               throw new \Exception("Impossible de créer l'enregistrement dans la table {$this->table}");
          }
          return (int)$this->pdo->lastInsertId();
     }

     public function update (array $data, int $id)
     {
          $sqlFields = [];
          foreach ($data as $key => $value){
               $sqlFields[] = "$key = :$key";
          }
          $query = $this->pdo->prepare("UPDATE {$this->table} SET ". implode(', ', $sqlFields) . " WHERE id = :id");
          $ok = $query->execute(array_merge($data, ['id' => $id]));
          if ($ok === false) {
               throw new \Exception("Impossible de modifier l'enregistrement dans la table {$this->table}");
          }
     }

     public function delete (int $id)
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $ok = $query->execute([$id]);
        if ($ok === false) {
            throw new \Exception("Impossible de supprimer l'enregistrement $id dans la table {$this->table}");
        }
        $this->pdo->query("ALTER TABLE {$this->table} AUTO_INCREMENT = 1");
    }

}