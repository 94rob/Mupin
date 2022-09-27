<?php
declare(strict_types=1);

namespace App\Controller;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Controller\ControllerInterface;
use App\Service\Implementations;


class DeleteController implements ControllerInterface
{
    protected Engine $plates;
    public Implementations\ComputerService $computerService;
    public Implementations\LibroService $libroService;
    public Implementations\PerifericaService $perifericaService;
    public Implementations\RivistaService $rivistaService;
    public Implementations\SoftwareService $softwareService;


    public function __construct(Engine $plates)
    {
        $this->plates = $plates;
        $this->computerService = new Implementations\ComputerService();
        $this->libroService = new Implementations\LibroService();
        $this->perifericaService = new Implementations\PerifericaService();
        $this->rivistaService = new Implementations\RivistaService();
        $this->softwareService = new Implementations\SoftwareService();
    }

    public function execute(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $tabella = $request->getAttribute('tabella');
        $idCatalogo = $request->getAttribute('id-catalogo');

        switch ($tabella) {

            case ("computer"):
                $this->computerService->deleteFromComputer($idCatalogo);
                $result = "Ha funzionato";
                break;

            case ("libro"):
                $this->libroService->deleteFromLibro($idCatalogo);
                $result = "Ha funzionato";
                break;

            case ("rivista"):
                $this->rivistaService->deleteFromRivista($idCatalogo);
                $result = "Ha funzionato";
                break;

            case ("software"):
                $this->softwareService->deleteFromSoftware($idCatalogo);
                $result = "Ha funzionato";
                break;

            case ("periferica"):
                $this->perifericaService->deleteFromPeriferica($idCatalogo);
                $result = "Ha funzionato";
                break;

            default:
                http_response_code(500);
                
        }

        $className = $tabella . "Service";               
        $arr = $this->${"className"}->selectAll();
        $result[$tabella] = $arr;
        return new Response(
                200,
                [],
                $this->plates->render('select-results', [
                'result' => $result
                ])
            );
        
    }
}