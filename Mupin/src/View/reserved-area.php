<?php

use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Html;

$this->layout('layout-private', [
    'title' => 'Area Riservata'
]);
?>

<form action="/search" method="POST">
    <div class="row justify-content-center">

        <div class="col-6">
            <h2>Seleziona una categoria</h2>

            <input type="radio" id="libro-checkbox" name="dove-cercare" value="libro">
            <label for="libro-checkbox">Libri</label>
            <input type="radio" id="rivista-checkbox" name="dove-cercare" value="rivista">
            <label for="rivista-checkbox">Riviste</label>
            <input type="radio" id="software-checkbox" name="dove-cercare" value="software">
            <label for="software-checkbox">Software</label>
            <input type="radio" id="periferica-checkbox" name="dove-cercare" value="periferica">
            <label for="periferica-checkbox">Periferiche</label>
            <input type="radio" id="computer-checkbox" name="dove-cercare" value="computer">
            <label for="computer-checkbox">Computer</label>

        </div>
        <div class="row justify-content-center">
            <div class="col4">
                <button class="btn-ricerca" type="submit">Cerca</button>
            </div>
        </div>
    </div>
</form>