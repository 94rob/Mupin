<?php
declare(strict_types=1);
namespace Mupin\Service;
require 'vendor/autoload.php';

use Mupin\Repository\SoftwareRepository;
use Mupin\Models\Software;

class SoftwareService implements ISoftwareService
{

    public SoftwareRepository $softwareRepository;

    public function __construct()
    {
        $this->softwareRepository = new SoftwareRepository();
    }

    // SELECT
    public function selectAll(): array
    {
        $result = $this->softwareRepository->selectAll();
        return $this->fromArrayToSoftwareArray($result);
    }
    public function selectByTitolo(string $input): array
    {
        $result = $this->softwareRepository->selectByTitolo($input);
        return $this->fromArrayToSoftwareArray($result);
    }
    public function selectBySistemaOperativo(string $input): array
    {
        $result = $this->softwareRepository->selectBySistemaOperativo($input);
        return $this->fromArrayToSoftwareArray($result);
    }
    public function selectByNote(string $input): array
    {
        $result = $this->softwareRepository->selectByNote($input);
        return $this->fromArrayToSoftwareArray($result);
    }
    public function selectByTag(string $input): array
    {
        $result = $this->softwareRepository->selectByTag($input);
        return $this->fromArrayToSoftwareArray($result);
    }

    // INSERT
    public function insertIntoSoftware(array $array){
        $element = $this->fromArrayToSoftware($array);
        $this->softwareRepository->insertIntoSoftware($element);
    }

    // UPDATE
    public function updateTitolo(string $idCatalogo, string $input)
    {
        $this->softwareRepository->updateTitolo($idCatalogo, $input);
    }
    public function updateSistemaOperativo(string $idCatalogo, string $input)
    {
        $this->softwareRepository->updateSistemaOperativo($idCatalogo, $input);
    }
    public function updateTipologia(string $idCatalogo, string $input)
    {
        $this->softwareRepository->updateTipologia($idCatalogo, $input);
    }
    public function updateSupporto(string $idCatalogo, string $input)
    {
        $this->softwareRepository->updateSupporto($idCatalogo, $input);
    }
    public function updateNote(string $idCatalogo, string $input)
    {
        $this->softwareRepository->updateNote($idCatalogo, $input);
    }
    public function updateUrl(string $idCatalogo, string $input)
    {
        $this->softwareRepository->updateUrl($idCatalogo, $input);
    }
    public function updateTag(string $idCatalogo, string $input)
    {
        $this->softwareRepository->updateTag($idCatalogo, $input);
    }

    // DELETE
    public function deleteFromSoftware(string $idCatalogo){
        $this->softwareRepository->deleteFromSoftware($idCatalogo);
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
