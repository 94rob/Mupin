<?php
declare(strict_types=1);
namespace App\Repository;
require 'vendor/autoload.php';

use App\Utils\Utils;
use PDO;
use PDOException;
use PDOStatement;
use ReflectionClass;
use ReflectionProperty;

class InsertRepository extends ModelRepository
{
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

}