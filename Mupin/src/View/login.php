<?php $this->layout('layout-private', ['title' => 'Area riservata']); 
if($autenticazioneFallita === true){
    echo "<p style='color:red'>Credenziali errate</p>";
}
?>



<form action="./login" method="post" autocomplete="off" id="myform">

    <div class="row justify-content-center">
        <div class="col-6 align-self-center">
            <label for="email" class="login-label"> Email </label>
            <input class="textbox" type="email" id="email" name="email">
            <br />
            <label for="password" class="login-label"> Password </label>
            <input class="textbox" type="password" id="password" name="password">
            <br />
            <button class="btn-ricerca" type="submit" onclick="login()"> Log in </button>

        </div>
    </row>
</form>