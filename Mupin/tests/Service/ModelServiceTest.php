<?php
declare (strict_types=1);
namespace App\Test\Service;

use PHPUnit\Framework\TestCase;
use App\Service\ModelService;
use App\Models\Computer;
use App\Models\Libro;

class ModelServiceTest extends TestCase{

    protected ModelService $modelService;

    public function setUp(): void
    {
        $this->modelService= new ModelService();
    }

    public function testFromArrayToModelReturnsModel(){

        $array = ["ID_CATALOGO" => "AS-HSJGF",
        "MODELLO" => "Asus",
         "ANNO" => 2011, 
         "VELOCITA_CPU" => 2.5,
          "MEMORIA_RAM" => 8, 
          "DIMENSIONE_HARD_DISK" => 512,
           "SISTEMA_OPERATIVO" => "Windows"];

        $pc = $this->modelService->fromArrayToModel($array, "computer");
        $this->assertInstanceOf(Computer::class, $pc);
    }

    public function testObjectCreatedByFromArrayToModelsNotEmpty(){
        $array = ["ID_CATALOGO" => "AS-HSJGF",
        "MODELLO" => "Asus",
         "ANNO" => "2011", 
         "VELOCITA_CPU" => "2.5",
          "MEMORIA_RAM" => "8", 
          "DIMENSIONE_HARD_DISK" => "512",
           "SISTEMA_OPERATIVO" => "Windows"];

        $pc = $this->modelService->fromArrayToModel($array, "computer");
        $id = $pc->getIdCatalogo();
        $hd = $pc->getDimensioneHardDisk();
        $this->assertEquals("AS-HSJGF", $id);
        $this->assertEquals(512, $hd);
    }

    public function testIsbnAndNoteNotEmptyInFromArrayToModel(){
        $arr["ISBN"] = "Prova";
        $arr["NOTE"] = "Prova";
        $libro = $this->modelService->fromArrayToModel($arr, "libro");
        $this->assertInstanceOf(Libro::class, $libro);
        $this->assertEquals("Prova", $libro->getIsbn());
        $this->assertEquals("Prova", $libro->getNote());
    }

    public function testPushInArrayIfNew(){
        $array = [1, 2, 3, 4, 5];
        $newArray = [3, 4, 5, 6, 7];
        $expected = [1, 2, 3, 4, 5, 6, 7];
        $actual = $this->modelService->pushInArrayIfNew($array, $newArray);
        $this->assertSameSize($expected, $actual);
        $this->assertIsArray($actual);
    }

    public function testFromArrayToModelArray(){
        $array = [[], [], []];
        $modelArray = $this->modelService->fromArrayToModelArray($array, "libro");
        $this->assertInstanceOf(Libro::class, $modelArray[0]);
        $this->assertContainsOnlyInstancesOf(Libro::class, $modelArray);
    }
}
