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

class SelectRepository extends ModelRepository
{
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
}