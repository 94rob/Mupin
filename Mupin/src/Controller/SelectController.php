<?php

declare(strict_types=1);

namespace App\Controller;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Controller\ControllerInterface;
use App\Service\Implementations;
use App\Service\Implementations\Service;

class SelectController implements ControllerInterface
{
    protected Engine $plates; 
    protected Service $service;

    public function __construct(Engine $plates)
    {
        $this->plates = $plates;        
        $this->service = new Service();
    }

    public function execute(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $cosa_cercare = array_key_exists("cosa-cercare", $_GET) ? $_GET["cosa-cercare"] : "";
        if($cosa_cercare == null){ 
            $cosa_cercare = "";
        }          

        // NO TABELLA - NO ID
        if((($request->getAttribute('tabella') == null) || ($request->getAttribute('tabella') == 'undefined')) && ($request->getAttribute('id-catalogo') == null)){
            $result = $this->service->selectFromAllTablesByInput($cosa_cercare);

            return new Response( 200, [], $this->plates->render( 'select-results',  [
                        'result' => $result
                    ]));
        }

        // SI TABELLA - NO ID       
        if (($request->getAttribute('tabella') != null) && ($request->getAttribute('id-catalogo') == null)) {
            $selettori = array_key_exists("selettori", $_GET) ? $_GET["selettori"] : [];
            $tabella = $request->getAttribute('tabella');

            if($tabella === "ovunque"){
                $result = $this->service->selectFromAllTablesByInput($cosa_cercare);
            } else {
                $result = $this->service->executeSelect($tabella, $cosa_cercare, $selettori);
            }           

            return new Response( 200, [], $this->plates->render( 'select-results',
                    [
                        'result' => $result
                    ]));
        }

        // SI TABELLA SI ID        
        if ($request->getAttribute('id-catalogo') != null) {
            $id = $request->getAttribute('id-catalogo');
            $tabella = $request->getAttribute('tabella');            
            $result = $this->service->executeSelect($tabella, $id, ["ID_CATALOGO"]);
            $object = $result[$tabella][0];
            return new Response( 200, [], $this->plates->render( 'item-select',
                    [
                        'object' => $object
                    ]));
        }
    }
}
