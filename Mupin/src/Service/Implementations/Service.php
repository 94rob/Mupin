<?php

declare(strict_types=1);

namespace App\Service\Implementations;

use App\Repository\ComputerRepository;
use App\Repository\LibroRepository;
use App\Repository\PerifericaRepository;
use App\Repository\RivistaRepository;
use App\Repository\SoftwareRepository;
use App\Utils\StringUtils;
use PDO;
use PDOException;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use ReflectionClass;
use ReflectionProperty;

require 'vendor/autoload.php';

class Service{
    protected ComputerRepository $computerRepository;
    protected LibroRepository $libroRepository;
    protected PerifericaRepository $perifericaRepository;
    protected RivistaRepository $rivistaRepository;
    protected SoftwareRepository $softwareRepository;
    protected StringUtils $stringUtils;
    protected $tables = ["computer", "libro", "rivista", "periferica", "software"];

    public function __construct()
    {
        $config = include 'db-config.php';
        $this->stringUtils = new StringUtils();
        try{
            $pdo = new PDO($config['dsn'], $config['username'], $config['password']);
            $this->computerRepository = new ComputerRepository($pdo); 
            $this->libroRepository = new LibroRepository($pdo); 
            $this->rivistaRepository = new RivistaRepository($pdo); 
            $this->perifericaRepository = new PerifericaRepository($pdo); 
            $this->softwareRepository = new SoftwareRepository($pdo); 

        } catch (PDOException $e){
            $log = new Logger('connession'); 
            $log->pushHandler(new StreamHandler('./public/log/file.log', Logger::ERROR));
            $log->error($e->getMessage());
        }        
    }

    // SELECT
    public function selectFromAllTablesByInput(string $input){
        $response_array = [];
        if($input == ""){
            foreach($this->tables as $table){
                $repository = $table . "Repository";
                $result = $this->${"repository"}->selectAll($table);
                $response_array[$table] = $this->fromArrayToModelArray($result, $table);
            }            
            return $response_array;
        } 
        
        foreach($this->tables as $table){
            $repository = $table . "Repository";
            $method = "selectFrom" . ucfirst($table) . "WhereWhateverLikeInput";
            $result = $this->${"repository"}->${"method"}($input);
            $response_array[$table] = $this->fromArrayToModelArray($result, $table);
        }               
        return $response_array;
    }

    public function executeSelect(string $tabella, string $input, array $selettori){
        $repository = $tabella . "Repository";
        $response_array = [];
        
        // NO INPUT
        if($input === ""){            
            $result = $this->${"repository"}->selectAll($tabella);  
            $response_array[$tabella] = $this->fromArrayToModelArray($result, $tabella);
            return $response_array;
        }

        // NO SELETTORI
        if (empty($selettori)) {
            $method = "selectFrom" . ucfirst($tabella) . "WhereWhateverLikeInput";
            $result = $this->${"repository"}->${"method"}($input);             
            $response_array[$tabella] = $this->fromArrayToModelArray($result, $tabella);
            return $response_array; 
        }

        // SI INPUT SI SELETTORI
        $constructor = "App\Models\\" . $tabella;
        $object = new ${'constructor'}();
        $reflect = new ReflectionClass($object);
        $properties = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);
        $columns = [];
        foreach($properties as $property){
            array_push($columns, $this->stringUtils->stringToColumnName($property->getName()));
        }        

        if(in_array("modello-titolo", $selettori)){
            array_push($selettori, "modello");
            array_push($selettori, "titolo");
        }

        

        foreach($selettori as $selettore){
            if(in_array($this->stringUtils->stringToColumnName($selettore), $columns)){
                $result = $this->${'repository'}->selectWhereColumnLikeInput($selettore, $input);
                $item_result = $this->fromArrayToModelArray($result, $tabella);
                $response_array[$tabella] =$this->pushInArrayIfNew($item_result, []);                  
                return $response_array;                  
            }
        }               
    }

    // INSERT
     // INSERT    
     public function insertItemIntoTable(array $post, string $tabella, array $files): bool
     {
         // TODO fai il controllo sull'id catalogo
         $idCatalogo = $post["ID_CATALOGO"];
 
         // popolo l'array
         $arrayColumnNotEmpty = [];
         foreach($post as $key => $value){
             $columnName = $this->stringUtils->stringToColumnName($key);
             $arrayColumnNotEmpty[$columnName] = $value;                
         }           
 
         $item = $this->fromArrayToModel($arrayColumnNotEmpty, $tabella);
 
         $repo = $tabella . "Repository";
         $querySuccess = $this->${'repo'}->insertItemIntoTable($item, $tabella);
         
         // Se la insert ha avuto successo, inserisce l'immagine qualora ci sia
         if($querySuccess){                
             if((array_key_exists("img", $files)) && ($files["img"]["size"] != 0)){                
                 
                 $temp = explode("/", $files["img"]['type']);
                 $ext = $temp[1];
 
                 $path =$_SERVER['DOCUMENT_ROOT']."/img";                               
                 $fileName = $path . "/" . $idCatalogo. "_0." . $ext;
 
                 file_put_contents($fileName, file_get_contents($files["img"]["tmp_name"]));                    
             }
             return true;
         }   
         return false;       
     }

    // UTILITY
    public function pushInArrayIfNew(array $result, array $response_array): array
    {
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
            $columnName = $this->stringUtils->stringToColumnName($property->getName());

            if((array_key_exists($columnName, $objectAsArray)) && ($objectAsArray[$columnName] != NULL)){
                $method = $this->stringUtils->setterBuilder($columnName);
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