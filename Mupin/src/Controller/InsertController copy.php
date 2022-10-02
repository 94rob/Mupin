<?php
declare(strict_types=1);

namespace App\Controller;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Controller\ControllerInterface;
use App\Service\Implementations;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class InsertController implements ControllerInterface
{
    protected Engine $plates;    
    public Implementations\MainService $mainService;


    public function __construct(Engine $plates)
    {
        $this->plates = $plates;        
        $this->mainService = new Implementations\MainService();
    }

    public function execute(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        session_start();        
        $tabella = $request->getAttribute('tabella');  
        $className = "App\Models\\" . ucfirst($tabella);
        $model = new ${"className"}();

        // Se è una chiamata GET restituisce il template di inserimento di un oggetto
        if($request->getMethod() == 'GET'){
            return new Response(
                200,
                [],
                    $this->plates->render('item-insert', [
                    'model' => $model, 
                    'tabella' => $tabella        
                ])
            );
        }
       

        // Se è una chiamata POST inserisce effettivamente l'oggetto nel DB        
        if($request->getMethod() == 'POST'){
            
            $insertSuccess = $this->mainService->insertItemIntoTable($_POST, $tabella, $_FILES);            

            // Se la insert ha avuto successo, ritorna la lista degli articoli aggiornata con l'ultimo inserimento
            $className = $tabella . "Service";               
            $arr = $this->mainService->selectAllFromTable($tabella);
            $result[$tabella] = $arr;

            if($insertSuccess){   
                $idCatalogo = $_POST["ID_CATALOGO"];
                $log = new Logger('insert'); 
                $log->pushHandler(new StreamHandler('./public/log/file.log', Logger::INFO));
                $log->info("User " . $_SESSION["user"] . " added item " . $idCatalogo . "(". ucfirst($tabella) .")");
                return new Response(
                    200,
                    [],
                        $this->plates->render('select-results', [
                        'result' => $result     
                    ])
                );
            } else {
                return new Response(
                    500,
                    [],
                        $this->plates->render('select-results', [
                        'result' => $result     
                    ])
                );
            }
        }

        // Se non è una GET nè una POST, ritorno un Bad Request
        return new Response(400,  [], "" );
    }
}