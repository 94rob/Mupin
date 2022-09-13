<?php
declare(strict_types=1);
namespace Mupin\Repository;

use PHPUnit\Framework\TestCase;
use Mupin\Repository\ComputerRepository;
use Mupin\Models\Computer;
use Mupin\Service\ComputerService;

class ComputerRepositoryTest extends TestCase{
    public Computer $computer;
    public ComputerService $computerService;
    public ComputerRepository $computerRepository;
    public $pdo;
    public $sth;

    public function setUp(): void{
        $this->computer = new Computer();
        $this->computerRepository = new ComputerRepository();
        $this->computerService = new ComputerService();
        $this->pdo = $this->createMock(PDO::class);
        $this->sth = $this->createMock(PDOStatement::class);
        $this->pdo->method('prepare')->willReturn($this->sth);
        $this->sth->method('execute')->willReturn(true);        
    }
    
    public function testIstantiatesPropertiesProperly(){
        $this->assertNotEmpty($this->computerRepository->pdo);
        $this->assertNotEmpty($this->computerRepository->repositoryUtils);
    }

public function testSelectAllReturnsAnArray(){
    $this->assertIsArray($this->computerRepository->selectAll());
}

public function testSelectByModelloReturnsAnArray(){
    $this->assertIsArray($this->computerRepository->selectByModello("input"));
}


}