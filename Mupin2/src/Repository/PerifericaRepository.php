<?php
declare (strict_types=1);
namespace Mupin\Repository;
require 'vendor/autoload.php';

use PDO;
use Mupin\Models\Periferica;
class PerifericaRepository{
    public PDO $pdo;
    public function __construct(){
        $config = include 'config.php';
        $this -> pdo = new PDO($config['dsn'], $config['username'], $config['password']);
        $this->pdo->setAttribute (PDO::ATTR_STRINGIFY_FETCHES, false);
        $this->pdo->setAttribute (PDO::ATTR_EMULATE_PREPARES, false);
    }

    // SELECT
    public function selectFromPeriferica(string $input) : array{
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM periferica WHERE MODELLO LIKE :input0 ";         
        $sqlInstruction .= "OR TIPOLOGIA LIKE :input1 ";
        $sqlInstruction .= "OR NOTE LIKE :input2 ";
        $sqlInstruction .= "OR URL LIKE :input3 ";
        $sqlInstruction .= "OR TAG LIKE :input4 ;";        
                
        $sth = $this -> pdo -> prepare($sqlInstruction);
        $sth -> bindValue(':input0', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input1', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input2', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input3', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input4', $input, PDO::PARAM_STR);
        
        $sth -> execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectByModello(string $input){
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM periferica WHERE MODELLO LIKE :input ;";
        $sth = $this -> pdo -> prepare($sqlInstruction);
        $sth -> bindValue(':input', $input, PDO::PARAM_STR);
        $sth -> execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectByNote(string $input){
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM periferica WHERE NOTE LIKE :input ;";
        $sth = $this -> pdo -> prepare($sqlInstruction);
        $sth -> bindValue(':input', $input, PDO::PARAM_STR);
        $sth -> execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectByTag(string $input){
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM periferica WHERE TAG LIKE :input ;";
        $sth = $this -> pdo -> prepare($sqlInstruction);
        $sth -> bindValue(':input', $input, PDO::PARAM_STR);
        $sth -> execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    // INSERT
    public function insertIntoComputer(Periferica $periferica)
    {
        $sqlInstruction = "INSERT INTO periferica (ID_CATALOGO,MODELLO, TIPOLOGIA";
        $sqlInstruction .= ") VALUES ( :id_catalogo , :modello , :tipologia ); ";        

        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':id_catalogo', $periferica->getId_catalogo(), PDO::PARAM_STR);
        $sth->bindValue(':modello', $periferica->getModello(), PDO::PARAM_STR);
        $sth->bindValue(':tipologia', $periferica->getTipologia(), PDO::PARAM_STR);        
        $sth->execute();
        
        if (isset($periferica->note)) {
            $sqlInstruction = "UPDATE periferica SET NOTE = :note WHERE ID_CATALOGO = :id_catalogo ;";
            $sth = $this->pdo->prepare($sqlInstruction);
            $sth->bindValue(':note', $periferica->getNote(), PDO::PARAM_STR);
            $sth->bindValue(':id_catalogo', $periferica->getId_catalogo(), PDO::PARAM_STR);
            $sth->execute();
        }
        if (isset($periferica->url)) {
            $sqlInstruction = "UPDATE periferica SET URL = :url WHERE ID_CATALOGO = :id_catalogo ;";
            $sth = $this->pdo->prepare($sqlInstruction);
            $sth->bindValue(':url', $periferica->getUrl(), PDO::PARAM_STR);
            $sth->bindValue(':id_catalogo', $periferica->getId_catalogo(), PDO::PARAM_STR);
            $sth->execute();
        }
        if (isset($periferica->tag)) {
            $sqlInstruction = "UPDATE periferica SET TAG = :tag WHERE ID_CATALOGO = :id_catalogo ;";
            $sth = $this->pdo->prepare($sqlInstruction);
            $sth->bindValue(':tag', $periferica->getTag(), PDO::PARAM_STR);
            $sth->bindValue(':id_catalogo', $periferica->getId_catalogo(), PDO::PARAM_STR);
            $sth->execute();
        }
    }
}