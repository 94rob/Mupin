<?php
$this->layout('head-display', ['title' => 'Ricerca']);
?>

<html>
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
            }
            echo "</tr>";
            $i += 1;
        }
        ?> 
    </tbody>
</table>

</html>