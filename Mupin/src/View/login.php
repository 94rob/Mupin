<?php $this->layout('layout-public', ['title' => 'Login']);
if ($autenticazioneFallita === true) {
    echo "<p style='color:red'>Credenziali errate</p>";
}
?>


<div class="container" id="container-login">
    <form action="./login" method="post" autocomplete="off" id="form-login">

        <div class="row justify-content-center">
            <div class="col-6">
                <label for="email" class="login-label input-label"> Email </label>
                <input class="textbox" type="email" id="email" name="email">
                <br />
                <label for="password" class="login-label input-label"> Password </label>
                <input class="textbox" type="password" id="password" name="password">
                <br />
                <button class="btn-ricerca" type="submit"> Log in </button>
            </div>

        </div>
    </form>
</div>