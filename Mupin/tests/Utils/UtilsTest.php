<?php
declare (strict_types=1);
namespace App\Utils;

use PHPUnit\Framework\TestCase;
use App\Utils\Utils;
use App\Models\Software;

class UtilsTest extends TestCase{

    protected Utils $utils;

    public function setUp(): void
    {
        $this->utils= new Utils();
    }

    public function getDataInput(): array{
        return [["ID_CATALOGO"], ["id-catalogo"], ["ID-Catalogo"], ["id-Catalogo"], ["id_Catalogo"]];
    }
   
    /**    
    * @dataProvider getDataInput    
    */
    public function testGetterBuilder(string $id){
        $method = $this->utils->getterBuilder($id);
        $this->assertEquals("getIdCatalogo", $method);
    }

    /**    
    * @dataProvider getDataInput    
    */
    public function testSetterBuilder($id){
        $setter = $this->utils->setterBuilder($id);
        $this->assertEquals("setIdCatalogo", $setter);
    }

    /**    
    * @dataProvider getDataInput    
    */
    public function testStringToCamelCaseFirstUppercase(string $string){
        $actual = $this->utils->stringToCamelCase($string, true);
        $expected = "IdCatalogo";
        $this->assertEquals($expected, $actual);
    }

    /**    
    * @dataProvider getDataInput    
    */
    public function testStringToCamelCaseFirstLowercase(string $string){
        $actual = $this->utils->stringToCamelCase($string, false);
        $expected = "idCatalogo";
        $this->assertEquals($expected, $actual);
    }

    /**    
    * @dataProvider getDataInput    
    */
    public function testStringToTableName(string $string){
        $actual = $this->utils->stringToColumnName($string);
        $expected = "ID_CATALOGO";
        $this->assertEquals($expected, $actual);
    }

    public function testGetColumnsByModelName(){
        $actual = $this->utils->getColumnsByModelName("periferica");
        $expected = ["ID_CATALOGO", "MODELLO", "TIPOLOGIA", "NOTE", "URL", "TAG"];
        $this->assertEquals($expected, $actual);
    }

    public function testGetObjectByModelName(){
        $item = $this->utils->getObjectByModelName("software");
        $this->assertInstanceOf(Software::class, $item);
    }

    public function testFromArrayToColumnArray(){
        $arr = ["id-catalogo" => '', "modello" => ''];
        $actual = $this->utils->fromArrayToColumnArray($arr);
        $expected = ["ID_CATALOGO" => '', "MODELLO" => ''];
        $this->assertEquals($expected, $actual);
    }
}