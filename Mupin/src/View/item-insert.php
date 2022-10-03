<?php
declare(strict_types=1);

if(( ! isset($_SESSION["logged"] )) || ( $_SESSION["logged"] == false )){
    http_response_code(401);
    die();
}

$this->layout('layout-private', ['title' => 'Inserimento']);


$reflect = new ReflectionClass($model);
$properties = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);

echo "<h3 class='home-layout-center'>Inserimento " . ucfirst($tabella) . "</h3>";
echo "<form action='../../insert/" . $tabella . "' method='POST' enctype='multipart/form-data' id='form-insert'>";
echo "<table>";
foreach($properties as $property){
    $propertyName = $property->getName();
    echo "<tr><td class='descrittori-tabella' >". str_replace("_", " ", ucfirst($propertyName)) . "</td>";     
    echo "<td><input type='text' name='". str_replace("_", "-", $propertyName) ."'></td>";   
}
?>

<tr>
    <td><label for="img">Add image:</label></td>
    <td><input type="file" id="img" name="img" accept="image/*"></td>
</tr>

</table>
<div class="home-layout-center">
    <button type='submit' class='btn btn-primary'>Inserisci</button></form>
    <button type='button' class='btn btn-danger'><a href='../../'>Annulla</a></button>
</div>


