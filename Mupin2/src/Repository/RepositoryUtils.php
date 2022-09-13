<?php
declare(strict_types=1);
namespace Mupin\Repository;
require 'vendor/autoload.php';

use PDO;

class RepositoryUtils{
    public function executeUpdateString(string $newValue, string $idCatalogo, string $sqlUpdate, PDO $pdo){
        $sth = $pdo->prepare($sqlUpdate);
        $sth->bindValue(':input', $newValue, PDO::PARAM_STR);
        $sth->bindValue(':id_catalogo', $idCatalogo, PDO::PARAM_STR);
        $sth->execute();
    }
    public function executeUpdateInt(int $newValue, string $idCatalogo, string $sqlUpdate, PDO $pdo){
        $sth = $pdo->prepare($sqlUpdate);
        $sth->bindValue(':input', $newValue, PDO::PARAM_INT);
        $sth->bindValue(':id_catalogo', $idCatalogo, PDO::PARAM_STR);
        $sth->execute();
    }
    public function executeSelectString(string $input, string $sqlInstruction, PDO $pdo){
        $sth = $pdo->prepare($sqlInstruction);
        $sth->bindValue(':input', $input, PDO::PARAM_STR);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function executeSelectInt(int $input, string $sqlInstruction, PDO $pdo){
        $sth = $pdo->prepare($sqlInstruction);
        $sth->bindValue(':input', $input, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}