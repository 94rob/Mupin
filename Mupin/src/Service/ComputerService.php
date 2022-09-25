<?php

declare(strict_types=1);

namespace App\Service;

require 'vendor/autoload.php';

use App\Repository\ComputerRepository;
use App\Models\Computer;

class ComputerService // implements IComputerService
{

    public ComputerRepository $computerRepository;  

    public function __construct()
    {
        $this->computerRepository = new ComputerRepository();        
    }

    // SELECT    
    public function selectAll(): array
    {
        $result = $this->computerRepository->selectAll("computer");
        return $this->fromArrayToComputerArray($result);
    }
    public function selectFromComputerWhereWhateverLikeInput(string $input): array{
        $result = $this->computerRepository->selectFromComputerWhereWhateverLikeInput($input);
        return $this->fromArrayToComputerArray($result);
    }

    public function selectWhereColumnLikeInput(string $column, string $input){
        $result = $this->computerRepository->selectWhereColumnLikeInput($column, $input);
        return $this->fromArrayToComputerArray($result);
    }    

    // INSERT
    public function insertIntoComputer(array $array): void{
        $element = $this->fromArrayToComputer($array);
        $this->computerRepository->insertIntoComputer($element);
    }

    // UPDATE
    public function updateColumnByIdCatalogo(string $column, string $idCatalogo, string $input){
        $this->computerRepository->updateColumnByIdCatalogo($column, $idCatalogo, $input);
    }
    
    // DELETE
    public function deleteFromComputer(string $idCatalogo){
        $this->computerRepository->deleteFromComputer($idCatalogo);
    }

    // Utils
    public function fromArrayToComputer(array $array): Computer
    {
        $pc = new Computer();
        $pc->setIdCatalogo($array["ID_CATALOGO"]);
        $pc->setModello($array["MODELLO"]);
        $pc->setAnno($array["ANNO"]);
        $pc->setCpu($array["CPU"]);
        $pc->setVelocitaCpu($array["VELOCITA_CPU"]);
        $pc->setMemoriaRAM($array["MEMORIA_RAM"]);

        if (array_key_exists("DIMENSIONE_HARD_DISK", $array) && $array["DIMENSIONE_HARD_DISK"] != null) {
            $pc->setDimensioneHardDisk($array["DIMENSIONE_HARD_DISK"]);
        }
        if (array_key_exists("SISTEMA_OPERATIVO", $array) && $array["SISTEMA_OPERATIVO"] != null) {
            $pc->setSistemaOperativo($array["SISTEMA_OPERATIVO"]);
        }
        if (array_key_exists("NOTE", $array) && $array["NOTE"] != null) {
            $pc->setNote($array["NOTE"]);
        }
        if (array_key_exists("URL", $array) && $array["URL"] != null) {
            $pc->setUrl($array["URL"]);
        }
        if (array_key_exists("TAG", $array) && $array["TAG"] != null) {
            $pc->setTag($array["TAG"]);
        }
        return $pc;
    }

    public function fromArrayToComputerArray(array $array){
        $objectArray = [];
        foreach ($array as $item) {
            $singleElement = $this->fromArrayToComputer($item);
            array_push($objectArray, $singleElement);
        }
        return $objectArray;
    }
    
}
