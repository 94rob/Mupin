<?php
$this->layout('layout-public', ['title' => 'Home Page']);
?>

<div class="container">
    <row class="justify-content-center">
        <div class="col-12 align-self-center title">
            <h1>Esplora il museo</h1>
            <h5>Seleziona una categoria</h5>
        </div>
    </row>

    <form action="./search" method="post">
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

        <div class="row justify-content-center row-btn">
            <div class="col-4">
                <fieldset>
                    <div class="input-label"><label for="input">Inserisci una o più parole chiave</label></div>
                    <input class="textbox" type="text" id="input" name="input" autocomplete="off"><br />
                </fieldset>
            </div>
        </div>

        <div class="row justify-content-center">
            <fieldset class="selettori">
                <input type="checkbox" class="computer libro periferica rivista software" id="modello-titolo-checkbox" name="selettori[1]" value="modello-titolo">
                <label for="modello-titolo-checkbox" class="computer libro periferica rivista software">Modello/ Titolo</label><br>
                <input type="checkbox" class="libro" id="autore-checkbox" name="selettori[2]" value="autore">
                <label for="autore-checkbox" class="libro">Autore</label><br>
                <input type="checkbox" class="computer libro rivista" id="anno-checkbox" name="selettori[3]" value="anno">
                <label for="anno-checkbox" class="computer libro rivista">Anno</label><br>
                <input type="checkbox" class="libro rivista" id="casa-editrice-checkbox" name="selettori[4]" value="casa-editrice">
                <label for="casa-editrice-checkbox" class="libro rivista">Casa editrice</label><br>
                <input type="checkbox" class="computer software" id="sistema-operativo-checkbox" name="selettori[5]" value="sistema-operativo">
                <label for="sistema-operativo-checkbox" class="computer software">Sistema operativo</label><br>
                <input type="checkbox" class="computer libro periferica rivista software" id="note-checkbox" name="selettori[6]" value="note">
                <label for="note-checkbox" class="computer libro periferica rivista software">Note</label><br>
                <input type="checkbox" class="computer libro periferica rivista software" id="tag-checkbox" name="selettori[7]" value="tag">
                <label for="tag-checkbox" class="computer libro periferica rivista software">Tag</label><br>
            </fieldset>
        </div>

        <div class="row justify-content-center">
            <div class="col4">
                <button class="btn-ricerca"><a href="./search">Cerca</a></button>

            </div>
        </div>
    </form>

</div>