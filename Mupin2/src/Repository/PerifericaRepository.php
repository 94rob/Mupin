<?php
declare (strict_types=1);
namespace Mupin\Repository;
require 'vendor/autoload.php';

use PDO;
use Mupin\Models\Periferica;
class PerifericaRepository{
    public PDO $pdo;
    public RepositoryUtils $repositoryUtils;
    public function __construct(){
        $config = include 'config.php';
        $this -> pdo = new PDO($config['dsn'], $config['username'], $config['password']);
        $this->pdo->setAttribute (PDO::ATTR_STRINGIFY_FETCHES, false);
        $this->pdo->setAttribute (PDO::ATTR_EMULATE_PREPARES, false);
        $this->repositoryUtils = new RepositoryUtils();
    }

    // SELECT   
    public function selectAll(): array{
        $sqlInstruction = "SELECT * FROM periferica;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectByModello(string $input){
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM periferica WHERE MODELLO LIKE :input ;";
        return $this->repositoryUtils->executeSelectString($input, $sqlInstruction, $this->pdo);
    }
    public function selectByNote(string $input){
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM periferica WHERE NOTE LIKE :input ;";
        return $this->repositoryUtils->executeSelectString($input, $sqlInstruction, $this->pdo);
    }
    public function selectByTag(string $input){
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM periferica WHERE TAG LIKE :input ;";
        return $this->repositoryUtils->executeSelectString($input, $sqlInstruction, $this->pdo);
    }

    // INSERT
    public function insertIntoPeriferica(Periferica $periferica)
    {
        $sqlInstruction = "INSERT INTO periferica (ID_CATALOGO,MODELLO, TIPOLOGIA";
        $sqlInstruction .= ") VALUES ( :id_catalogo , :modello , :tipologia ); ";        

        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':id_catalogo', $periferica->getId_catalogo(), PDO::PARAM_STR);
        $sth->bindValue(':modello', $periferica->getModello(), PDO::PARAM_STR);
        $sth->bindValue(':tipologia', $periferica->getTipologia(), PDO::PARAM_STR);        
        $sth->execute();
        
        if (isset($periferica->note)) {
            $this->updateNote($periferica->getId_catalogo(), $periferica->getNote());
        }
        if (isset($periferica->url)) {
            $this->updateUrl($periferica->getId_catalogo(), $periferica->getUrl());
        }
        if (isset($periferica->tag)) {
            $this->updateTag($periferica->getId_catalogo(), $periferica->getTag());
        }
    }

    // UPDATE
    public function updateModello(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE periferica SET MODELLO = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->repositoryUtils->executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateTipologia(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE periferica SET TIPOLOGIA = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->repositoryUtils->executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateNote(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE periferica SET NOTE = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->repositoryUtils->executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateUrl(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE periferica SET URL = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->repositoryUtils->executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateTag(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE periferica SET TAG = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->repositoryUtils->executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }

    // DELETE
    public function deleteFromPeriferica(string $idCatalogo){
        $sqlInstruction = "DELETE FROM periferica WHERE ID_CATALOGO = :id_catalogo ;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':id_catalogo', $idCatalogo, PDO::PARAM_STR);
        $sth->execute();
    } 

}