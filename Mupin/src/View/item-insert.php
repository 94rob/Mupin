<?php
use App\Models\Computer;
use App\Models\Periferica;
use App\Models\Software;
use App\Models\Rivista;
use App\Models\Libro;

$this->layout('layout-public', ['title' => 'Inserimento']);

$className = "App\Models\\" . ucfirst($tabella);
$model = new ${"className"}();

$reflect = new ReflectionClass($object);
$properties = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);

echo "<form action='../../insert/" . $tabella . "' method='POST' id='form-insert'>";
echo "<table>";
foreach($properties as $property){
    $propertyName = $property->getName();
    echo "<tr><td>". str_replace("_", " ", ucfirst($propertyName)) . "</td>";     
    echo "<td><input type='text' name='". str_replace("_", "-", $propertyName) ."'></td>";   
}
echo "</table>";
echo "<button type='submit' class='btn btn-primary'>Inserisci</button></form>";
?>