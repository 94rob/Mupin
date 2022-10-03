<?php
declare(strict_types=1);
namespace App\Repository;
require 'vendor/autoload.php';

use App\Utils\Utils;
use PDO;
use PDOException;
use PDOStatement;
use ReflectionClass;
use ReflectionProperty;

class DeleteRepository extends ModelRepository{
    
    public function deleteFromTableById(string $table, string $id): bool{
        try{
            $sqlInstruction = "DELETE FROM ". $table ." WHERE ID_CATALOGO = :id_catalogo ;";
            $sth = $this->pdo->prepare($sqlInstruction);
            $sth->bindParam(':id_catalogo', $id, PDO::PARAM_STR);
            $sth->execute();
            return true;
        } catch (PDOException $e){
            return false;
        }
    }
}