<?php

declare(strict_types=1);

namespace Mupin\Service;

require 'vendor/autoload.php';

use Mupin\Repository\ComputerRepository;
use Mupin\Models\Computer;

class ComputerService implements IComputerService
{

    public ComputerRepository $computerRepository;  

    public function __construct()
    {
        $this->computerRepository = new ComputerRepository();        
    }

    // SELECT
    public function selectByAll(string $input): array
    {
        $result = $this->computerRepository->selectFromComputer($input);
        return $this->fromArrayToComputerArray($result);
    }
    public function selectByModello(string $input): array
    {
        $result = $this->computerRepository->selectByModello($input);
        return $this->fromArrayToComputerArray($result);
    }
    public function selectByAnno(int $input): array
    {
        $result = $this->computerRepository->selectByAnno($input);
        return $this->fromArrayToComputerArray($result);
    }
    public function selectBySistemaOperativo(string $input): array
    {
        $result = $this->computerRepository->selectBySistemaOperativo($input);
        return $this->fromArrayToComputerArray($result);
    }
    public function selectByNote(string $input): array
    {
        $result = $this->computerRepository->selectByNote($input);
        return $this->fromArrayToComputerArray($result);
    }
    public function selectByTag(string $input): array
    {
        $result = $this->computerRepository->selectByTag($input);
        return $this->fromArrayToComputerArray($result);
    }

    // INSERT
    public function insertIntoComputer(array $array): void{
        $element = $this->fromArrayToComputer($array);
        $this->computerRepository->insertIntoComputer($element);
    }

    // UPDATE
    public function updateModello(string $idCatalogo, string $input)
    {
        $this->updateModello($idCatalogo, $input);
    }
    public function updateAnno(string $idCatalogo, int $input)
    {
        $this->updateAnno($idCatalogo, $input);
    }
    public function updateCpu(string $idCatalogo, $input)
    {
        $this->updateCpu($idCatalogo, $input);
    }
    public function updateVelocitaCpu(string $idCatalogo, $input)
    {
        $this->updateVelocitaCpu($idCatalogo, $input);
    }
    public function updateMemoriaRam(string $idCatalogo, $input)
    {
        $this->updateMemoriaRam($idCatalogo, $input);
    }
    public function updateDimensioneHardDisk(string $idCatalogo, $input)
    {
        $this->updateDimensioneHardDisk($idCatalogo, $input);
    }
    public function updateSistemaOperativo(string $idCatalogo, $input)
    {
        $this->updateSistemaOperativo($idCatalogo, $input);
    }
    public function updateNote(string $idCatalogo, $input)
    {
        $this->updateNote($idCatalogo, $input);
    }
    public function updateUrl(string $idCatalogo, $input)
    {
        $this->updateUrl($idCatalogo, $input);
    }
    public function updateTag(string $idCatalogo, $input)
    {
        $this->updateTag($idCatalogo, $input);
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
