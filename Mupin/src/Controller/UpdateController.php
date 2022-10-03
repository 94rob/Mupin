<?php
declare(strict_types=1);

namespace App\Controller;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Controller\ControllerInterface;
use App\Service\UpdateService;
use App\Service\SelectService;

class UpdateController implements ControllerInterface
{
    protected Engine $plates;
    protected UpdateService $updateService;
    protected SelectService $selectService;

    public function __construct(Engine $plates)
    {
        $this->plates = $plates;
        $this->updateService = new UpdateService();
        $this->selectService = new SelectService();
    }

    public function execute(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        session_start();
        $table = $request->getAttribute('tabella');
        $id = $request->getAttribute('id-catalogo');

        // HTTP GET -> restituisce template di update
        if ($request->getMethod() == "GET") {

            $result = $this->selectService->selectById($id, $table);                      

            $response = new Response(200, [], $this->plates->render('item-update', [
                'tabella' => $table,
                'object' => $result[0]
            ]));
        }

        // HTTP POST -> effettua l'update nel db
        if ($request->getMethod() == "POST") {
            session_start();
            
            // eseguo l'update solo se sono stati inseriti dei dati
            $updateSuccess = empty($_POST) ? true : $this->updateService->updateTableWhereIdCatalogoLikeInput($table, $id, $_POST, $_FILES);
            $result = $this->selectService->selectAllFromTable($table);

            $response = $updateSuccess ?    new Response( 200, [], $this->plates->render('select-results', [
                                                'result' => $result
                                            ]))
                                                :
                                            new Response( 500, [], $this->plates->render('debug', [
                                                'result' => "Ops..l'operazione non è andata a buon fine"
                                            ]));            
        }
        return $response;
    }
}