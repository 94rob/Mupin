<?php

declare(strict_types=1);

namespace App\Service\Implementations;

require 'vendor/autoload.php';

use PDO;
use PDOException;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use App\Models\Computer;
use App\Repository\ComputerRepository;
use App\Service\Interfaces\IComputerService;
use App\Service\ServiceUtils;

class ComputerService extends ServiceUtils implements IComputerService
{

    public ComputerRepository $computerRepository; 

    public function __construct()
    {
        $config = include 'db-config.php';
        try{
            $pdo = new PDO($config['dsn'], $config['username'], $config['password']);
            $this->computerRepository = new ComputerRepository($pdo); 

        } catch (PDOException $e){
            $log = new Logger('connession'); 
            $log->pushHandler(new StreamHandler('./public/log/file.log', Logger::ERROR));
            $log->error($e->getMessage());
        }        
    }

    // SELECT    
    public function executeSelect(string $cosa_cercare, array $selettori ){
        $response_array["computer"] = [];
                if($cosa_cercare === null){
                    $response_array["computer"] = $this->selectAll();                    
                    return $response_array;
                }

                if (empty($selettori)) {
                    $result = $this->selectFromComputerWhereWhateverLikeInput($cosa_cercare);
                    $response_array["computer"] = parent::pushInArrayIfNew($result, $response_array["computer"]);
                    return $response_array;
                }

                if (array_key_exists("modello-titolo", $selettori)) {
                    $selettori["modello"] = $selettori["modello-titolo"];
                    unset($selettori["modello-titolo"]);
                }
                $possibiliSelettori = ["id-catalogo", "modello", "anno", "sistema-operativo", "note", "tag"];
                foreach ($possibiliSelettori as $selettore) {
                    if (in_array($selettore, $selettori)) {
                        $column = str_replace("-", "_", strtoupper($selettore));
                        $result = $this->selectWhereColumnLikeInput($column, $cosa_cercare);
                        $response_array["computer"] = parent::pushInArrayIfNew($result, $response_array["computer"]);
                    }
                }

                return $response_array;
    }
    public function selectAll(): array
    {
        $result = $this->computerRepository->selectAll("computer");
        return $this->fromArrayToComputerArray($result);
    }
    public function selectFromComputerWhereWhateverLikeInput(string $input): array{
        $result = $this->computerRepository->selectFromComputerWhereWhateverLikeInput($input);
        return $this->fromArrayToComputerArray($result);
    }

    public function selectWhereColumnLikeInput(string $column, string $input): array {
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
        $pc->setAnno((int)$array["ANNO"]);
        $pc->setCpu($array["CPU"]);
        $pc->setVelocitaCpu((float)$array["VELOCITA_CPU"]);
        $pc->setMemoriaRAM((int)$array["MEMORIA_RAM"]);

        if (array_key_exists("DIMENSIONE_HARD_DISK", $array) && $array["DIMENSIONE_HARD_DISK"] != null) {
            $pc->setDimensioneHardDisk((int)$array["DIMENSIONE_HARD_DISK"]);
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
