<?php

declare(strict_types=1);

namespace App\Controller;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Controller\ControllerInterface;
use App\Service\ModelService;
use App\Service\SelectService;

class SelectController implements ControllerInterface
{
    protected Engine $plates; 
    protected SelectService $selectService;
   

    public function __construct(Engine $plates)
    {
        $this->plates = $plates;        
        $this->selectService = new SelectService();
    }

    public function execute(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $input = array_key_exists("cosa-cercare", $_GET) ? $_GET["cosa-cercare"] : "";
        if($input == null){ 
            $input = "";
        }          

        // NO TABELLA - NO ID -> Selezione da tutto il catalogo
        if((($request->getAttribute('tabella') == null) || ($request->getAttribute('tabella') == 'undefined')) && ($request->getAttribute('id-catalogo') == null)){
            
            $result = ($input = "") ? $this->selectService->selectAllCatalogo() : $this->selectService->selectAllCatalogoByInput($input);            

            return new Response( 200, [], $this->plates->render( 'select-results',  [
                        'result' => $result
                    ]));
        }

        // SI TABELLA - NO ID -> Selezione da tabella singola con o senza selettori       
        if (($request->getAttribute('tabella') != null) && ($request->getAttribute('id-catalogo') == null)) {
            $selectors = array_key_exists("selettori", $_GET) ? $_GET["selettori"] : [];
            $table = $request->getAttribute('tabella');

            if($table === "ovunque"){
                $result = $this->selectService->selectAllCatalogoByInput($input);
            } else {                
                $result = $this->selectService->executeSelect($table, $input, $selectors);
            }           

            return new Response( 200, [], $this->plates->render( 'select-results',
                    [
                        'result' => $result
                    ]));
        }

        // SI TABELLA SI ID -> Selezione di un singolo item        
        if ($request->getAttribute('id-catalogo') != null) {
            $id = $request->getAttribute('id-catalogo');
            $table = $request->getAttribute('tabella');            
            $result = $this->selectService->selectById($id, $table);            
            return new Response( 200, [], $this->plates->render( 'item-select',
                    [
                        'object' => $result[0]
                    ]));
        }
        
        return new Response( 400, [], $this->plates->render( 'home'));
    }
}
