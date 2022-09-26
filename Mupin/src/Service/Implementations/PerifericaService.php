<?php

declare(strict_types=1);
namespace App\Service\Implementations;
require 'vendor/autoload.php';

use App\Repository\PerifericaRepository;
use App\Models\Periferica;
use App\Service\Interfaces\IPerifericaService;
use App\Service\ServiceUtils;
use PDO;

class PerifericaService extends ServiceUtils implements IPerifericaService
{

    public PerifericaRepository $perifericaRepository;

    public function __construct()
    {
        $config = include 'config.php';
        $pdo = new PDO($config['dsn'], $config['username'], $config['password']);        
        $this->perifericaRepository = new PerifericaRepository($pdo);        
    }

    // SELECT
    public function executeSelect(string $cosa_cercare, array $selettori ){
        $response_array["periferica"] = [];
                if (empty($selettori)) {
                    $result = $this->selectFromPerifericaWhereWhateverLikeInput($cosa_cercare);
                    $response_array["periferica"] = parent::pushInArrayIfNew($result, $response_array["periferica"]);
                }
                if (in_array("modello-titolo", $selettori)) {
                    $selettori["modello"] = $selettori["modello-titolo"];
                    unset($selettori["modello-titolo"]);
                }
                $possibiliSelettori = ["id-catalogo", "modello", "note", "tag"];
                foreach ($possibiliSelettori as $selettore) {
                    if (in_array($selettore, $selettori)) {
                        $column = str_replace("-", "_", strtoupper($selettore));
                        $result = $this->selectWhereColumnLikeInput($column, $cosa_cercare);
                        $response_array["periferica"] = parent::pushInArrayIfNew($result, $response_array["periferica"]);
                    }
                }
                return $response_array;
    }
    public function selectAll(): array
    {
        $result = $this->perifericaRepository->selectAll("periferica");
        return $this->fromArrayToPerifericaArray($result);
    }
    public function selectFromPerifericaWhereWhateverLikeInput(string $input): array{
        $result = $this->perifericaRepository->selectFromPerifericaWhereWhateverLikeInput($input);
        return $this->fromArrayToPerifericaArray($result);
    }

    public function selectWhereColumnLikeInput(string $column, string $input): array {
        $result = $this->perifericaRepository->selectWhereColumnLikeInput($column, $input);
        return $this->fromArrayToPerifericaArray($result);
    } 

    // INSERT
    public function insertIntoPeriferica(array $array){
        $element = $this->fromArrayToPeriferica($array);
        $this->perifericaRepository->insertIntoPeriferica($element);
    }

    // UPDATE
    public function updateColumnByIdCatalogo(string $column, string $idCatalogo, string $input){
        $this->perifericaRepository->updateColumnByIdCatalogo($column, $idCatalogo, $input);
    }

    // DELETE
    public function deleteFromPeriferica(string $idCatalogo){
        $this->perifericaRepository->deleteFromPeriferica($idCatalogo);
    }

    // Utils
    public function fromArrayToPeriferica(array $array): Periferica
    {
        $periferica = new Periferica();
        $periferica->setIdCatalogo($array["ID_CATALOGO"]);
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
