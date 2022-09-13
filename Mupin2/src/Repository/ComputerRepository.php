<?php

declare(strict_types=1);

namespace Mupin\Repository;

require 'vendor/autoload.php';

use PDO;
use Mupin\Models\Computer;

class ComputerRepository
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
    public function selectFromComputer(string $input): array
    {
        $input = '%' . $input . '%';
        $sqlInstruction = "SELECT * FROM computer WHERE MODELLO LIKE :input0 ";
        $sqlInstruction .= "OR ANNO LIKE :input1 ";
        $sqlInstruction .= "OR CPU LIKE :input2 ";
        $sqlInstruction .= "OR VELOCITA_CPU LIKE :input3 ";
        $sqlInstruction .= "OR MEMORIA_RAM LIKE :input4 ";
        $sqlInstruction .= "OR DIMENSIONE_HARD_DISK LIKE :input5 ";
        $sqlInstruction .= "OR SISTEMA_OPERATIVO LIKE :input6 ";
        $sqlInstruction .= "OR NOTE LIKE :input7 ";
        $sqlInstruction .= "OR URL LIKE :input8 ";
        $sqlInstruction .= "OR TAG LIKE :input9 ;";

        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':input0', $input, PDO::PARAM_STR);
        $sth->bindValue(':input1', $input, PDO::PARAM_STR);
        $sth->bindValue(':input2', $input, PDO::PARAM_STR);
        $sth->bindValue(':input3', $input, PDO::PARAM_STR);
        $sth->bindValue(':input4', $input, PDO::PARAM_STR);
        $sth->bindValue(':input5', $input, PDO::PARAM_STR);
        $sth->bindValue(':input6', $input, PDO::PARAM_STR);
        $sth->bindValue(':input7', $input, PDO::PARAM_STR);
        $sth->bindValue(':input8', $input, PDO::PARAM_STR);
        $sth->bindValue(':input9', $input, PDO::PARAM_STR);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectByModello(string $input)
    {
        $input = '%' . $input . '%';
        $sqlInstruction = "SELECT * FROM computer WHERE MODELLO LIKE :input ;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':input', $input, PDO::PARAM_STR);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectByAnno(int $input)
    {
        $sqlInstruction = "SELECT * FROM computer WHERE ANNO = :input ;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':input', $input, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectBySistemaOperativo(string $input)
    {
        $input = '%' . $input . '%';
        $sqlInstruction = "SELECT * FROM computer WHERE SISTEMA_OPERATIVO LIKE :input ;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':input', $input, PDO::PARAM_STR);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectByNote(string $input)
    {
        $input = '%' . $input . '%';
        $sqlInstruction = "SELECT * FROM computer WHERE NOTE LIKE :input ;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':input', $input, PDO::PARAM_STR);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectByTag(string $input)
    {
        $input = '%' . $input . '%';
        $sqlInstruction = "SELECT * FROM computer WHERE TAG LIKE :input ;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':input', $input, PDO::PARAM_STR);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    // INSERT
    public function insertIntoComputer(Computer $computer)
    {
        $sqlInstruction = "INSERT INTO computer (ID_CATALOGO,MODELLO, ANNO,CPU,VELOCITA_CPU,MEMORIA_RAM";
        $sqlInstruction .= ") VALUES ( :id_catalogo , :modello , :anno, :cpu , :velocita_cpu , :memoria_ram ); ";        

        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':id_catalogo', $computer->getIdCatalogo(), PDO::PARAM_STR);
        $sth->bindValue(':modello', $computer->getModello(), PDO::PARAM_STR);
        $sth->bindValue(':anno', $computer->getAnno(), PDO::PARAM_INT);
        $sth->bindValue(':cpu', $computer->getCpu(), PDO::PARAM_STR);
        $sth->bindValue(':velocita_cpu', $computer->getVelocitaCpu());
        $sth->bindValue(':memoria_ram', $computer->getMemoriaRAM(), PDO::PARAM_INT);
        $sth->execute();

        if (isset($computer->dimensione_hard_disk)) {
            $sqlInstruction = "UPDATE computer SET DIMENSIONE_HARD_DISK = :dim_hard_disk WHERE ID_CATALOGO = :id_catalogo ;";
            $sth = $this->pdo->prepare($sqlInstruction);
            $sth->bindValue(':dim_hard_disk', $computer->getDimensioneHardDisk(), PDO::PARAM_STR);
            $sth->bindValue(':id_catalogo', $computer->getIdCatalogo(), PDO::PARAM_STR);
            $sth->execute();
        }
        if (isset($computer->sistema_operativo)) {
            $sqlInstruction = "UPDATE computer SET SISTEMA_OPERATIVO = :sistema_operativo WHERE ID_CATALOGO = :id_catalogo ;";
            $sth = $this->pdo->prepare($sqlInstruction);
            $sth->bindValue(':sistema_operativo', $computer->getSistemaOperativo(), PDO::PARAM_STR);
            $sth->bindValue(':id_catalogo', $computer->getIdCatalogo(), PDO::PARAM_STR);
            $sth->execute();
        }
        if (isset($computer->note)) {
            $sqlInstruction = "UPDATE computer SET NOTE = :note WHERE ID_CATALOGO = :id_catalogo ;";
            $sth = $this->pdo->prepare($sqlInstruction);
            $sth->bindValue(':note', $computer->getNote(), PDO::PARAM_STR);
            $sth->bindValue(':id_catalogo', $computer->getIdCatalogo(), PDO::PARAM_STR);
            $sth->execute();
        }
        if (isset($computer->url)) {
            $sqlInstruction = "UPDATE computer SET URL = :url WHERE ID_CATALOGO = :id_catalogo ;";
            $sth = $this->pdo->prepare($sqlInstruction);
            $sth->bindValue(':url', $computer->getUrl(), PDO::PARAM_STR);
            $sth->bindValue(':id_catalogo', $computer->getIdCatalogo(), PDO::PARAM_STR);
            $sth->execute();
        }
        if (isset($computer->tag)) {
            $sqlInstruction = "UPDATE computer SET TAG = :tag WHERE ID_CATALOGO = :id_catalogo ;";
            $sth = $this->pdo->prepare($sqlInstruction);
            $sth->bindValue(':tag', $computer->getTag(), PDO::PARAM_STR);
            $sth->bindValue(':id_catalogo', $computer->getIdCatalogo(), PDO::PARAM_STR);
            $sth->execute();
        }
    }
}
