<?php
declare(strict_types=1);

use App\Controller;
use SimpleMVC\Controller\BasicAuth;

return [
    [ 'GET', '/', Controller\HomeController::class ],    

    // Area riservata
    [['GET','POST'], '/login', [Controller\LoginController::class]],    

    // Ricerca    
    [ 'GET', '/search', [ Controller\SelectController::class ]],
    [ 'GET', '/search/{tabella}', [ Controller\SelectController::class ]],
    [ 'GET', '/search/{tabella}/{id-catalogo}', [ Controller\SelectController::class ]],      

    // Modifica    
    [['GET', 'POST'], '/modifica/{tabella}/{id-catalogo}', [Controller\UpdateController::class]], 

    // Cancellazione
    ['POST', '/delete/{tabella}/{id-catalogo}', [Controller\DeleteController::class]],

    // Inserimento
    ['GET', '/insert/{tabella}', [Controller\InsertController::class]]

];
