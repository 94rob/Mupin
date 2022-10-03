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
    protected PDO $pdo;
    protected Utils $stringUtils;
    public function __construct(PDO $pdo)
    {
        $this->stringUtils = new Utils();
        $this->pdo = $pdo;
        $this->pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
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