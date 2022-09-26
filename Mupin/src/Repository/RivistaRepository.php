<?php

declare(strict_types=1);

namespace App\Repository;

require 'vendor/autoload.php';

use PDO;
use App\Models\Rivista;

class RivistaRepository extends RepositoryFather
{
    // SELECT    
    public function selectFromRivistaWhereWhateverLikeInput(string $input): array
    {
        $input = '%' . $input . '%';
        $arrProperties = ["TITOLO", "NUMERO_RIVISTA", "ANNO", "CASA_EDITRICE", "NOTE", "URL", "TAG"];
        $i = 0;
        $len = count($arrProperties);
        $sqlInstruction = "SELECT * FROM rivista WHERE ";
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
        $sqlInstruction = "SELECT * FROM rivista WHERE ". $column ." LIKE :input ;";
        return parent::executeSelectString($input, $sqlInstruction);
    } 

    // INSERT
    public function insertIntoRivista(Rivista $rivista)
    {
        $sqlInstruction = "INSERT INTO rivista (ID_CATALOGO, TITOLO, NUMERO_RIVISTA, ANNO, CASA_EDITRICE";
        $sqlInstruction .= ") VALUES ( :id_catalogo , :titolo , :numero_rivista, :anno, :casa_editrice );";

        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':id_catalogo', $rivista->getId_catalogo(), PDO::PARAM_STR);
        $sth->bindValue(':titolo', $rivista->getTitolo(), PDO::PARAM_STR);
        $sth->bindValue(':numero_rivista', $rivista->getNum_rivista(), PDO::PARAM_INT);
        $sth->bindValue(':anno', $rivista->getAnno(), PDO::PARAM_INT);
        $sth->bindValue(':casa_editrice', $rivista->getCasa_editrice(), PDO::PARAM_STR);
        $sth->execute();

        if (isset($rivista->note)) {
            $this->updateColumnByIdCatalogo("NOTE", $rivista->getId_catalogo(), $rivista->getNote());
        }
        if (isset($rivista->url)) {
            $this->updateColumnByIdCatalogo("URL", $rivista->getId_catalogo(), $rivista->getUrl());
        }
        if (isset($rivista->tag)) {
            $this->updateColumnByIdCatalogo("TAG", $rivista->getId_catalogo(), $rivista->getTag());
        }
    }

    // UPDATE
    public function updateColumnByIdCatalogo(string $column, string $idCatalogo, string $input){
        $sqlInstruction = "UPDATE rivista SET ". $column ." = :input WHERE ID_CATALOGO = :id_catalogo ;";
        parent::executeUpdateString($input, $idCatalogo, $sqlInstruction);
    }

    // DELETE
    public function deleteFromRivista(string $idCatalogo){
        $sqlInstruction = "DELETE FROM rivista WHERE ID_CATALOGO = :id_catalogo ;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':id_catalogo', $idCatalogo, PDO::PARAM_STR);
        $sth->execute();
    }    
}
