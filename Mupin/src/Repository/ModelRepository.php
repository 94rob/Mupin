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

class ModelRepository
{

    public PDO $pdo;
    public Utils $stringUtils;
    public function __construct(PDO $pdo)
    {
        $this->stringUtils = new Utils();
        $this->pdo = $pdo;
        $this->pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    // SELECT
    public function selectAllFromTable(string $tableName): array
    {
        $sql_select_user = "SELECT * FROM " . $tableName;
        $statement_select = $this->pdo->prepare($sql_select_user);
        $statement_select->execute();
        return $statement_select->fetchAll(PDO::FETCH_ASSOC);
    }    

    public function selectWhereColumnLikeInput(string $table, string $column, string $input){
        $input = '%' . $input . '%';
        $sqlInstruction = "SELECT * FROM ". $table ." WHERE ". $column ." LIKE :input ;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindParam(':input', $input, PDO::PARAM_STR);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectFromTableWhereWhateverLikeInput(string $input, string $tabella): array
    {
        $input = '%' . $input . '%';
        $columns = $this->stringUtils->getColumnsByModelName($tabella);
        $i = 0;
        $len = count($columns);
        $sqlInstruction = "SELECT * FROM ". $tabella ." WHERE ";
        foreach($columns as $column){
            $sqlInstruction .= $column . " LIKE :input" . $i;
            if ($i < $len - 1){
                $sqlInstruction .= " OR ";
            }
            $i +=1;
        }        

        $sth = $this->pdo->prepare($sqlInstruction);
        
        for($i=0; $i<$len;$i++){
            $sth->bindParam(':input' . $i, $input, PDO::PARAM_STR);
        }        
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
    public function updateTableSetColumnByIdCatalogo(string $table, string $column, string $idCatalogo, string $input){
        
        $sqlInstruction = "UPDATE ". $table ." SET ". $column ." = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':input', (string)$input, PDO::PARAM_STR);
        $sth->bindParam(':id_catalogo', $idCatalogo, PDO::PARAM_STR);
        $sth->execute();        
              
    } 

    public function executeUpdate(string $table, array $columns, string $id): bool{
        try{
            $this->pdo->beginTransaction();
            foreach($columns as $key => $value){
                $this->updateTableSetColumnByIdCatalogo($table, $key, $id, $value);
            }
            $this->pdo->commit();
            return true;

        } catch (PDOException $e){
            $this->pdo->rollBack();
            return false;
        }
    }
    
    // DELETE
    public function deleteFromTableById(string $table, string $id): bool{
        try{
            $sqlInstruction = "DELETE FROM ". $table ." WHERE ID_CATALOGO = :id_catalogo ;";
            $sth = $this->pdo->prepare($sqlInstruction);
            $sth->bindParam(':id_catalogo', $id, PDO::PARAM_STR);
            $sth->execute();
            return true;
        } catch (PDOException $e){
            return false;
        }
    }

    // Utils
    public function selectNotNullableColumnsName(string $tabella): array | bool
    {
        try {
            $sqlInstruction = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS";
            $sqlInstruction .= " WHERE TABLE_NAME = :tabella AND is_nullable='NO';";
            $sth = $this->pdo->prepare($sqlInstruction);
            $sth->bindValue(':tabella', $tabella, PDO::PARAM_STR);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_ASSOC);            
        }
        catch (PDOException $e) {
            return false;
        }
    }
}