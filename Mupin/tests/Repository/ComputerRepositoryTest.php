<?php
declare (strict_types=1);
namespace App\Test\Repository;

use PHPUnit\Framework\TestCase;
use App\Repository\ComputerRepository;
use PDO;
use PDOStatement;

class ComputerRepositoryTest extends TestCase{

    protected PDO $pdo;
    protected PDOStatement $sth;

    public function setUp(): void
    {
        $this->pdo = $this->createMock(PDO::class);
        $this->sth = $this->createMock(PDOStatement::class);
        
    }

    public function testSelectIdProduceRightQueryString(){
        $computerRepository = new ComputerRepository($this->pdo);

    }

}