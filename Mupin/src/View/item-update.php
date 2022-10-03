<?php

session_start();
if ((!isset($_SESSION["logged"])) || ($_SESSION["logged"] == false)) {
    http_response_code(401);
    die();
}

$this->layout('layout-private', ['title' => 'Modifica']);


$className = get_class($object);

$reflect = new ReflectionClass($object);
$properties = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);

echo "<h3 class='home-layout-center'>" . $properties[1]->getValue($object) . "</h3>";
echo "<form action='" . $object->getIdCatalogo() . "' method='POST' enctype='multipart/form-data' id='form-insert'>";
echo "<table>";
foreach ($properties as $property) {
    $propertyName = $property->getName();
    echo "<tr><td class='descrittori-tabella-update'>" . str_replace("_", " ", ucfirst($propertyName)) . "</td>";
    echo isset($object->$propertyName) ? "<td class='td-valori-update'>" . $property->getValue($object) . "</td>" : "<td></td>";

    echo $propertyName == "id_catalogo" ? 
                            "<td></td>" 
                                : 
                            "<td><input class='textbox-tabella-update' type='text' name='" . str_replace("_", " ", $propertyName) . "'></td>";  
}

?>

<tr>
    <td><label for="img">Add image:</label></td>
    <td><input type="file" id="img" name="img" accept="image/*"></td>
</tr>

</table>

    <div class="home-layout-center">
        <button class='btn btn-primary'>Modifica</button>
        <button type='button' class='btn btn-danger'><a href='../../'>Annulla</a></button>
    </div>
</form>
<div class="row item-row">
    <!-- <form id="form-del-img" action="" method="POST"> -->
    
        <?php

        $imgArray = glob(__DIR__ . '/../../public/img/' . $object->getIdCatalogo() . "*");

        $i = 0;
        foreach ($imgArray as $img) {
            $i++;
            echo "<div class='col-3'><figure class='figure-item'>";
            echo '<img class="img-item" src="/img/' . basename($img) . '" alt="Immagine">';
            echo "</figure>";
            
            echo '<button type="button" id="btn-'. basename($img) .'" onclick="eliminaImg(&#39;' . $object->getIdCatalogo() .'&#39;,'; 
            echo '&#39;' . basename($img) .'&#39;)">Elimina</button>';
            echo '</div>';
        }

        ?>
        </form>
    </div>

<script>
    function eliminaImg(id, img){
        
        $.ajax({
            url: "/del/img/" + id, 
            type: "POST",
            data: {img : img},
            success: function(data){
                console.log(data);
                location.reload();
            }

        });
    }
</script>