<?php
declare(strict_types=1);
session_start();

if(( ! isset($_SESSION["logged"] )) || ( $_SESSION["logged"] == false )){
    http_response_code(401);
    die();
}

$this->layout('layout-private', ['title' => 'Inserimento']);



$reflect = new ReflectionClass($model);
$properties = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);

echo "<h3 class='home-layout-center'>Inserimento " . ucfirst($tabella) . "</h3>";
echo "<form action='../../insert/" . $tabella . "' method='POST' id='form-insert'>";
echo "<table>";
foreach($properties as $property){
    $propertyName = $property->getName();
    echo "<tr><td class='descrittori-tabella' >". str_replace("_", " ", ucfirst($propertyName)) . "</td>";     
    echo "<td><input type='text' name='". str_replace("_", "-", $propertyName) ."'></td>";   
}
?>
</table>
<div class="home-layout-center">
    <button type='submit' class='btn btn-primary'>Inserisci</button></form>
    <button type='button' class='btn btn-danger'><a href='../../'>Annulla</a></button>
</div>


