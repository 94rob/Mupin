<?php

session_start();
if(( ! isset($_SESSION["logged"] )) || ( $_SESSION["logged"] == false )){
    http_response_code(401);
    die();
}

$this->layout('layout-private', ['title' => 'Modifica']);


$className = get_class($object);

$reflect = new ReflectionClass($object);
$properties = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);

echo "<h3 class='home-layout-center'>" . $properties[1]->getValue($object) . "</h3>";
echo "<form action='" . $object->getIdCatalogo() ."' method='POST' id='form-insert'>";
echo "<table>";
foreach($properties as $property){
    $propertyName = $property->getName();
    echo "<tr><td class='descrittori-tabella-update'>". str_replace("_", " ", ucfirst($propertyName)) . "</td>";
    echo isset($object->$propertyName) ? "<td class='td-valori-update'>" . $property->getValue($object) . "</td>" : "<td></td>"; 
    echo "<td><input class='textbox-tabella-update' type='text' name='". str_replace("_", " ", $propertyName) ."'></td>";   
}
?>
</table>

<div class="home-layout-center">
    <button class='btn btn-primary'>Modifica</button></form>
    <button type='button' class='btn btn-danger'><a href='../../'>Annulla</a></button>
</div>
