<?php
$this->layout('layout-public', ['title' => 'Home Page']);

session_start();
unset($_SESSION["logged"]);
?>

<div class="home-layout-center">

    <row class="justify-content-center">
        <div class="col-12 align-self-center title">
            <h1>Museo Piemontese dell'Informatica</h1>
            <h5>Clicca per selezionare una categoria ed effettuare una ricerca</h5>
        </div>
    </row>
</div>

<form action="./search" method="GET" id="main-form">
    <div class="container home-layout-center">
        <div class="row justify-content-between">
            <div class="col-2">
                <input type="radio" id="computer-checkbox" name="dove-cercare" value="computer">
                <label for="computer-checkbox">
                    <figure>
                        <img src="./img/computer.jpg" alt="Computer">
                        <figcaption>Computer</figcaption>
                    </figure>
                </label>
            </div>
            <div class="col-2">
                <input type="radio" id="periferica-checkbox" name="dove-cercare" value="periferica">
                <label for="periferica-checkbox">
                    <figure>
                        <img src="./img/tastiera.jpg" alt="Periferiche">
                        <figcaption>Periferiche</figcaption>
                    </figure>
                </label>
            </div>
            <div class="col-2">
                <input type="radio" id="software-checkbox" name="dove-cercare" value="software">
                <label for="software-checkbox">
                    <figure>
                        <img src="./img/software.jpg" alt="Software">
                        <figcaption>Software</figcaption>
                    </figure>
                </label>
            </div>
            <div class="col-2">
                <input type="radio" id="rivista-checkbox" name="dove-cercare" value="rivista">
                <label for="rivista-checkbox">
                    <figure>
                        <img src="./img/rivista.jpg" alt="Riviste">
                        <figcaption>Riviste</figcaption>
                    </figure>
                </label>
            </div>
            <div class="col-2">
                <input type="radio" id="libro-checkbox" name="dove-cercare" value="libro">
                <label for="libro-checkbox">
                    <figure>
                        <img src="./img/libro.jpg" alt="Libri">
                        <figcaption>Libri</figcaption>
                    </figure>
                </label>
            </div>
        </div>

        <div class="row justify-content-center">
            <input type="radio" id="ovunque-checkbox" name="dove-cercare" value="ovunque">
            <label for="ovunque-checkbox">Tutte le categorie</label>
        </div>

        <div class="row justify-content-center row-btn">
            <div class="col-4">

                <fieldset>
                    <div class="input-label"><label for="input">Inserisci una o più parole chiave</label></div>
                    <input class="textbox" type="text" id="input" name="cosa-cercare" autocomplete="off"><br />
                </fieldset>
            </div>
        </div>
    </div>

    <div class="container selettori-container">
        <div class="row justify-content-end">
            <div class="col div-selettore">

                <p onclick='show()'>Mostra/Nascondi filtri: </p>

            </div>

            <fieldset id="selettori">

                <div class="col div-selettore">
                    <input type="checkbox" class="form-check-input computer libro periferica rivista software"
                        id="modello-titolo-checkbox" name="selettori[1]" value="modello-titolo">
                    <label for="modello-titolo-checkbox"
                        class="form-check-label computer libro periferica rivista software">Modello/ Titolo</label>
                </div>
                <div class="col div-selettore">
                    <input type="checkbox" class="form-check-input libro" id="autore-checkbox" name="selettori[2]"
                        value="autore">
                    <label for="autore-checkbox" class="form-check-label libro">Autore</label>
                </div>
                <div class="col div-selettore">
                    <input type="checkbox" class="form-check-input computer libro periferica rivista software"
                        id="tag-checkbox" name="selettori[7]" value="tag">
                    <label for="tag-checkbox"
                        class="form-check-label computer libro periferica rivista software">Tag</label>
                </div>
                <div class="col div-selettore">
                    <input type="checkbox" class="form-check-input computer libro rivista" id="anno-checkbox"
                        name="selettori[3]" value="anno">
                    <label for="anno-checkbox" class="form-check-label computer libro rivista">Anno</label>
                </div>
                <div class="col div-selettore">
                    <input type="checkbox" class="form-check-input libro rivista" id="casa-editrice-checkbox"
                        name="selettori[4]" value="casa-editrice">
                    <label for="casa-editrice-checkbox" class="form-check-label libro rivista">Casa editrice</label>
                </div>
                <div class="col div-selettore">
                    <input type="checkbox" class="form-check-input computer software" id="sistema-operativo-checkbox"
                        name="selettori[5]" value="sistema-operativo">
                    <label for="sistema-operativo-checkbox" class="form-check-label computer software">Sistema
                        operativo</label>
                </div>
                <div class="col div-selettore">
                    <input type="checkbox" class="form-check-input computer libro periferica rivista software"
                        id="note-checkbox" name="selettori[6]" value="note">
                    <label for="note-checkbox"
                        class="form-check-label computer libro periferica rivista software">Note</label>
                </div>

        </div>
        </fieldset>
    </div>
    </div>

    <div class="home-layout-center">
        <div class="row justify-content-center">
            <div class="col4">
                <button class="btn-ricerca" onclick="setAction()">Cerca</button>

            </div>
        </div>
    </div>
</form>
<script>
function setAction() {
    var table = Array.from(
        document.querySelectorAll('input[name=dove-cercare]')
    ).filter(radio => radio.checked)[0]?.value;
    
    document.getElementById("main-form").action += "/" + table;
    document.getElementById("main-form").submit();
}

function show() {
    var x = document.getElementById("selettori");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
</script>