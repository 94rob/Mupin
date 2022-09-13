<?php
declare(strict_types=1);
namespace Test\Service;

use Mupin\Models\Computer;
use Mupin\Service\ComputerService;
use PHPUnit\Framework\TestCase;

class ComputerServiceTest extends TestCase{

    public ComputerService $computerService;
    public function setUp(): void{
        parent::setUp();
        $this->computerService = new ComputerService();
    }
    // SELECT
    public function testSelectAll(){
        $this->assertIsArray($this->computerService->selectAll());
    }
    public function testSelectByModello(){
        $this->assertIsArray($this->computerService->selectByModello("pippo"));     
    }
    
    public function testSelectByAnno(){
        $this->assertIsArray($this->computerService->selectByAnno(1984)); 
    }
    public function testSelectBySistemaOperativo(){
        $this->assertIsArray($this->computerService->selectBySistemaOperativo("pippo")); 
    }
    public function testSelectByNote(){
        $this->assertIsArray($this->computerService->selectByNote("pippo")); 
    }
    public function testSelectByTag(){
        $this->assertIsArray($this->computerService->selectByTag("pippo")); 
    }

    // // INSERT
    // public function testInsertIntoComputer(array $array): void{
    //     $computerService = new ComputerService();

    // }

    // // UPDATE
    // public function testUpdateModello(string $idCatalogo, string $input){
    //     $computerService = new ComputerService();
    // }
    // public function testUpdateAnno(string $idCatalogo, int $input){
    //     $computerService = new ComputerService();
    // }
    // public function testUpdateCpu(string $idCatalogo, string $input){
    //     $computerService = new ComputerService();
    // }
    // public function testUpdateVelocitaCpu(string $idCatalogo, float $input){
    //     $computerService = new ComputerService();
    // }
    // public function testUpdateMemoriaRam(string $idCatalogo, int $input){
    //     $computerService = new ComputerService();
    // }
    // public function testUpdateDimensioneHardDisk(string $idCatalogo, int $input){
    //     $computerService = new ComputerService();
    // }
    // public function testUpdateSistemaOperativo(string $idCatalogo, string $input){
    //     $computerService = new ComputerService();
    // }
    // public function testUpdateNote(string $idCatalogo, string $input){
    //     $computerService = new ComputerService();
    // }
    // public function testUpdateUrl(string $idCatalogo, string $input){
    //     $computerService = new ComputerService();
    // }
    // public function testUpdateTag(string $idCatalogo, string $input){
    //     $computerService = new ComputerService();
    // }

    // // DELETE
    // public function testDeleteFromComputer(string $idCatalogo){
    //     $computerService = new ComputerService();
    // }
}