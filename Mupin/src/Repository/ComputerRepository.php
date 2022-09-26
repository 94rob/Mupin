<?php
declare(strict_types=1);
namespace App\Repository;
require 'vendor/autoload.php';

use PDO;
use App\Models\Computer;

class ComputerRepository extends RepositoryFather
{
    // SELECT    
    public function selectFromComputerWhereWhateverLikeInput(string $input): array
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

    public function selectWhereColumnLikeInput(string $column, string $input){
        $input = '%' . $input . '%';
        $sqlInstruction = "SELECT * FROM computer WHERE ". $column ." LIKE :input ;";
        return parent::executeSelectString($input, $sqlInstruction);
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
            $this->updateColumnByIdCatalogo("DIMESIONE_HARD_DISK", $computer->getIdCatalogo(), (string)$computer->getDimensioneHardDisk());
        }
        if (isset($computer->sistema_operativo)) {
            $this->updateColumnByIdCatalogo("SISTEMA_OPERATIVO", $computer->getIdCatalogo(), $computer->getSistemaOperativo());
        }
        if (isset($computer->note)) {
            $this->updateColumnByIdCatalogo("NOTE", $computer->getIdCatalogo(), $computer->getNote());
        }
        if (isset($computer->url)) {
            $this->updateColumnByIdCatalogo("URL", $computer->getIdCatalogo(), $computer->getUrl());
        }
        if (isset($computer->tag)) {
            $this->updateColumnByIdCatalogo("TAG", $computer->getIdCatalogo(), $computer->getTag());
        }
    }

    // UPDATE
    public function updateColumnByIdCatalogo(string $column, string $idCatalogo, string $input){
        $sqlInstruction = "UPDATE computer SET ". $column ." = :input WHERE ID_CATALOGO = :id_catalogo ;";
        parent::executeUpdateString($input, $idCatalogo, $sqlInstruction);
    }       

    // DELETE
    public function deleteFromComputer(string $idCatalogo){
        $sqlInstruction = "DELETE FROM computer WHERE ID_CATALOGO = :id_catalogo ;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':id_catalogo', $idCatalogo, PDO::PARAM_STR);
        $sth->execute();
    }    
}
