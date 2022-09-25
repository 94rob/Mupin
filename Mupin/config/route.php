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
    [ 'POST', '/search', [ Controller\SearchController::class ]],
    [ 'GET', '/search', [ Controller\SearchController::class ]], 
    ['GET', '/{idCatalogo}', [Controller\ItemController::class]] 
    

];
