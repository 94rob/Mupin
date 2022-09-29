<?php
declare(strict_types=1);
namespace App\Service\Implementations;
require 'vendor/autoload.php';

use App\Repository\SoftwareRepository;
use App\Models\Software;
use App\Service\Interfaces\ISoftwareService;
use App\Service\ServiceUtils;
use PDO;
use PDOException;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class SoftwareService extends ServiceUtils implements ISoftwareService
{

    public SoftwareRepository $softwareRepository;

    public function __construct()
    {
        $config = include 'db-config.php';
        try{
            $pdo = new PDO($config['dsn'], $config['username'], $config['password']);
            $this->softwareRepository = new SoftwareRepository($pdo); 

        } catch (PDOException $e){
            $log = new Logger('connession'); 
            $log->pushHandler(new StreamHandler('./public/log/file.log', Logger::ERROR));
            $log->error($e->getMessage());
        } 
    }

    // SELECT
    public function executeSelect(string $cosa_cercare, array $selettori ){
        $response_array["software"] = [];
                if (empty($selettori)) {
                    $result = $this->selectFromSoftwareWhereWhateverLikeInput($cosa_cercare);
                    $response_array["software"] = parent::pushInArrayIfNew($result, $response_array["software"]);
                }
               if (in_array("modello-titolo", $selettori)) {
                    $selettori["titolo"] = $selettori["modello-titolo"];
                    unset($selettori["modello-titolo"]);
                }

                $possibiliSelettori = ["id-catalogo", "titolo", "sistema-operativo", "note", "tag"];
                foreach ($possibiliSelettori as $selettore) {
                    if (in_array($selettore, $selettori)) {
                        $column = str_replace("-", "_", strtoupper($selettore));
                        $result = $this->selectWhereColumnLikeInput($column, $cosa_cercare);
                        $response_array["software"] = parent::pushInArrayIfNew($result, $response_array["software"]);
                    }
                }
                return $response_array;
    }
    public function selectAll(): array
    {
        $result = $this->softwareRepository->selectAll("software");
        return $this->fromArrayToSoftwareArray($result);
    }
    public function selectFromSoftwareWhereWhateverLikeInput(string $input): array{
        $result = $this->softwareRepository->selectFromSoftwareWhereWhateverLikeInput($input);
        return $this->fromArrayToSoftwareArray($result);
    }

    public function selectWhereColumnLikeInput(string $column, string $input): array {
        $result = $this->softwareRepository->selectWhereColumnLikeInput($column, $input);
        return $this->fromArrayToSoftwareArray($result);
    } 

    // INSERT
    public function insertIntoSoftware(array $array){
        $element = $this->fromArrayToSoftware($array);
        $this->softwareRepository->insertIntoSoftware($element);
    }

    // UPDATE
    public function updateColumnByIdCatalogo(string $column, string $idCatalogo, string $input){
        $this->softwareRepository->updateColumnByIdCatalogo($column, $idCatalogo, $input);
    }

    // DELETE
    public function deleteFromSoftware(string $idCatalogo){
        $this->softwareRepository->deleteFromSoftware($idCatalogo);
    }

    // Utils
    public function fromArrayToSoftware(array $array): Software
    {
        $software = new Software();
        $software->setIdCatalogo($array["ID_CATALOGO"]);
        $software->setTitolo($array["TITOLO"]);
        $software->setSistemaOperativo($array["SISTEMA_OPERATIVO"]);
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
