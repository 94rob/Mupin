<?php
declare(strict_types=1);

use App\Controller;
use SimpleMVC\Controller\BasicAuth;

return [
    [ 'GET', '/', Controller\HomeController::class ],    

    // AREA RISERVATA
    // Login
    [['GET','POST'], '/login', [Controller\LoginController::class]],   
    // Logout 
    [['GET'], '/logout', [Controller\LogoutController::class]],    

    // SELECT    
    [ 'GET', '/search', [ Controller\SelectController::class ]],
    [ 'GET', '/search/{tabella}', [ Controller\SelectController::class ]],
    [ 'GET', '/search/{tabella}/{id-catalogo}', [ Controller\SelectController::class ]],      

    // UPDATE   
    [['GET', 'POST'], '/modifica/{tabella}/{id-catalogo}', [Controller\UpdateController::class]], 

    // DELETE
    ['POST', '/delete/{tabella}/{id-catalogo}', [Controller\DeleteController::class]],

    // INSERT
    [['GET', 'POST'], '/insert/{tabella}', [Controller\InsertController::class]]

];
