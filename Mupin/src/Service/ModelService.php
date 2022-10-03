<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\ComputerRepository;
use App\Repository\LibroRepository;
use App\Repository\PerifericaRepository;
use App\Repository\RivistaRepository;
use App\Repository\SoftwareRepository;
use App\Utils\Utils;
use PDO;
use PDOException;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use ReflectionClass;
use ReflectionProperty;
use App\Repository\InsertRepository;
use App\Repository\SelectRepository;
use App\Repository\UpdateRepository;
use App\Repository\DeleteRepository;

require 'vendor/autoload.php';

class ModelService{     
    protected SelectRepository $selectRepo;   
    protected InsertRepository $insertRepo;   
    protected UpdateRepository $updateRepo;   
    protected DeleteRepository $deleteRepo;   
    protected Utils $utils;
    protected ImageService $imageService;
    protected $tables = ["computer", "libro", "rivista", "periferica", "software"];

    public function __construct()
    {
        $config = include 'db-config.php';
        $this->utils = new Utils();
        $this->imageService = new ImageService();
        try{
            $pdo = new PDO($config['dsn'], $config['username'], $config['password']);            
            $this->selectRepo = new SelectRepository($pdo);
            $this->updateRepo = new UpdateRepository($pdo);
            $this->deleteRepo = new DeleteRepository($pdo);
            $this->insertRepo = new InsertRepository($pdo);

        } catch (PDOException $e){
            $log = new Logger('connession'); 
            $log->pushHandler(new StreamHandler('./public/log/file.log', Logger::ERROR));
            $log->error($e->getMessage());
        }        
    }   

    // UTILITY
    public function pushInArrayIfNew(array $result, array $response_array): array
    {
        // Evita doppioni nell'array che risulta dalla ricerca per selettori
        foreach ($result as $item) {
            if (!in_array($item, $response_array)) {
                array_push($response_array, $item);
            }
        }
        return $response_array;
    }
    
    public function fromArrayToModel(array $objectAsArray, string $tabella)
    {
        $constructor = 'App\Models\\' . ucfirst($tabella);
        $item = new ${'constructor'}();        

        $reflect = new ReflectionClass($item);
        $properties = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);

        foreach($properties as $property){
            $columnName = $this->utils->stringToColumnName($property->getName());

            if((array_key_exists($columnName, $objectAsArray)) && ($objectAsArray[$columnName] != NULL)){
                $method = $this->utils->setterBuilder($columnName);
                $item->${"method"}($objectAsArray[$columnName]);
            }    
        }
        return $item;
    }

    public function fromArrayToModelArray(array $array, string $tabella){
        $objectArray = [];
        foreach ($array as $item) {
            $singleElement = $this->fromArrayToModel($item, $tabella);
            array_push($objectArray, $singleElement);
        }
        return $objectArray;
    }
}