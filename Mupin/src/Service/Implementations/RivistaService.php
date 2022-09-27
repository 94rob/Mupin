<?php
declare(strict_types=1);
namespace App\Service\Implementations;
require 'vendor/autoload.php';

use App\Models\Rivista;
use App\Repository\RivistaRepository;
use App\Service\Interfaces\IRivistaService;
use App\Service\ServiceUtils;
use PDO;

class RivistaService extends ServiceUtils implements IRivistaService
{
    public RivistaRepository $rivistaRepository;


    public function __construct()
    {
        $config = include 'config.php';
        $pdo = new PDO($config['dsn'], $config['username'], $config['password']);
        $this->rivistaRepository = new RivistaRepository($pdo);
    }

    // SELECT
    public function executeSelect(string $cosa_cercare, array $selettori ){
        $response_array["rivista"] = [];
                if (empty($selettori)) {
                    $result = $this->selectFromRivistaWhereWhateverLikeInput($cosa_cercare);
                    $response_array["rivista"] = parent::pushInArrayIfNew($result, $response_array["rivista"]);
                }
                if (in_array("modello-titolo", $selettori)) {
                    $selettori["titolo"] = $selettori["modello-titolo"];
                    unset($selettori["modello-titolo"]);
                }
                $possibiliSelettori = ["id-catalogo", "titolo", "anno", "casa-editrice", "note", "tag"];
                foreach ($possibiliSelettori as $selettore) {
                    if (in_array($selettore, $selettori)) {
                        $column = str_replace("-", "_", strtoupper($selettore));
                        $result = $this->selectWhereColumnLikeInput($column, $cosa_cercare);
                        $response_array["rivista"] = parent::pushInArrayIfNew($result, $response_array["rivista"]);
                    }
                }
                return $response_array;
    }
    public function selectAll(): array
    {
        $result = $this->rivistaRepository->selectAll("rivista");
        return $this->fromArrayToRivistaArray($result);
    }
    public function selectFromRivistaWhereWhateverLikeInput(string $input): array{
        $result = $this->rivistaRepository->selectFromRivistaWhereWhateverLikeInput($input);
        return $this->fromArrayToRivistaArray($result);
    }

    public function selectWhereColumnLikeInput(string $column, string $input): array {
        $result = $this->rivistaRepository->selectWhereColumnLikeInput($column, $input);
        return $this->fromArrayToRivistaArray($result);
    } 
    // INSERT
    public function insertIntoRivista(array $array)
    {
        $element = $this->fromArrayToRivista($array);
        $this->rivistaRepository->insertIntoRivista($element);
    }

    // UPDATE
    public function updateColumnByIdCatalogo(string $column, string $idCatalogo, string $input){
        $this->rivistaRepository->updateColumnByIdCatalogo($column, $idCatalogo, $input);
    }

    // DELETE
    public function deleteFromRivista(string $idCatalogo){
        $this->rivistaRepository->deleteFromRivista($idCatalogo);
    }

    // Utils
    public function fromArrayToRivista(array $array): Rivista
    {
        $rivista = new Rivista();
        $rivista->setIdCatalogo($array["ID_CATALOGO"]);
        $rivista->setTitolo($array["TITOLO"]);
        $rivista->setNumeroRivista($array["NUMERO_RIVISTA"]);
        $rivista->setAnno($array["ANNO"]);
        $rivista->setCasaEditrice($array["CASA_EDITRICE"]);

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
