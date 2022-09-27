<?php
session_start();
if(( ! isset($_SESSION["logged"] )) || ( $_SESSION["logged"] == false )){

    $this->layout('layout-public', ['title' => 'Home Page']);

} else {

    $this->layout('layout-private', ['title' => 'Home Page']);

}
?>

<form id="form-single-item" method="get">
    <table>
        <thead>
            <td>N°</td>
            <td>Tipologia</td>
            <td>Nome</td>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($result as $key => $value) {

                foreach ($value as $subkey => $model) {

                    echo '<tr ';
                    if(!array_key_exists("logged", $_SESSION)){
                        echo 'class="anchor-select-item" onclick="selectObject(&#39;' . $key . '&#39;, &#39;' .  $model->getIdCatalogo() . '&#39;)"';
                    }
                    echo '><td>' . $i . '</td><td>' . ucfirst($key) . '</td>';

                    if (property_exists($model, "modello")) {
                        echo "<td class='titolo'>" . $model->getModello() . "</td>";
                    }
                    if (property_exists($model, "titolo")) {
                        echo "<td class='titolo'>" . $model->getTitolo() . "</td>";
                    }
                    echo "</div>";
                    if(array_key_exists("logged", $_SESSION) && $_SESSION["logged"]==true){
                        echo '<td><button type="submit" class="btn btn-primary" onclick="updateObject(&#39;' . $key . '&#39;, &#39;' .  $model->getIdCatalogo() . '&#39;)">Modifica</button></td>';
                        echo '<td><button type="button" class="btn btn-danger" onclick="deleteObject(&#39;' . $key . '&#39;, &#39;' . $model->getIdCatalogo() . '&#39;)">Elimina</button></td>';
                    }
                    
                    $i += 1;
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</form>
<script>
    function selectObject(tabella, idCatalogo){
        document.getElementById("form-single-item").action = "../../search/" + tabella + "/" + idCatalogo;        
        document.getElementById("form-single-item").method = "GET";
        document.getElementById("form-single-item").submit();
    }

    function deleteObject(tabella,
        idCatalogo) {        
        document.getElementById("form-single-item").action = "../../delete/" + tabella + "/" + idCatalogo;        
        document.getElementById("form-single-item").method = "POST";
        document.getElementById("form-single-item").submit();
    }   

    function updateObject(tabella, idCatalogo) {
        document.getElementById("form-single-item").action = "../../modifica/" + tabella + "/" + idCatalogo;        
        document.getElementById("form-single-item").method = "GET";
        document.getElementById("form-single-item").submit();
    }
</script>
