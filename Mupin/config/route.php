<?php
declare(strict_types=1);

use App\Controller;
use SimpleMVC\Controller\BasicAuth;

return [
    [ 'GET', '/', Controller\HomeController::class ],    

    // Area riservata
    ['GET', '/authenticate', [Controller\AuthenticateController::class]],
    [ 'POST', '/login', [ Controller\LoginController::class ]], 

    // Ricerca    
    [ 'POST', '/search', [ Controller\SelectController::class ]],
    [ 'GET', '/search', [ Controller\SelectController::class ]], 
    ['GET', '/{idCatalogo}', [Controller\ItemController::class]], 

    // Modifica
    ['POST', '/modifica/{tabella}/{id-catalogo}', [Controller\UpdateController::class]], 

    // Calcellazione
    ['GET', '/delete/{tabella}/{id-catalogo}', [Controller\DeleteController::class]]

];
