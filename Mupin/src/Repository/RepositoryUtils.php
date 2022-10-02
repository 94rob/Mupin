<?php
declare(strict_types=1);
namespace App\Repository;
require 'vendor/autoload.php';

use App\Utils\StringUtils;
use PDO;
use PDOException;
use PDOStatement;
use ReflectionClass;
use ReflectionProperty;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class RepositoryUtils
{

    public PDO $pdo;
    public StringUtils $stringUtils;
    public function __construct(PDO $pdo)
    {
        $this->stringUtils = new StringUtils();
        $this->pdo = $pdo;
        $this->pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    // SELECT
    public function selectAll(string $tableName): array
    {
        $sql_select_user = "SELECT * FROM " . $tableName;
        $statement_select = $this->pdo->prepare($sql_select_user);
        $statement_select->execute();
        return $statement_select->fetchAll(PDO::FETCH_ASSOC);
    }
    public function executeSelect(string $input, string $sqlInstruction)
    {
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':input', $input, PDO::PARAM_STR);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    // INSERT  
    public function insertItemIntoTable($item, string $tabella): bool
    {
        $reflect = new ReflectionClass($item);
        $properties = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);
        $propertyNames = [];
        foreach($properties as $property){
            array_push($propertyNames, $property->getName());
        }
        
        $sqlInstruction = $this->insertQueryBuilder($item, $tabella, $propertyNames);        

        try {    
            $sth = $this->pdo->prepare($sqlInstruction);  
            $sth = $this->bindInsertParams($item, $sth, $propertyNames);
            $sth->execute();
            return true;
        }
        catch (PDOException $e) {
            $log = new Logger('query'); 
            $log->pushHandler(new StreamHandler('./public/log/file.log', Logger::ERROR));
            $log->info("User " . $_SESSION["user"] . " failed insert");
            return false;
        }
    }

    public function bindInsertParams($item, PDOStatement $sth, array $columns) : PDOStatement
    {
        foreach($columns as $column){
            $fieldName = strtolower($column);
            if(isset($item->${"fieldName"})){
                $method = $this->stringUtils->getterBuilder($column);

            switch(gettype($item->${"method"}())){
                case "int":
                    $sth->bindValue(":" . strtolower($column), $item->${"method"}(), PDO::PARAM_INT);
                    break;     
                default:
                    $sth->bindValue(":" . strtolower($column), $item->${"method"}(), PDO::PARAM_STR);
                    break;
                }  
            }            
        }
        return $sth;
    }
    public function insertQueryBuilder($item, string $tabella, array $property): string
    {    
        $sqlInstruction = "INSERT INTO " . $tabella . " ";
        $sqlInstruction .= "(";
        foreach($property as $column){
            $fieldName = strtolower($column);
            if(isset($item->${"fieldName"})){
                $sqlInstruction .= $column . ",";                    
            }
        }
        $sqlInstruction = substr($sqlInstruction ,0, -1);
        $sqlInstruction .= ") VALUES (";
        foreach($property as $column){
            $fieldName = strtolower($column);
            if(isset($item->${"fieldName"})){
                $sqlInstruction .= ":" . strtolower($column) . ",";
            }
        }
        $sqlInstruction =  substr($sqlInstruction ,0, -1);
        $sqlInstruction .= ");";
        return $sqlInstruction;
    }


    // UPDATE
    public function executeUpdate(string $newValue, string $idCatalogo, string $sqlUpdate)
    {
        $sth = $this->pdo->prepare($sqlUpdate);
        $sth->bindValue(':input', $newValue, PDO::PARAM_STR);
        $sth->bindValue(':id_catalogo', $idCatalogo, PDO::PARAM_STR);
        $sth->execute();
    }

    // UTILS
    function snakeToCamelCase($string, $capitalizeFirstCharacter = false) 
    {

        $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));

        if (!$capitalizeFirstCharacter) {
            $str[0] = strtolower($str[0]);
        }

        return $str;
    }


}