<?php
declare(strict_types=1);

namespace App\Controller;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Controller\ControllerInterface;
use App\Service\SelectService;
use App\Service\InsertService;
use App\Utils\Utils;

class InsertController implements ControllerInterface
{
    protected Engine $plates;
    protected Utils $utils;
    protected InsertService $insertService;
    protected SelectService $selectService;


    public function __construct(Engine $plates)
    {
        $this->plates = $plates;
        $this->insertService = new InsertService();
        $this->selectService = new SelectService();
        $this->utils = new Utils();
    }

    public function execute(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        session_start();
        $table = $request->getAttribute('tabella');        

        // HTTP GET -> restituisce il template di inserimento di un oggetto
        if ($request->getMethod() == 'GET') {            
            $model = $this->utils->getObjectByModelName($table);
            $response = new Response(200, [], $this->plates->render('item-insert', [
                'model' => $model,
                'tabella' => $table
            ]));
        }

        // HTTP POST -> inserisce effettivamente l'oggetto nel DB        
        if ($request->getMethod() == 'POST') {            

            $insertOutput = $this->insertService->insertItemIntoTable($_POST, $table, $_FILES);

            switch($insertOutput){
                case (0):
                    $response = new Response( 500, [], $this->plates->render('debug', [
                        'result' => "Ops..l'operazione non è andata a buon fine"
                    ]));
                    break;
                
                case (1):
                    $result = $this->selectService->selectAllFromTable($table);
                    
                    $response = new Response( 200, [], $this->plates->render('select-results', [
                        'result' => $result
                    ]));
                    break; 
                            
                case (2):
                    $response = new Response( 400, [], $this->plates->render('debug', [
                        'result' => "L'id inserito è già registrato. Sceglierne un altro"
                    ]));
                    break;                           

                case (3):
                    $response = new Response( 400, [], $this->plates->render('debug', [
                        'result' => "I campi obbligatori non sono stati compilati"
                    ]));
                    break;
                }            
        }
        return $response;
    }
}
