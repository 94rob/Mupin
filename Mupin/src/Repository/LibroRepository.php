<?php
declare (strict_types=1);
namespace App\Repository;
require 'vendor/autoload.php';

use PDO;
use App\Models\Libro;
class LibroRepository extends RepositoryFather{  

    // SELECT   
    public function selectFromLibroWhereWhateverLikeInput(string $input): array
    {
        $input = '%' . $input . '%';
        $arrProperties = ["TITOLO", "AUTORI", "CASA_EDITRICE", "ANNO", "NUM_PAGINE", "ISBN", "NOTE", "URL", "TAG"];
        $i = 0;
        $len = count($arrProperties);
        $sqlInstruction = "SELECT * FROM libro WHERE ";
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
        $sqlInstruction = "SELECT * FROM libro WHERE ". $column ." LIKE :input ;";
        return parent::executeSelectString($input, $sqlInstruction);
    } 

    // INSERT
    public function insertIntoLibro(Libro $libro)
    {
        $sqlInstruction = "INSERT INTO libro (ID_CATALOGO, TITOLO, AUTORI, CASA_EDITRICE, ANNO";
        $sqlInstruction .= ") VALUES ( :id_catalogo , :titolo , :autori, :casa_editrice , :anno );";        

        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':id_catalogo', $libro->getIdCatalogo(), PDO::PARAM_STR);
        $sth->bindValue(':titolo', $libro->getTitolo(), PDO::PARAM_STR);
        $sth->bindValue(':autori', $libro->getAutori(), PDO::PARAM_STR);
        $sth->bindValue(':casa_editrice', $libro->getCasaEditrice(), PDO::PARAM_STR);
        $sth->bindValue(':anno', $libro->getAnno(), PDO::PARAM_INT);        
        $sth->execute();

        if (isset($libro->num_pagine)) {
            $this->updateColumnByIdCatalogo("NUM_PAGINE", $libro->getIdCatalogo(), (string)$libro->getNumPagine());
        }
        if (isset($libro->isbn)) {
            $this->updateColumnByIdCatalogo("ISBN", $libro->getIdCatalogo(), $libro->getIsbn());
        }
        if (isset($libro->note)) {
            $this->updateColumnByIdCatalogo("NOTE", $libro->getIdCatalogo(), $libro->getNote());
        }
        if (isset($libro->url)) {
            $this->updateColumnByIdCatalogo("URL", $libro->getIdCatalogo(), $libro->getUrl());
        }
        if (isset($libro->tag)) {
            $this->updateColumnByIdCatalogo("TAG", $libro->getIdCatalogo(), $libro->getTag());
        }
    }

    // UPDATE
    public function updateColumnByIdCatalogo(string $column, string $idCatalogo, string $input){
        $sqlInstruction = "UPDATE libro SET ". $column ." = :input WHERE ID_CATALOGO = :id_catalogo ;";
        parent::executeUpdateString($input, $idCatalogo, $sqlInstruction);
    } 

    // DELETE
    public function deleteFromLibro(string $idCatalogo){
        $sqlInstruction = "DELETE FROM libro WHERE ID_CATALOGO = :id_catalogo ;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':id_catalogo', $idCatalogo, PDO::PARAM_STR);
        $sth->execute();
    }    
}