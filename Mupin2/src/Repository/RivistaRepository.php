<?php

declare(strict_types=1);

namespace Mupin\Repository;

require 'vendor/autoload.php';

use PDO;
use Mupin\Models\Rivista;

class RivistaRepository
{
    public PDO $pdo;
    public RepositoryUtils $repositoryUtils;
    public function __construct()
    {
        $config = include 'config.php';
        $this->pdo = new PDO($config['dsn'], $config['username'], $config['password']);
        $this->pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->repositoryUtils = new RepositoryUtils();
    }

    // SELECT
    public function selectAll(): array{
        $sqlInstruction = "SELECT * FROM rivista;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectByTitolo(string $input)
    {
        $input = '%' . $input . '%';
        $sqlInstruction = "SELECT * FROM rivista WHERE TITOLO LIKE :input ;";
        return $this->repositoryUtils->executeSelectString($input, $sqlInstruction, $this->pdo);
    }
    public function selectByAnno(int $input)
    {
        $sqlInstruction = "SELECT * FROM rivista WHERE ANNO = :input ;";
        return $this->repositoryUtils->executeSelectInt($input, $sqlInstruction, $this->pdo);
    }
    public function selectByCasaEditrice(string $input)
    {
        $input = '%' . $input . '%';
        $sqlInstruction = "SELECT * FROM rivista WHERE CASA_EDITRICE LIKE :input ;";
        return $this->repositoryUtils->executeSelectString($input, $sqlInstruction, $this->pdo);
    }
    public function selectByNote(string $input)
    {
        $input = '%' . $input . '%';
        $sqlInstruction = "SELECT * FROM rivista WHERE NOTE LIKE :input ;";
        return $this->repositoryUtils->executeSelectString($input, $sqlInstruction, $this->pdo);
    }
    public function selectByTag(string $input)
    {
        $input = '%' . $input . '%';
        $sqlInstruction = "SELECT * FROM rivista WHERE TAG LIKE :input ;";
        return $this->repositoryUtils->executeSelectString($input, $sqlInstruction, $this->pdo);
    }

    // INSERT
    public function insertIntoRivista(Rivista $rivista)
    {
        $sqlInstruction = "INSERT INTO rivista (ID_CATALOGO, TITOLO, NUMERO_RIVISTA, ANNO, CASA_EDITRICE";
        $sqlInstruction .= ") VALUES ( :id_catalogo , :titolo , :numero_rivista, :anno, :casa_editrice );";

        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':id_catalogo', $rivista->getId_catalogo(), PDO::PARAM_STR);
        $sth->bindValue(':titolo', $rivista->getTitolo(), PDO::PARAM_STR);
        $sth->bindValue(':numero_rivista', $rivista->getNum_rivista(), PDO::PARAM_INT);
        $sth->bindValue(':anno', $rivista->getAnno(), PDO::PARAM_INT);
        $sth->bindValue(':casa_editrice', $rivista->getCasa_editrice(), PDO::PARAM_STR);
        $sth->execute();

        if (isset($rivista->note)) {
            $this->updateNote($rivista->getId_catalogo(), $rivista->getNote());
        }
        if (isset($rivista->url)) {
            $this->updateUrl($rivista->getId_catalogo(), $rivista->getUrl());
        }
        if (isset($rivista->tag)) {
            $this->updateTag($rivista->getId_catalogo(), $rivista->getTag());
        }
    }

    // UPDATE
    public function updateTitolo(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE rivista SET TITOLO = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->repositoryUtils->executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateNumRivista(string $idCatalogo, int $input)
    {
        $sqlInstruction = "UPDATE rivista SET NUMERO_RIVISTA = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->repositoryUtils->executeUpdateInt($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateAnno(string $idCatalogo, int $input)
    {
        $sqlInstruction = "UPDATE rivista SET ANNO = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->repositoryUtils->executeUpdateInt($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateCasaEditrice(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE rivista SET CASA_EDITRICE = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->repositoryUtils->executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateNote(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE rivista SET NOTE = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->repositoryUtils->executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateUrl(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE rivista SET URL = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->repositoryUtils->executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateTag(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE rivista SET TAG = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->repositoryUtils->executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }

    // DELETE
    public function deleteFromRivista(string $idCatalogo){
        $sqlInstruction = "DELETE FROM rivista WHERE ID_CATALOGO = :id_catalogo ;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':id_catalogo', $idCatalogo, PDO::PARAM_STR);
        $sth->execute();
    }    
}
