<?php $this->layout('layout', ['title' => 'Home Mupin']) ?>



<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cerca.css">
    <script src="cerca.js"></script>
    <title>Mupin</title>
</head>

<body>
    <form action="./search" method="post">
        <fieldset>
            <label for="input">Cosa vuoi cercare?</label>
            <input type="text" id="input" name="input"><br/>
        </fieldset>

        <fieldset>
            <legend>Dove vuoi cercare?</legend>
            <input type="radio" id="ovunque-checkbox" name="dove-cercare" value="ovunque">
            <label for="ovunque-checkbox">Ovunque</label><br>
            <input type="radio" id="computer-checkbox" name="dove-cercare" value="computer">
            <label for="computer-checkbox">Computer</label><br>
            <input type="radio" id="periferica-checkbox" name="dove-cercare" value="periferica">
            <label for="periferica-checkbox">Periferica</label><br>
            <input type="radio" id="rivista-checkbox" name="dove-cercare" value="rivista">
            <label for="rivista-checkbox">Rivista</label><br>
            <input type="radio" id="software-checkbox" name="dove-cercare" value="software">
            <label for="software-checkbox">Software</label><br>
        </fieldset>

        <fieldset>
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

        <button type="submit">Cerca</button>

    </form>



</body>


