<?php
session_start();
if(( ! isset($_SESSION["logged"] )) || ( $_SESSION["logged"] == false )){

    $this->layout('layout-public', ['title' => 'Articolo']);

} else {

    $this->layout('layout-private', ['title' => 'Articolo']);

}

$className = get_class($object);

$reflect = new ReflectionClass($object);
$properties = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);

echo "<h3 class='home-layout-center'>" . $properties[1]->getValue($object) . "</h3>";
echo "<table>";
foreach($properties as $property){
    $propertyName = $property->getName();
    echo "<tr><td class='descrittori-tabella-update'>". str_replace("_", " ", ucfirst($propertyName)) . "</td>";
    echo isset($object->$propertyName) ? "<td>" . $property->getValue($object) . "</td>" : "<td></td>";
    echo "</tr>";    
}
echo "</table>";
?>
