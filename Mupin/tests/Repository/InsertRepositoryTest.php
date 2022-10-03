<?php
declare (strict_types=1);
namespace App\Test\Repository;

use PHPUnit\Framework\TestCase;
use PDO;
use App\Repository\InsertRepository;
use PDOStatement;
use App\Models\Libro;

class InsertRepositoryTest extends TestCase{

    protected InsertRepository $insertRepo;
    protected PDO $pdo;
    protected PDOStatement $sth;
    protected Libro $libro;

    public function setUp(): void
    {
        $this->pdo = $this->createMock(PDO::class);
        $this->sth = $this->createMock(PDOStatement::class);
        // $this->pdo->method('prepare')->willReturn($this->sth);       
        // $this->sth->method('execute')->willReturn(true);
        $this->insertRepo = new InsertRepository($this->pdo);

        $this->libro = new Libro();
        $this->libro->setTitolo("Prova");
        $this->libro->setAutori("Prova");
        $this->libro->setCasaEditrice("Prova");
        $this->libro->setAnno(2011);
        $this->libro->setNumeroPagine(123);
    }

    public function testInsertQueryBuilder(){
        $columns = ["ID_CATALOGO","TITOLO","AUTORI", "CASA_EDITRICE", "ANNO", 
        "NUMERO_PAGINE", "ISBN", "NOTE", "URL", "TAG"];
        $query = $this->insertRepo->insertQueryBuilder($this->libro, "libro", $columns);
        $expected = "INSERT INTO libro (TITOLO,AUTORI,";
        $expected .= "CASA_EDITRICE,ANNO,NUMERO_PAGINE) VALUES (";
        $expected .= ":titolo,:autori,:casa_editrice,:anno,:numero_pagine);";

        $this->assertEquals($expected, $query);
    }
}