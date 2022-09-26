<?php
declare(strict_types=1);

namespace App\Controller;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Controller\ControllerInterface;
use App\Service\Implementations\ComputerService;


class ItemController implements ControllerInterface
{
    protected Engine $plates;
    protected ComputerService  $computerService;
    

    public function __construct(Engine $plates)
    {
        $this->plates = $plates;
        $this->computerService = new ComputerService();
        
    }

    public function execute(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $id = $request->getAttribute('idCatalogo');
        $computer_array = $this->computerService->selectWhereColumnLikeInput("ID_CATALOGO", $id);        

        return new Response(
            200, 
            [],
            $this->plates->render('item', [
                'computer_array' => $computer_array
                
                ])
        );
    }
}