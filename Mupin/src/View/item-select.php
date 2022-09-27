<?php

$this->layout('layout-public', ['title' => 'Item']);

$className = get_class($object);
$model = new ${"className"}();
$model = $object;

$reflect = new ReflectionClass($object);
$properties = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);

echo $className;
// var_dump($properties);
echo "<table>";
foreach($properties as $property){
    $propertyName = $property->getName();
    echo "<tr><td>". str_replace("_", " ", ucfirst($propertyName)) . "</td>";
    echo isset($model->$propertyName) ? "<td>" . $property->getValue($model) . "</td>" : "<td></td>";
    echo "</tr>";    
}
echo "</table>";
?>
