<?php

declare(strict_types=1);

namespace Mupin\Repository;

require 'vendor/autoload.php';

use PDO;
use Mupin\Models\Rivista;

class RivistaRepository
{
    public PDO $pdo;
    public function __construct()
    {
        $config = include 'config.php';
        $this->pdo = new PDO($config['dsn'], $config['username'], $config['password']);
        $this->pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    // SELECT
    public function selectFromRivista(string $input): array
    {
        $input = '%' . $input . '%';
        $sqlInstruction = "SELECT * FROM rivista WHERE TITOLO LIKE :input0 ";
        $sqlInstruction .= "OR NUMERO_RIVISTA LIKE :input1 ";
        $sqlInstruction .= "OR ANNO LIKE :input2 ";
        $sqlInstruction .= "OR CASA_EDITRICE LIKE :input3 ";
        $sqlInstruction .= "OR NOTE LIKE :input4 ";
        $sqlInstruction .= "OR URL LIKE :input5 ";
        $sqlInstruction .= "OR TAG LIKE :input6 ;";

        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':input0', $input, PDO::PARAM_STR);
        $sth->bindValue(':input1', $input, PDO::PARAM_STR);
        $sth->bindValue(':input2', $input, PDO::PARAM_STR);
        $sth->bindValue(':input3', $input, PDO::PARAM_STR);
        $sth->bindValue(':input4', $input, PDO::PARAM_STR);
        $sth->bindValue(':input5', $input, PDO::PARAM_STR);
        $sth->bindValue(':input6', $input, PDO::PARAM_STR);

        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectByTitolo(string $input)
    {
        $input = '%' . $input . '%';
        $sqlInstruction = "SELECT * FROM rivista WHERE TITOLO LIKE :input ;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':input', $input, PDO::PARAM_STR);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectByAnno(int $input)
    {
        $sqlInstruction = "SELECT * FROM rivista WHERE ANNO = :input ;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':input', $input, PDO::PARAM_STR);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectByCasaEditrice(string $input)
    {
        $input = '%' . $input . '%';
        $sqlInstruction = "SELECT * FROM rivista WHERE CASA_EDITRICE LIKE :input ;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':input', $input, PDO::PARAM_STR);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectByNote(string $input)
    {
        $input = '%' . $input . '%';
        $sqlInstruction = "SELECT * FROM rivista WHERE NOTE LIKE :input ;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':input', $input, PDO::PARAM_STR);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectByTag(string $input)
    {
        $input = '%' . $input . '%';
        $sqlInstruction = "SELECT * FROM rivista WHERE TAG LIKE :input ;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':input', $input, PDO::PARAM_STR);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
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
            $sqlInstruction = "UPDATE rivista SET NOTE = :note WHERE ID_CATALOGO = :id_catalogo ;";
            $sth = $this->pdo->prepare($sqlInstruction);
            $sth->bindValue(':note', $rivista->getNote(), PDO::PARAM_STR);
            $sth->bindValue(':id_catalogo', $rivista->getId_catalogo(), PDO::PARAM_STR);
            $sth->execute();
        }
        if (isset($rivista->url)) {
            $sqlInstruction = "UPDATE rivista SET URL = :url WHERE ID_CATALOGO = :id_catalogo ;";
            $sth = $this->pdo->prepare($sqlInstruction);
            $sth->bindValue(':url', $rivista->getUrl(), PDO::PARAM_STR);
            $sth->bindValue(':id_catalogo', $rivista->getId_catalogo(), PDO::PARAM_STR);
            $sth->execute();
        }
        if (isset($rivista->tag)) {
            $sqlInstruction = "UPDATE rivista SET TAG = :tag WHERE ID_CATALOGO = :id_catalogo ;";
            $sth = $this->pdo->prepare($sqlInstruction);
            $sth->bindValue(':tag', $rivista->getTag(), PDO::PARAM_STR);
            $sth->bindValue(':id_catalogo', $rivista->getId_catalogo(), PDO::PARAM_STR);
            $sth->execute();
        }
    }

    // UPDATE
    public function updateTitolo(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE rivista SET TITOLO = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->executeUpdateString($input, $idCatalogo, $sqlInstruction);
    }
    public function updateNumRivista(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE rivista SET NUMERO_RIVISTA = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->executeUpdateInt($input, $idCatalogo, $sqlInstruction);
    }
    public function updateAnno(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE rivista SET ANNO = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->executeUpdateInt($input, $idCatalogo, $sqlInstruction);
    }
    public function updateCasaEditrice(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE rivista SET CASA_EDITRICE = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->executeUpdateString($input, $idCatalogo, $sqlInstruction);
    }
    public function updateNote(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE rivista SET NOTE = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->executeUpdateString($input, $idCatalogo, $sqlInstruction);
    }
    public function updateUrl(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE rivista SET URL = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->executeUpdateString($input, $idCatalogo, $sqlInstruction);
    }
    public function updateTag(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE rivista SET TAG = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->executeUpdateString($input, $idCatalogo, $sqlInstruction);
    }

    // Utils
    public function executeUpdateString($newValue, string $idCatalogo, string $sqlUpdate)
    {
        $sth = $this->pdo->prepare($sqlUpdate);
        $sth->bindValue(':input', $newValue, PDO::PARAM_STR);
        $sth->bindValue(':id_catalogo', $idCatalogo, PDO::PARAM_STR);
        $sth->execute();
    }
    public function executeUpdateInt($newValue, string $idCatalogo, string $sqlUpdate)
    {
        $sth = $this->pdo->prepare($sqlUpdate);
        $sth->bindValue(':input', $newValue, PDO::PARAM_INT);
        $sth->bindValue(':id_catalogo', $idCatalogo, PDO::PARAM_STR);
        $sth->execute();
    }
}
