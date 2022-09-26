<?php
declare (strict_types=1);
namespace App\Repository;
require 'vendor/autoload.php';

use PDO;
use App\Models\Periferica;
class PerifericaRepository extends RepositoryFather{  

    // SELECT       
    public function selectFromPerifericaWhereWhateverLikeInput(string $input): array
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
    public function selectWhereColumnLikeInput(string $column, string $input){
        $input = '%' . $input . '%';
        $sqlInstruction = "SELECT * FROM periferica WHERE ". $column ." LIKE :input ;";
        return parent::executeSelectString($input, $sqlInstruction);
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
            $this->updateColumnByIdCatalogo("NOTE", $periferica->getId_catalogo(), $periferica->getNote());
        }
        if (isset($periferica->url)) {
            $this->updateColumnByIdCatalogo("URL", $periferica->getId_catalogo(), $periferica->getUrl());
        }
        if (isset($periferica->tag)) {
            $this->updateColumnByIdCatalogo("TAG", $periferica->getId_catalogo(), $periferica->getTag());
        }
    }

    // UPDATE
    public function updateColumnByIdCatalogo(string $column, string $idCatalogo, string $input){
        $sqlInstruction = "UPDATE periferica SET ". $column ." = :input WHERE ID_CATALOGO = :id_catalogo ;";
        parent::executeUpdateString($input, $idCatalogo, $sqlInstruction);
    }

    // DELETE
    public function deleteFromPeriferica(string $idCatalogo){
        $sqlInstruction = "DELETE FROM periferica WHERE ID_CATALOGO = :id_catalogo ;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':id_catalogo', $idCatalogo, PDO::PARAM_STR);
        $sth->execute();
    } 

}