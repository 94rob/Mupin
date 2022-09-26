<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\ComputerService as ServiceComputerService;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Controller\ControllerInterface;
use App\Service\UpdateRouter;


class UpdateController implements ControllerInterface
{
    protected Engine $plates;  
    protected UpdateRouter $updateRouter;  

    public function __construct(Engine $plates)
    {
        $this->plates = $plates;
        $this->updateRouter = new UpdateRouter();
    }

    public function execute(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $tabella = $request->getAttribute('tabella');
        $idCatalogo = $request->getAttribute('id-catalogo');        

        if($this->updateRouter->selectRightQuery($tabella, $idCatalogo, $_POST)){
            $result = "Ha funzionato";
        }else{
            $result = "Non ha funzionato";
        }

               

        return new Response(
            200, 
            [],
            $this->plates->render('modifica', [
                'result' => $result
                 
                ])
        );
    }
}