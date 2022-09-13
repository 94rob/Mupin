<?php
declare (strict_types=1);
namespace Mupin;
require 'vendor/autoload.php';
use Mupin\Service\ComputerService;
use Mupin\Service\LibroService;
use Mupin\Service\PerifericaService;
use Mupin\Service\SoftwareService;
use Mupin\Service\RivistaService;

use Mupin\Models\Computer;
use Mupin\Repository\ComputerRepository;

// prove di select

$input = $_POST["input"];
switch($_POST["where"]){
    case "computer":
        $computerService = new ComputerService();
        $result = $computerService->selectByAll($input);
        break;
    case "periferica":
        $perifericaService = new PerifericaService();
        $result = $perifericaService->selectByAll($input);
        break;
    case "libro":
        $libroService = new LibroService();
        $result = $libroService->selectByAll($input);
        break;
    case "rivista":
        $rivistaService = new RivistaService();
        $result = $rivistaService->selectByAll($input);
        break;
    case "software":
        $softwareService = new SoftwareService();
        $result = $softwareService->selectByAll($input);
        break;
}

echo "<table>";
foreach($result as $item){
    echo "<tr>";
    foreach($item as $element){
        echo "<td  style='border:1px solid black'>" . strval($element) . "</td>";
    }
    echo "</tr>";
}
echo "</table>";

// prove di insert

$pcRepo = new ComputerRepository();
$pcService = new ComputerService();

$pc = [
    "ID_CATALOGO" => "123hfgdtnalskkkkkfir",
    "MODELLO" => "HP Computer",
    "ANNO" => 2011,
    "CPU" => "Intel Core i7",
    "VELOCITA_CPU" => 2.5,
    "MEMORIA_RAM" => 256
];

$computer = $pcService->fromArrayToComputer($pc);

var_dump($computer);

$pcRepo->insertIntoComputer($computer);

?>
<br/><br/><br/>
<form action="index.html" method="GET">
    <button>Back</button>
</form>