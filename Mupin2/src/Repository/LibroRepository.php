<?php
declare (strict_types=1);
namespace Mupin\Repository;
require 'vendor/autoload.php';

use PDO;
use Mupin\Models\Libro;
class LibroRepository{
    public PDO $pdo;
    public RepositoryUtils $repositoryUtils;
    public function __construct(){
        $config = include 'config.php';
        $this -> pdo = new PDO($config['dsn'], $config['username'], $config['password']);
        $this->pdo->setAttribute (PDO::ATTR_STRINGIFY_FETCHES, false);
        $this->pdo->setAttribute (PDO::ATTR_EMULATE_PREPARES, false);
        $this->repositoryUtils = new RepositoryUtils();
    }

    // SELECT
    public function selectAll(): array{
        $sqlInstruction = "SELECT * FROM libro;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectByTitolo(string $input){
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM libro WHERE TITOLO LIKE :input ;";
        return $this->repositoryUtils->executeSelectString($input, $sqlInstruction, $this->pdo);
    }
    public function selectByAutore(string $input){
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM libro WHERE AUTORI LIKE :input ;";
        return $this->repositoryUtils->executeSelectString($input, $sqlInstruction, $this->pdo);
    }
    public function selectByAnno(int $input){        
        $sqlInstruction = "SELECT * FROM libro WHERE ANNO = :input ;";
        return $this->repositoryUtils->executeSelectInt($input, $sqlInstruction, $this->pdo);
    }
    public function selectByCasaEditrice(string $input){
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM libro WHERE CASA_EDITRICE LIKE :input ;";
        return $this->repositoryUtils->executeSelectString($input, $sqlInstruction, $this->pdo);
    }
    public function selectByNote(string $input){
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM libro WHERE NOTE LIKE :input ;";
        return $this->repositoryUtils->executeSelectString($input, $sqlInstruction, $this->pdo);
    }
    public function selectByTag(string $input){
        $input ='%' . $input . '%';
        $sqlInstruction = "SELECT * FROM libro WHERE TAG LIKE :input ;";
        return $this->repositoryUtils->executeSelectString($input, $sqlInstruction, $this->pdo);
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
            $this->updateNumPagine($libro->getIdCatalogo(), $libro->getNumPagine());
        }
        if (isset($libro->isbn)) {
            $this->updateIsbn($libro->getIdCatalogo(), $libro->getIsbn());
        }
        if (isset($libro->note)) {
            $this->updateNote($libro->getIdCatalogo(), $libro->getNote());
        }
        if (isset($libro->url)) {
            $this->updateUrl($libro->getIdCatalogo(), $libro->getUrl());
        }
        if (isset($libro->tag)) {
            $this->updateTag($libro->getIdCatalogo(), $libro->getTag());
        }
    }

    // UPDATE
    public function updateTitolo(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE libro SET TITOLO = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->repositoryUtils->executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateAutori(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE libro SET AUTORI = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->repositoryUtils->executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateCasaEditrice(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE libro SET CASA_EDITRICE = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->repositoryUtils->executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateAnno(string $idCatalogo, int $input)
    {
        $sqlInstruction = "UPDATE libro SET ANNO = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->repositoryUtils->executeUpdateInt($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateNumPagine(string $idCatalogo, int $input)
    {
        $sqlInstruction = "UPDATE libro SET NUM_PAGINE = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->repositoryUtils->executeUpdateInt($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateIsbn(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE libro SET ISBN = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->repositoryUtils->executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateNote(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE libro SET NOTE = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->repositoryUtils->executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateUrl(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE libro SET URL = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->repositoryUtils->executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }
    public function updateTag(string $idCatalogo, string $input)
    {
        $sqlInstruction = "UPDATE libro SET TAG = :input WHERE ID_CATALOGO = :id_catalogo ;";
        $this->repositoryUtils->executeUpdateString($input, $idCatalogo, $sqlInstruction, $this->pdo);
    }

    // DELETE
    public function deleteFromLibro(string $idCatalogo){
        $sqlInstruction = "DELETE FROM libro WHERE ID_CATALOGO = :id_catalogo ;";
        $sth = $this->pdo->prepare($sqlInstruction);
        $sth->bindValue(':id_catalogo', $idCatalogo, PDO::PARAM_STR);
        $sth->execute();
    }    
}