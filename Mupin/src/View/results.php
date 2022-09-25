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

                echo '<tr onclick="funz('.$string.')">\n<td>' . $i . '</td>\n<td>' . ucfirst($key) . '</td>\n';

                if (property_exists($model, "modello")) {
                    echo "<td class='titolo'>" . $model->getModello() . "</td>\n";
                }
                if (property_exists($model, "titolo")) {
                    echo "<td class='titolo'>" . $model->getTitolo() . "</td>\n";
                }
                $i += 1;
            }
            echo "</tr>";
            
        }
        ?> 
    </tbody>
</table>
<button type="submit">Go</button>
</form>


