<?php
declare(strict_types=1);
namespace App\Repository;
require 'vendor/autoload.php';

use PDO;

class RepositoryUtils{

    public PDO $pdo;    
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);        
    }

    public function selectAll(string $tableName): array
    {
        $sql_select_user = "SELECT * FROM " . $tableName;
        $statement_select = $this->pdo->prepare($sql_select_user);
        $statement_select->execute();
        return $statement_select->fetchAll(PDO::FETCH_ASSOC);
    }

    public function executeUpdate(string $newValue, string $idCatalogo, string $sqlUpdate){
        $sth = $this->pdo->prepare($sqlUpdate);
        $sth->bindValue(':input', $newValue, PDO::PARAM_STR);        
        $sth->bindValue(':id_catalogo', $idCatalogo, PDO::PARAM_STR);
        $sth->execute();
    }
    
    public function executeSelect(string $input, string $sqlInstruction){
        $sth = $this->pdo->prepare($sqlInstruction);        
        $sth->bindValue(':input', $input, PDO::PARAM_STR);        
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }    
}