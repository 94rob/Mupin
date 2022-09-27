<?php

declare(strict_types=1);

if ((!isset($_SESSION["logged"])) || ($_SESSION["logged"] == false)) {
    http_response_code(401);
    die();
}

$this->layout('layout-private', ['title' => 'Area Riservata']);
?>

<form action="" method="" id="form-private">
    <div class="container bozza">
        <div class="row bozza align-items-center row-label">
            <h3 class="titolo-area-riservata">Modifica o elimina un articolo esistente</h3>
        </div>
        <div class="row bozza align-items-end row-input">

            <div class="col-4 bozza">
                <label for="search-select">Che tipo di articolo cerchi?</label>
                <select class="form-select" name="dove-cercare" id="search-select">
                    <option value="ovunque" selected>Qualsiasi</option>
                    <option value="computer">Computer</option>
                    <option value="libro">Libri</option>
                    <option value="periferica">Periferiche</option>
                    <option value="software">Software</option>
                    <option value="rivista">Riviste</option>
                </select>
            </div>
            <div class="col-4 bozza">
                <label for="input-txt">Se vuoi, inserisci una parola chiave</label>
                <input type="text" class="textbox" id="input-txt" name="cosa-cercare">
            </div>
            <div class="col-4 bozza">
                <button type="button" class="btn btn-info btn-area-riservata" onclick="cerca()">Cerca</button>
            </div>
        </div>

        <div class="row bozza align-items-center row-label">
            <h3 class="titolo-area-riservata">Inserisci un nuovo articolo</h3>
        </div>
        <div class="row bozza align-items-end row-input">
            
            <div class="col-4 bozza">
                <label for="insert-select">Che tipo di articolo vuoi inserire?</label>
                <select class="form-select" name="dove-cercare" id="insert-select">
                    <option value="computer" selected>Computer</option>
                    <option value="libro">Libri</option>
                    <option value="periferica">Periferiche</option>
                    <option value="software">Software</option>
                    <option value="rivista">Riviste</option>
                </select>
            </div>
            <div class="col-4 bozza">
                <button type="button" class="btn btn-info btn-area-riservata" onclick="inserisci()">Inserisci</button>
            </div>
        </div>

    </div>
</form>


<script>
    function inserisci() {
        tabella = document.getElementById("insert-select").value;
        document.getElementById("form-private").action = "/insert/" + tabella;
        document.getElementById("form-private").method = "GET";
        document.getElementById("form-private").submit();
    }

    function cerca() {
        tabella = document.getElementById("search-select").value;
        document.getElementById("form-private").action = "/search/" + tabella;
        document.getElementById("form-private").method = "GET";
        document.getElementById("form-private").submit();
    }
</script>