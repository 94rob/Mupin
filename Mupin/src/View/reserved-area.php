<?php

$this->layout('layout-private', [
    'title' => 'Area Riservata'
]);

session_start();
$_SESSION["logged"] = true;
?>

<form action="" method="" id="form-private">
    <table>
        <tr>
            <td><button type="button" class="btn btn-primary" onclick="cerca()">Cerca</button></td>
            <td><button type="button" class="btn btn-info" onclick="inserisci()">Inserisci</button> </td>
        </tr>
        <tr>
            <td>
                <select class="form-select" name="dove-cercare" id="search-select">
                    <option selected>Ovunque</option>
                    <option value="computer">Computer</option>
                    <option value="libro">Libri</option>
                    <option value="periferica">Periferiche</option>
                    <option value="software">Software</option>
                    <option value="rivista">Riviste</option>
                </select>
            </td>
            <td>
                <select class="form-select" name="dove-cercare" id="insert-select">
                    <option value="computer" selected>Computer</option>                   
                    <option value="libro">Libri</option>
                    <option value="periferica">Periferiche</option>
                    <option value="software">Software</option>
                    <option value="rivista">Riviste</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <label for="input-txt">Inserisci parola chiave</label>
                <input type="text" id="input-txt" name="cosa-cercare">
            </td>
        </tr>

    </table>
    </div>
</form>
<script>
    function inserisci(){
        tabella = document.getElementById("insert-select").value;
        document.getElementById("form-private").action = "/insert/" + tabella;        
        document.getElementById("form-private").method = "GET";        
        document.getElementById("form-private").submit();
    }

    function cerca(){
        tabella = document.getElementById("search-select").value;
        document.getElementById("form-private").action = "/search/" + tabella;        
        document.getElementById("form-private").method = "GET";        
        document.getElementById("form-private").submit();
    }
</script>