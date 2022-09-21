<?php
declare (strict_types=1);
namespace App\Repository;
require 'vendor/autoload.php';

use PDO;
use App\Models\Periferica;
class PerifericaRepository extends RepositoryFather{  

    // SELECT   
    public function selectAll(): array{
        $sqlInstruction = "SELECT * FROM periferica;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectFromPerifericaWhere(string $input): array
    {
        $input = '%' . $input . '%';
        $arrProperties = ["MODELLO", "TIPOLOGIA", "NOTE", "URL", "TAG"];
        $i = 0;
        $len = count($arrProperties);
        $sqlInstruction = "SELECT * FROM periferica WHERE ";
        foreach($arrProperties as $element){
            $sqlInstruction .= $element . " LIKE :input" . $i;
            if ($i < $len - 1){
                $sqlInstruction .= " OR ";
            }
            $i +=1;
        }        

        $sth = $this->pdo->prepare($sqlInstruction);
        
        for($i=0; $i<$len;$i++){
            $sth->bindValue(':input' . $i, $input, PDO::PARAM_STR);
        }        
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectByModello(string $input){
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM periferica WHERE MODELLO LIKE :input ;";
        return parent::executeSelectString($input, $sqlInstruction, $this->pdo);
    }
    public function selectByNote(string $input){
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM periferica WHERE NOTE LIKE :input ;";
        return parent::executeSelectString($input, $sqlInstruction, $this->pdo);
    }
    public function selectByTag(string $input){
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM periferica WHERE TAG LIKE :input ;";
        return parent::executeSelectString($input, $sqlInstruction, $this->pdo);
    }

    // INSERT
    public function insertIntoPeriferica(Periferica $periferica)
    {
        $sqlInstruction = "INSERT INTO periferica (ID_CATALOGO,MODELLO, TIPOLOGIA";
        $sqlInstruction .= ") VALUES ( :id_catalogo , :modello , :tipologia ); ";        

        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':id_catalogo', $periferica->getId_catalogo(), PDO::PARAM_STR);
        $sth->bindValue(':modello', $periferica->getModello(), PDO::PARAM_STR);
        $sth->bindValue(':tipologia', $periferica->getTipologia(), PDO::PARAM_STR);        
        $sth->execute();
        
        if (isset($periferica->note)) {
            $this->updateNote($periferica->getId_catalogo(), $periferica->getNote());
        }
        if (isset($periferica->url)) {
            $this->updateUrl($periferica->getId_catalogo(), $periferica->getUrl());
        }
        if (isset($periferica->tag)) {
            $this->updateTag($periferica->getId_catalogo(), $periferica->getTag());
        }
    }

    // UPDATE
    public function updateModello(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE periferica SET MODELLO = :input WHERE ID_CATALOGO = :id_catalogo ;";
        parent::executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateTipologia(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE periferica SET TIPOLOGIA = :input WHERE ID_CATALOGO = :id_catalogo ;";
        parent::executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateNote(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE periferica SET NOTE = :input WHERE ID_CATALOGO = :id_catalogo ;";
        parent::executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateUrl(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE periferica SET URL = :input WHERE ID_CATALOGO = :id_catalogo ;";
        parent::executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateTag(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE periferica SET TAG = :input WHERE ID_CATALOGO = :id_catalogo ;";
        parent::executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }

    // DELETE
    public function deleteFromPeriferica(string $idCatalogo){
        $sqlInstruction = "DELETE FROM periferica WHERE ID_CATALOGO = :id_catalogo ;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':id_catalogo', $idCatalogo, PDO::PARAM_STR);
        $sth->execute();
    } 

}