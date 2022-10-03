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

class UpdateRepository extends ModelRepository
{
    public function updateTableSetColumnByIdCatalogo(string $table, string $column, string $idCatalogo, string $input){
        
        $sqlInstruction = "UPDATE ". $table ." SET ". $column ." = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':input', (string)$input, PDO::PARAM_STR);
        $sth->bindParam(':id_catalogo', $idCatalogo, PDO::PARAM_STR);
        $sth->execute();        
              
    } 

    public function executeUpdate(string $table, array $columns, string $id): bool{
        try{
            $this->pdo->beginTransaction();
            foreach($columns as $key => $value){
                $this->updateTableSetColumnByIdCatalogo($table, $key, $id, $value);
            }
            $this->pdo->commit();
            return true;

        } catch (PDOException $e){
            $this->pdo->rollBack();
            return false;
        }
    }
}