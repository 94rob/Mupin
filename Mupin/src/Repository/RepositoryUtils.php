<?php
declare(strict_types=1);
namespace App\Repository;
require 'vendor/autoload.php';

use PDO;
use PDOException;

class RepositoryUtils
{

    public PDO $pdo;
    public function __construct(PDO $pdo)
    {
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

    public function selectColumnsName(string $tabella): array |bool
    {
        try {
            $sqlInstruction = "SELECT COLUMN_NAME ";
            $sqlInstruction .= "FROM INFORMATION_SCHEMA.COLUMNS";
            $sqlInstruction .= "WHERE TABLE_SCHEMA='mupin' ";
            $sqlInstruction .= "AND TABLE_NAME=" . $tabella . "";

            $sth = $this->pdo->prepare($sqlInstruction);
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
            return false;
        }

    }

    public function selectNotNullableColumnsName(string $tabella): array | bool
    {
        try {
            $sqlInstruction = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS";
            $sqlInstruction .= " WHERE table_name ='" . $tabella . "' AND is_nullable='NO';";
            $sth = $this->pdo->prepare($sqlInstruction);
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
            return false;
        }
    }

    public function selectNullableColumnsName(string $tabella): array | bool
    {
        try {
            $sqlInstruction = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS";
            $sqlInstruction .= " WHERE table_name ='" . $tabella . "' AND is_nullable='YES';";
            $sth = $this->pdo->prepare($sqlInstruction);
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
            return false;
        }
    }

    // select column_name from information_schema.columns where table_name ='computer' AND is_nullable='YES';

    // INSERT
    public function insert(object $item, string $tabella)
    {
        
        try {
            $nullableColumns = $this->selectNullableColumnsName($tabella);
            $notNullableColumns = $this->selectNotNullableColumnsName($tabella);

            // Costruisco la query di insert
            $sqlInstruction = "INSERT INTO " . $tabella . " ";
            $sqlInstruction .= "(";
            foreach($notNullableColumns as $columnName){
                $sqlInstruction .= $columnName . ",";
            }
            substr_replace($sqlInstruction ,"", -1);
            $sqlInstruction .= ") VALUES (";
            foreach($notNullableColumns as $columnName){
                $sqlInstruction .= ":" . strtolower($columnName) . ",";
            }
            substr_replace($sqlInstruction ,"", -1);
            $sqlInstruction .= ");";

            // Eseguo il binding
            $sth = $this->pdo->prepare($sqlInstruction);
                       

            foreach($notNullableColumns as $columnName){
                $method = "get" . $this->snakeToCamelCase(strtolower($columnName), false); 
                $sth->bindValue(":" . strtolower($columnName), $item->${"method"}(), PDO::PARAM_STR);
            }
        }
        catch (PDOException $e) {

        }
        $sqlInstruction = "INSERT INTO computer (ID_CATALOGO, MODELLO, ANNO, CPU, VELOCITA_CPU, MEMORIA_RAM";
        $sqlInstruction .= ") VALUES ( :id_catalogo , :modello , :anno, :cpu , :velocita_cpu , :memoria_ram ); ";

        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':id_catalogo', $computer->getIdCatalogo(), PDO::PARAM_STR);
        $sth->bindValue(':modello', $computer->getModello(), PDO::PARAM_STR);
        $sth->bindValue(':anno', $computer->getAnno(), PDO::PARAM_INT);
        $sth->bindValue(':cpu', $computer->getCpu(), PDO::PARAM_STR);
        $sth->bindValue(':velocita_cpu', $computer->getVelocitaCpu());
        $sth->bindValue(':memoria_ram', $computer->getMemoriaRAM(), PDO::PARAM_INT);
        $sth->execute();

        if (isset($computer->dimensione_hard_disk)) {
            $this->updateColumnByIdCatalogo("DIMENSIONE_HARD_DISK", $computer->getIdCatalogo(), (string)$computer->getDimensioneHardDisk());
        }
        if (isset($computer->sistema_operativo)) {
            $this->updateColumnByIdCatalogo("SISTEMA_OPERATIVO", $computer->getIdCatalogo(), $computer->getSistemaOperativo());
        }
        if (isset($computer->note)) {
            $this->updateColumnByIdCatalogo("NOTE", $computer->getIdCatalogo(), $computer->getNote());
        }
        if (isset($computer->url)) {
            $this->updateColumnByIdCatalogo("URL", $computer->getIdCatalogo(), $computer->getUrl());
        }
        if (isset($computer->tag)) {
            $this->updateColumnByIdCatalogo("TAG", $computer->getIdCatalogo(), $computer->getTag());
        }
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