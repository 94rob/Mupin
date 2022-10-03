<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\InsertService;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Controller\ControllerInterface;


class HomeController implements ControllerInterface
{
    protected Engine $plates;
    

    public function __construct(Engine $plates)
    {
        $this->plates = $plates;
    }

    public function execute(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        session_start();        

        $response = (( ! isset($_SESSION["logged"] )) || ( $_SESSION["logged"] == false )) ?
                    new Response(200, [], $this->plates->render('home'))
                        :
                    new Response(200, [], $this->plates->render('reserved-area'));
        
        return $response;
    }

    
}
