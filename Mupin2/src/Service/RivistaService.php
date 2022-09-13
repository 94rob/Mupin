<?php

declare(strict_types=1);

namespace Mupin\Service;

require 'vendor/autoload.php';

use Mupin\Models\Rivista;
use Mupin\Repository\RivistaRepository;

class RivistaService
{
    public RivistaRepository $rivistaRepository;


    public function __construct()
    {
        $this->rivistaRepository = new RivistaRepository();
    }

    // SELECT
    public function selectByAll(string $input): array
    {
        $result = $this->rivistaRepository->selectFromRivista($input);
        return $this->fromArrayToRivistaArray($result);
    }
    public function selectByTitolo(string $input)
    {
        $result = $this->rivistaRepository->selectByTitolo($input);
        return $this->fromArrayToRivistaArray($result);
    }
    public function selectByAnno(int $input)
    {
        $result = $this->rivistaRepository->selectByAnno($input);
        return $this->fromArrayToRivistaArray($result);
    }
    public function selectByCasaEditrice(string $input)
    {
        $result = $this->rivistaRepository->selectByCasaEditrice($input);
        return $this->fromArrayToRivistaArray($result);
    }
    public function selectByNote(string $input)
    {
        $result = $this->rivistaRepository->selectByNote($input);
        return $this->fromArrayToRivistaArray($result);
    }
    public function selectByTag(string $input)
    {
        $result = $this->rivistaRepository->selectByTag($input);
        return $this->fromArrayToRivistaArray($result);
    }

    // Utils
    public function fromArrayToRivista(array $array): Rivista
    {
        $rivista = new Rivista();
        $rivista->setId_catalogo($array["ID_CATALOGO"]);
        $rivista->setTitolo($array["TITOLO"]);
        $rivista->setNum_rivista($array["NUMERO_RIVISTA"]);
        $rivista->setAnno($array["ANNO"]);
        $rivista->setCasa_editrice($array["CASA_EDITRICE"]);

        if (array_key_exists("NOTE", $array) && $array["NOTE"] != null) {
            $rivista->setNote($array["NOTE"]);
        }
        if (array_key_exists("URL", $array) && $array["URL"] != null) {
            $rivista->setUrl($array["URL"]);
        }
        if (array_key_exists("TAG", $array) && $array["TAG"] != null) {
            $rivista->setTag($array["TAG"]);
        }
        return $rivista;
    }

    public function fromArrayToRivistaArray(array $array)
    {
        $objectArray = [];
        foreach ($array as $item) {
            $singleElement = $this->fromArrayToRivista($item);
            array_push($objectArray, $singleElement);
        }
        return $objectArray;
    }
}
