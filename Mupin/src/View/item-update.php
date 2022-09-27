<?php
use App\Models\Computer;
use App\Models\Periferica;
use App\Models\Software;
use App\Models\Rivista;
use App\Models\Libro;

$this->layout('layout-public', ['title' => 'Item']);

$className = get_class($object);
$model = new ${"className"}();
$model = $object;

$reflect = new ReflectionClass($object);
$properties = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);

echo "<h3>" . $properties[0]->getValue($model) . "</h3>";
echo "<form action='" . $model->getIdCatalogo() ."' method='POST' id='form-insert'>";
echo "<table>";
foreach($properties as $property){
    $propertyName = $property->getName();
    echo "<tr><td>". str_replace("_", " ", ucfirst($propertyName)) . "</td>";
    echo isset($model->$propertyName) ? "<td>" . $property->getValue($model) . "</td>" : "<td></td>"; 
    echo "<td><input type='text' name='". str_replace("_", " ", $propertyName) ."'></td>";   
}
echo "</table>";
echo "<button class='btn btn-primary'>Modifica</button></form>";
?>