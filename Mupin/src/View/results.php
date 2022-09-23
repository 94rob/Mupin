<?php
$this->layout('layout-public', ['title' => 'Ricerca']);
?>


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

                echo "<tr><td>" . $i . "</td>" . "<td>" . ucfirst($key) . "</td>";

                if (property_exists($model, "modello")) {
                    echo "<td class='titolo'>" . $model->getModello() . "</td>";
                }
                if (property_exists($model, "titolo")) {
                    echo "<td class='titolo'>" . $model->getTitolo() . "</td>";
                }
                $i += 1;
            }
            echo "</tr>";
            
        }
        ?> 
    </tbody>
</table>

