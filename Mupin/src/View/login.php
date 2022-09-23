<?php $this->layout('layout-public', ['title' => 'Login']) ?>



<form action="./login" method="post" autocomplete="off" id="myform">

    <label for="email"> Username: </label>
    <input type="email" id="email" name="email">
    <br />
    <label for="password"> Password: </label>
    <input type="password" id="password" name="password">
    <br />    
    <button class="btn btn-primary" type="submit" onclick="login()"> Log in </button>
</form>


