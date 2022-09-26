<?php
use App\Models\Computer;

$this->layout('layout-public', ['title' => 'Item']);


$pc = new Computer();
$pc = $computer_array[0];

?>
<h1><?=strtoupper($pc->getModello())?></h1>
<table>
    <form action="modifica/computer/<?=$pc->getIdCatalogo()?>" method="POST">

        <?php
echo "<tr><td>Id catalogo: </td><td>" . $pc->getIdCatalogo() . "</td><td><input type='text' name='id-catalogo'></td></tr>";
echo "<tr><td>Modello: </td><td>" . $pc->getModello() . "</td><td><input type='text' name='modello'></td></tr>";
echo "<tr><td>Anno: </td><td>" . $pc->getAnno() . "</td><td><input type='text' name='anno'></td></tr>";
echo "<tr><td>Cpu: </td><td>" . $pc->getCpu() . "</td><td><input type='text' name='cpu'></td></tr>";
echo "<tr><td>Velocità cpu: </td><td>" . $pc->getVelocitaCpu() . "</td><td><input type='text' name='velocita-cpu'></td></tr>";
echo "<tr><td>Memoria RAM: </td><td>" . $pc->getMemoriaRam() . "</td><td><input type='text' name='memoria-ram'></td></tr>";

echo "<tr><td>Dimensione dell'hard disk: </td>";
if (isset($pc->dimensione_hard_disk)) {
    echo "<td>" . $pc->getDimensioneHardDisk() . "</td>";
} else {
    echo "<td></td>";
}
echo "<td><input type='text' name='dimensione-hard-disk'></td></tr>";

echo "<tr><td>Sistema operativo: </td>";
if (isset($pc->sistema_operativo)) {
    echo "<td>" . $pc->getSistemaOperativo() . "</td>";
} else {
    echo "<td></td>";
}
echo "<td><input type='text' name='sistema-operativo'></td></tr>";

echo "<tr><td>Note: </td>";
if (isset($pc->note)) {
    echo "<td>" . $pc->getNote() . "</td>";
} else {
    echo "<td></td>";
}
echo "<td><input type='text' name='note'></td></tr>";

echo "<tr><td>Approfondimenti: </td>";
if (isset($pc->url)) {
    echo "<td>" . $pc->getUrl() . "</td>";
} else {
    echo "<td></td>";
}
echo "<td><input type='text' name='url'></td></tr>";

echo "<tr><td>Tag: </td>";
if (isset($pc->tag)) {
    echo "<td>" . $pc->getTag() . "</td>";
} else {
    echo "<td></td>";
}
echo "<td><input type='text' name='tag'></td></tr>";

?>

</table>
<button type="submit">Modifica</button>
</form>