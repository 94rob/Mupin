<?php
declare(strict_types=1);
namespace App\Repository;
require 'vendor/autoload.php';

use PDO;
use App\Models\Computer;

class ComputerRepository extends RepositoryFather
{
    // SELECT
    public function selectAll(): array{
        $sqlInstruction = "SELECT * FROM computer;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectFromComputerWhere(string $input): array
    {
        $input = '%' . $input . '%';
        $arrProperties = ["MODELLO", "ANNO", "CPU", "VELOCITA_CPU", "MEMORIA_RAM", "DIMENSIONE_HARD_DISK", "SISTEMA_OPERATIVO", "NOTE", "URL", "TAG"];
        $i = 0;
        $len = count($arrProperties);
        $sqlInstruction = "SELECT * FROM computer WHERE ";
        foreach($arrProperties as $element){
            $sqlInstruction .= $element . " LIKE :input" . $i;
            if ($i < $len - 1){
                $sqlInstruction .= " OR ";
            }
            $i +=1;
        }        

        $sth = $this->pdo->prepare($sqlInstruction);
        
        for($i=0; $i<$len;$i++){
            $sth->bindValue(':input' . $i, $input, PDO::PARAM_STR);
        }        
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectByModello(string $input)
    {
        $input = '%' . $input . '%';
        $sqlInstruction = "SELECT * FROM computer WHERE MODELLO LIKE :input ;";
        return parent::executeSelectString($input, $sqlInstruction, $this->pdo);
    }
    public function selectByAnno(int $input)
    {
        $sqlInstruction = "SELECT * FROM computer WHERE ANNO = :input ;";
        return parent::executeSelectInt($input, $sqlInstruction, $this->pdo);
    }
    public function selectBySistemaOperativo(string $input)
    {
        $input = '%' . $input . '%';
        $sqlInstruction = "SELECT * FROM computer WHERE SISTEMA_OPERATIVO LIKE :input ;";
        return parent::executeSelectString($input, $sqlInstruction, $this->pdo);
    }
    public function selectByNote(string $input)
    {
        $input = '%' . $input . '%';
        $sqlInstruction = "SELECT * FROM computer WHERE NOTE LIKE :input ;";
        return parent::executeSelectString($input, $sqlInstruction, $this->pdo);
    }
    public function selectByTag(string $input)
    {
        $input = '%' . $input . '%';
        $sqlInstruction = "SELECT * FROM computer WHERE TAG LIKE :input ;";
        return parent::executeSelectString($input, $sqlInstruction, $this->pdo);
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
            $this->updateDimensioneHardDisk($computer->getIdCatalogo(), $computer->getDimensioneHardDisk());
        }
        if (isset($computer->sistema_operativo)) {
            $this->updateSistemaOperativo($computer->getIdCatalogo(), $computer->getSistemaOperativo());
        }
        if (isset($computer->note)) {
            $this->updateNote($computer->getIdCatalogo(), $computer->getNote());
        }
        if (isset($computer->url)) {
            $this->updateUrl($computer->getIdCatalogo(), $computer->getUrl());
        }
        if (isset($computer->tag)) {
            $this->updateTag($computer->getIdCatalogo(), $computer->getTag());
        }
    }

    // UPDATE
    public function updateModello(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE computer SET MODELLO = :input WHERE ID_CATALOGO = :id_catalogo ;";
        parent::executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateAnno(string $idCatalogo, int $input)
    {
        $sqlInstruction = "UPDATE computer SET ANNO = :input WHERE ID_CATALOGO = :id_catalogo ;";
        parent::executeUpdateInt($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateCpu(string $idCatalogo, $input)
    {
        $sqlInstruction = "UPDATE computer SET CPU = :input WHERE ID_CATALOGO = :id_catalogo ;";
        parent::executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateVelocitaCpu(string $idCatalogo, $input)
    {
        $sqlInstruction = "UPDATE computer SET VELOCITA_CPU = :input WHERE ID_CATALOGO = :id_catalogo ;";
        parent::executeUpdateInt($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateMemoriaRam(string $idCatalogo, $input)
    {
        $sqlInstruction = "UPDATE computer SET MEMORIA_RAM = :input WHERE ID_CATALOGO = :id_catalogo ;";
        parent::executeUpdateInt($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateDimensioneHardDisk(string $idCatalogo, $input)
    {
        $sqlInstruction = "UPDATE computer SET DIMENSIONE_HARD_DISK = :input WHERE ID_CATALOGO = :id_catalogo ;";
        parent::executeUpdateInt($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateSistemaOperativo(string $idCatalogo, $input)
    {
        $sqlInstruction = "UPDATE computer SET SISTEMA_OPERATIVO = :input WHERE ID_CATALOGO = :id_catalogo ;";
        parent::executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateNote(string $idCatalogo, $input)
    {
        $sqlInstruction = "UPDATE computer SET NOTE = :input WHERE ID_CATALOGO = :id_catalogo ;";
        parent::executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateUrl(string $idCatalogo, $input)
    {
        $sqlInstruction = "UPDATE computer SET URL = :input WHERE ID_CATALOGO = :id_catalogo ;";
        parent::executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateTag(string $idCatalogo, $input)
    {
        $sqlInstruction = "UPDATE computer SET TAG = :input WHERE ID_CATALOGO = :id_catalogo ;";
        parent::executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }

    // DELETE
    public function deleteFromComputer(string $idCatalogo){
        $sqlInstruction = "DELETE FROM computer WHERE ID_CATALOGO = :id_catalogo ;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':id_catalogo', $idCatalogo, PDO::PARAM_STR);
        $sth->execute();
    }    
}
