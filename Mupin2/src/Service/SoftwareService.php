<?php

declare(strict_types=1);

namespace Mupin\Service;

require 'vendor/autoload.php';

use Mupin\Repository\SoftwareRepository;
use Mupin\Models\Software;

class SoftwareService
{

    public SoftwareRepository $softwareRepository;

    public function __construct()
    {
        $this->softwareRepository = new SoftwareRepository();
    }

    // SELECT
    public function selectByAll(string $input): array
    {
        $result = $this->softwareRepository->selectFromSoftware($input);
        return $this->fromArrayToSoftwareArray($result);
    }
    public function selectByTitolo(string $input)
    {
        $result = $this->softwareRepository->selectByTitolo($input);
        return $this->fromArrayToSoftwareArray($result);
    }
    public function selectBySistemaOperativo(string $input)
    {
        $result = $this->softwareRepository->selectBySistemaOperativo($input);
        return $this->fromArrayToSoftwareArray($result);
    }
    public function selectByNote(string $input)
    {
        $result = $this->softwareRepository->selectByNote($input);
        return $this->fromArrayToSoftwareArray($result);
    }
    public function selectByTag(string $input)
    {
        $result = $this->softwareRepository->selectByTag($input);
        return $this->fromArrayToSoftwareArray($result);
    }

    // Utils
    public function fromArrayToSoftware(array $array): Software
    {
        $software = new Software();
        $software->setId_catalogo($array["ID_CATALOGO"]);
        $software->setTitolo($array["TITOLO"]);
        $software->setSistema_operativo($array["SISTEMA_OPERATIVO"]);
        $software->setTipologia($array["TIPOLOGIA"]);
        $software->setSupporto($array["SUPPORTO"]);

        if (array_key_exists("NOTE", $array) && $array["NOTE"] != null) {
            $software->setNote($array["NOTE"]);
        }
        if (array_key_exists("URL", $array) && $array["URL"] != null) {
            $software->setUrl($array["URL"]);
        }
        if (array_key_exists("TAG", $array) && $array["TAG"] != null) {
            $software->setTag($array["TAG"]);
        }
        return $software;
    }

    public function fromArrayToSoftwareArray(array $array)
    {
        $objectArray = [];
        foreach ($array as $item) {
            $singleElement = $this->fromArrayToSoftware($item);
            array_push($objectArray, $singleElement);
        }
        return $objectArray;
    }
}
