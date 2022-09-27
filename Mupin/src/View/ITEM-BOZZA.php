<h1><?=strtoupper($model->getModello())?></h1>
<table>
    <form action="../modifica/computer/<?=$pc->getIdCatalogo()?>" method="POST">

        <?php
echo "<tr><td>Id catalogo: </td><td>" . $model->getIdCatalogo() . "</td><td><input type='text' name='id-catalogo'></td></tr>";
echo "<tr><td>Modello: </td><td>" . $model->getModello() . "</td><td><input type='text' name='modello'></td></tr>";
echo "<tr><td>Anno: </td><td>" . $model->getAnno() . "</td><td><input type='text' name='anno'></td></tr>";
echo "<tr><td>Cpu: </td><td>" . $model->getCpu() . "</td><td><input type='text' name='cpu'></td></tr>";
echo "<tr><td>Velocità cpu: </td><td>" . $model->getVelocitaCpu() . "</td><td><input type='text' name='velocita-cpu'></td></tr>";
echo "<tr><td>Memoria RAM: </td><td>" . $model->getMemoriaRam() . "</td><td><input type='text' name='memoria-ram'></td></tr>";

echo "<tr><td>Dimensione dell'hard disk: </td>";
if (isset($model->dimensione_hard_disk)) {
    echo "<td>" . $model->getDimensioneHardDisk() . "</td>";
} else {
    echo "<td></td>";
}
echo "<td><input type='text' name='dimensione-hard-disk'></td></tr>";

echo "<tr><td>Sistema operativo: </td>";
if (isset($model->sistema_operativo)) {
    echo "<td>" . $model->getSistemaOperativo() . "</td>";
} else {
    echo "<td></td>";
}
echo "<td><input type='text' name='sistema-operativo'></td></tr>";

echo "<tr><td>Note: </td>";
if (isset($model->note)) {
    echo "<td>" . $model->getNote() . "</td>";
} else {
    echo "<td></td>";
}
echo "<td><input type='text' name='note'></td></tr>";

echo "<tr><td>Approfondimenti: </td>";
if (isset($model->url)) {
    echo "<td>" . $model->getUrl() . "</td>";
} else {
    echo "<td></td>";
}
echo "<td><input type='text' name='url'></td></tr>";

echo "<tr><td>Tag: </td>";
if (isset($model->tag)) {
    echo "<td>" . $model->getTag() . "</td>";
} else {
    echo "<td></td>";
}
echo "<td><input type='text' name='tag'></td></tr>";

?>

</table>
<button type="submit">Modifica</button>
</form>