<?php
declare (strict_types=1);
namespace Mupin\Repository;
require 'vendor/autoload.php';

use PDO;
use Mupin\Models\Libro;
class LibroRepository{
    public PDO $pdo;
    public function __construct(){
        $config = include 'config.php';
        $this -> pdo = new PDO($config['dsn'], $config['username'], $config['password']);
        $this->pdo->setAttribute (PDO::ATTR_STRINGIFY_FETCHES, false);
        $this->pdo->setAttribute (PDO::ATTR_EMULATE_PREPARES, false);
    }

    // SELECT
    public function selectFromLibro(string $input) : array{
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM libro WHERE TITOLO LIKE :input0 ";         
        $sqlInstruction .= "OR AUTORI LIKE :input1 ";
        $sqlInstruction .= "OR CASA_EDITRICE LIKE :input2 ";
        $sqlInstruction .= "OR ANNO LIKE :input3 ";        
        $sqlInstruction .= "OR NUM_PAGINE LIKE :input4 ";        
        $sqlInstruction .= "OR ISBN LIKE :input5 ";        
        $sqlInstruction .= "OR NOTE LIKE :input6 ";
        $sqlInstruction .= "OR URL LIKE :input7 ";
        $sqlInstruction .= "OR TAG LIKE :input8 ;";
        
        $sth = $this -> pdo -> prepare($sqlInstruction);
        $sth -> bindValue(':input0', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input1', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input2', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input3', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input4', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input5', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input6', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input7', $input, PDO::PARAM_STR);
        $sth -> bindValue(':input8', $input, PDO::PARAM_STR);        
        $sth -> execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectByTitolo(string $input){
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM libro WHERE TITOLO LIKE :input ;";
        $sth = $this -> pdo -> prepare($sqlInstruction);
        $sth -> bindValue(':input', $input, PDO::PARAM_STR);
        $sth -> execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectByAutore(string $input){
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM libro WHERE AUTORI LIKE :input ;";
        $sth = $this -> pdo -> prepare($sqlInstruction);
        $sth -> bindValue(':input', $input, PDO::PARAM_STR);
        $sth -> execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectByAnno(int $input){        
        $sqlInstruction = "SELECT * FROM libro WHERE ANNO = :input ;";
        $sth = $this -> pdo -> prepare($sqlInstruction);
        $sth -> bindValue(':input', $input, PDO::PARAM_STR);
        $sth -> execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectByCasaEditrice(string $input){
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM libro WHERE CASA_EDITRICE LIKE :input ;";
        $sth = $this -> pdo -> prepare($sqlInstruction);
        $sth -> bindValue(':input', $input, PDO::PARAM_STR);
        $sth -> execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectByNote(string $input){
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM libro WHERE NOTE LIKE :input ;";
        $sth = $this -> pdo -> prepare($sqlInstruction);
        $sth -> bindValue(':input', $input, PDO::PARAM_STR);
        $sth -> execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectByTag(string $input){
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM libro WHERE TAG LIKE :input ;";
        $sth = $this -> pdo -> prepare($sqlInstruction);
        $sth -> bindValue(':input', $input, PDO::PARAM_STR);
        $sth -> execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    // INSERT
    public function insertIntoComputer(Libro $libro)
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
            $sqlInstruction = "UPDATE libro SET NUM_PAGINE = :num_pagine WHERE ID_CATALOGO = :id_catalogo ;";
            $sth = $this->pdo->prepare($sqlInstruction);
            $sth->bindValue(':num_pagine', $libro->getNumPagine(), PDO::PARAM_STR);
            $sth->bindValue(':id_catalogo', $libro->getIdCatalogo(), PDO::PARAM_STR);
            $sth->execute();
        }
        if (isset($libro->isbn)) {
            $sqlInstruction = "UPDATE libro SET ISBN = :isbn WHERE ID_CATALOGO = :id_catalogo ;";
            $sth = $this->pdo->prepare($sqlInstruction);
            $sth->bindValue(':isbn', $libro->getIsbn(), PDO::PARAM_STR);
            $sth->bindValue(':id_catalogo', $libro->getIdCatalogo(), PDO::PARAM_STR);
            $sth->execute();
        }
        if (isset($libro->note)) {
            $sqlInstruction = "UPDATE libro SET NOTE = :note WHERE ID_CATALOGO = :id_catalogo ;";
            $sth = $this->pdo->prepare($sqlInstruction);
            $sth->bindValue(':note', $libro->getNote(), PDO::PARAM_STR);
            $sth->bindValue(':id_catalogo', $libro->getIdCatalogo(), PDO::PARAM_STR);
            $sth->execute();
        }
        if (isset($libro->url)) {
            $sqlInstruction = "UPDATE libro SET URL = :url WHERE ID_CATALOGO = :id_catalogo ;";
            $sth = $this->pdo->prepare($sqlInstruction);
            $sth->bindValue(':url', $libro->getUrl(), PDO::PARAM_STR);
            $sth->bindValue(':id_catalogo', $libro->getIdCatalogo(), PDO::PARAM_STR);
            $sth->execute();
        }
        if (isset($libro->tag)) {
            $sqlInstruction = "UPDATE libro SET TAG = :tag WHERE ID_CATALOGO = :id_catalogo ;";
            $sth = $this->pdo->prepare($sqlInstruction);
            $sth->bindValue(':tag', $libro->getTag(), PDO::PARAM_STR);
            $sth->bindValue(':id_catalogo', $libro->getIdCatalogo(), PDO::PARAM_STR);
            $sth->execute();
        }
    }
}