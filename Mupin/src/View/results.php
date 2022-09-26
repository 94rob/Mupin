<?php
$this->layout('layout-public', ['title' => 'Ricerca']);
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
        foreach ($req as $key => $value) {

            foreach ($value as $subkey => $model) {
                $string = "'".$model->getIdCatalogo()."'";

                echo '<tr onclick="funz('.$string.')"><td>' . $i . '</td><td>' . ucfirst($key) . '</td>';

                if (property_exists($model, "modello")) {
                    echo "<td class='titolo'>" . $model->getModello() . "</td>";
                }
                if (property_exists($model, "titolo")) {
                    echo "<td class='titolo'>" . $model->getTitolo() . "</td>";
                }
                
                $i += 1;
            }
            echo "</tr>";
            echo "<button onclick='deleteObject(". $key .", ".$model->getIdCatalogo() .")'>Cancella ".$model->getIdCatalogo()." </button>";
            
        }
        ?> 
    </tbody>
</table>
</form>


