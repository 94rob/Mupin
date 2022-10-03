<?php
declare(strict_types=1);

namespace App\Controller;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Controller\ControllerInterface;
use App\Service\DeleteService;
use App\Service\SelectService;

class DeleteController implements ControllerInterface
{
    protected Engine $plates;
    protected DeleteService $deleteService;
    protected SelectService $selectService;


    public function __construct(Engine $plates)
    {
        $this->plates = $plates;
        $this->deleteService = new DeleteService();
        $this->selectService = new SelectService();
    }

    public function execute(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        session_start();
        $table = $request->getAttribute('tabella');
        $id = $request->getAttribute('id-catalogo');

        $deleteSuccess = $this->deleteService->deleteFromTableByIdCatalogo($table, $id);

        $result = $this->selectService->selectAllFromTable($table); 

        $response = $deleteSuccess ?    new Response( 200, [], $this->plates->render('select-results', [
                                        'result' => $result
                                        ]))
                                            :
                                        new Response( 500, [], $this->plates->render('debug', [
                                            'result' => "Ops..l'operazione non è andata a buon fine"
                                        ]));  
        return $response;                     
    }
}