<?php

declare(strict_types=1);

namespace Mupin\Service;

require 'vendor/autoload.php';

use Mupin\Repository\PerifericaRepository;
use Mupin\Models\Periferica;

class PerifericaService
{

    public PerifericaRepository $perifericaRepository;

    public function __construct()
    {
        $this->perifericaRepository = new PerifericaRepository();        
    }

    // SELECT
    public function selectByAll(string $input): array
    {
        $result = $this->perifericaRepository->selectFromPeriferica($input);
        return $this->fromArrayToPerifericaArray($result);
    }
    public function selectByModello(string $input)
    {
        $result = $this->perifericaRepository->selectByModello($input);
        return $this->fromArrayToPerifericaArray($result);
    }
    public function selectByNote(string $input)
    {
        $result = $this->perifericaRepository->selectByNote($input);
        return $this->fromArrayToPerifericaArray($result);
    }
    public function selectByTag(string $input)
    {
        $result = $this->perifericaRepository->selectByTag($input);
        return $this->fromArrayToPerifericaArray($result);
    }

    // INSERT
    public function insertIntoPeriferica(array $array){
        $element = $this->fromArrayToPeriferica($array);
        $this->perifericaRepository->insertIntoPeriferica($element);
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
