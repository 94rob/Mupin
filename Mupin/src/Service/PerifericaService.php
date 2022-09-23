<?php

declare(strict_types=1);
namespace App\Service;
require 'vendor/autoload.php';

use App\Repository\PerifericaRepository;
use App\Models\Periferica;

class PerifericaService implements IPerifericaService
{

    public PerifericaRepository $perifericaRepository;

    public function __construct()
    {
        $this->perifericaRepository = new PerifericaRepository();        
    }

    // SELECT
    public function selectAll(): array
    {
        $result = $this->perifericaRepository->selectAll("periferica");
        return $this->fromArrayToPerifericaArray($result);
    }
    public function selectFromPerifericaWhere(string $input): array{
        $result = $this->perifericaRepository->selectFromPerifericaWhere($input);
        return $this->fromArrayToPerifericaArray($result);
    }
    public function selectByModello(string $input): array
    {
        $result = $this->perifericaRepository->selectByModello($input);
        return $this->fromArrayToPerifericaArray($result);
    }
    public function selectByNote(string $input): array
    {
        $result = $this->perifericaRepository->selectByNote($input);
        return $this->fromArrayToPerifericaArray($result);
    }
    public function selectByTag(string $input): array
    {
        $result = $this->perifericaRepository->selectByTag($input);
        return $this->fromArrayToPerifericaArray($result);
    }

    // INSERT
    public function insertIntoPeriferica(array $array){
        $element = $this->fromArrayToPeriferica($array);
        $this->perifericaRepository->insertIntoPeriferica($element);
    }

    // UPDATE
    public function updateModello(string $idCatalogo, string $input)
    {
        $this->perifericaRepository->updateModello($idCatalogo, $input);
    }
    public function updateTipologia(string $idCatalogo, string $input)
    {
        $this->perifericaRepository->updateTipologia($idCatalogo, $input);
    }
    public function updateNote(string $idCatalogo, string $input)
    {
        $this->perifericaRepository->updateNote($idCatalogo, $input);
    }
    public function updateUrl(string $idCatalogo, string $input)
    {
        $this->perifericaRepository->updateUrl($idCatalogo, $input);
    }
    public function updateTag(string $idCatalogo, string $input)
    {
        $this->perifericaRepository->updateTag($idCatalogo, $input);
    }

    // DELETE
    public function deleteFromPeriferica(string $idCatalogo){
        $this->perifericaRepository->deleteFromPeriferica($idCatalogo);
    }

    // Utils
    public function fromArrayToPeriferica(array $array): Periferica
    {
        $periferica = new Periferica();
        $periferica->setId_catalogo($array["ID_CATALOGO"]);
        $periferica->setModello($array["MODELLO"]);
        $periferica->setTipologia($array["TIPOLOGIA"]);

        if (array_key_exists("NOTE", $array) && $array["NOTE"] != null) {
            $periferica->setNote($array["NOTE"]);
        }
        if (array_key_exists("URL", $array) && $array["URL"] != null) {
            $periferica->setUrl($array["URL"]);
        }
        if (array_key_exists("TAG", $array) && $array["TAG"] != null) {
            $periferica->setTag($array["TAG"]);
        }
        return $periferica;
    }

    public function fromArrayToPerifericaArray(array $array)
    {
        $objectArray = [];
        foreach ($array as $item) {
            $singleElement = $this->fromArrayToPeriferica($item);
            array_push($objectArray, $singleElement);
        }
        return $objectArray;
    }
}
