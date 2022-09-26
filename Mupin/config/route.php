<?php
declare(strict_types=1);

use App\Controller;
use SimpleMVC\Controller\BasicAuth;

return [
    [ 'GET', '/', Controller\HomeController::class ],    

    // Area riservata
    [['GET','POST'], '/login', [Controller\LoginController::class]],    

    // Ricerca    
    [ 'POST', '/search', [ Controller\SelectController::class ]],
    [ 'GET', '/search/{idCatalogo}', [ Controller\SelectController::class ]],      

    // Modifica
    ['POST', '/modifica/{tabella}/{id-catalogo}', [Controller\UpdateController::class]], 

    // Calcellazione
    ['GET', '/delete/{tabella}/{id-catalogo}', [Controller\DeleteController::class]]

];
