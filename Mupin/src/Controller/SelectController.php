<?php
declare(strict_types=1);

namespace App\Controller;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Controller\ControllerInterface;
use App\Service\Implementations;

class SelectController implements ControllerInterface
{
    protected Engine $plates;    
    protected Implementations\ComputerService $computerService;
    protected Implementations\LibroService $libroService;
    protected Implementations\PerifericaService $perifericaService;
    protected Implementations\RivistaService $rivistaService;
    protected Implementations\SoftwareService $softwareService;

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
        $cosa_cercare = array_key_exists("cosa-cercare",$_GET) ? $_GET["cosa-cercare"] : "";
        
        if(($request->getAttribute('tabella') == null)&&($request->getAttribute('id-catalogo') == null)){
            $result = $this->selectAll($cosa_cercare);

            return new Response(
                200,
                [],
                $this->plates->render('select-results', [
                    'result' =>$result]
                    )
            ); 
        }

        if(($request->getAttribute('tabella') != null)&&($request->getAttribute('id-catalogo') == null)){
            $selettori = array_key_exists("selettori", $_GET) ? $_GET["selettori"] : [];
            
            $result = $this->routeSelect($request->getAttribute('tabella'), $cosa_cercare, $selettori);

            return new Response(
                200,
                [],
                $this->plates->render('select-results', [
                    'result' => $result]
                    )
            ); 
        }     

        // Da rivedere
        if($request->getAttribute('id-catalogo') != null){
            $result = $this->selectSingleItemByIdCatalogo($request->getAttribute('id-catalogo'));
            return new Response(
                200,
                [],
                $this->plates->render('item-select', [
                    'object' => $result[0]]
                    )
            );
        }
         
    }

    public function selectSingleItemByIdCatalogo(string $id){
        
        $result_array = [];
        array_push($result_array, $this->computerService->selectWhereColumnLikeInput("ID_CATALOGO", $id));        
        array_push($result_array, $this->libroService->selectWhereColumnLikeInput("ID_CATALOGO", $id));        
        array_push($result_array, $this->perifericaService->selectWhereColumnLikeInput("ID_CATALOGO", $id));        
        array_push($result_array, $this->rivistaService->selectWhereColumnLikeInput("ID_CATALOGO", $id));        
        array_push($result_array, $this->softwareService->selectWhereColumnLikeInput("ID_CATALOGO", $id)); 

        foreach($result_array as $arr){
            if (!empty($arr)){
                $result_array = $arr;
            }
        }


        return $result_array;
    }

    public function selectAll(string $cosa_cercare){
        $response_array = [];

        $response_array["computer"] = $this->computerService->selectFromComputerWhereWhateverLikeInput($cosa_cercare);
        $response_array["libro"] = $this->libroService->selectFromLibroWhereWhateverLikeInput($cosa_cercare);
        $response_array["rivista"] = $this->rivistaService->selectFromRivistaWhereWhateverLikeInput($cosa_cercare);
        $response_array["periferica"] = $this->perifericaService->selectFromPerifericaWhereWhateverLikeInput($cosa_cercare);
        $response_array["software"] = $this->softwareService->selectFromSoftwareWhereWhateverLikeInput($cosa_cercare);

        return $response_array;
    }

    public function routeSelect(string $dove_cercare, string $cosa_cercare, array $selettori): array{

        $response_array = [];

        switch ($dove_cercare) {

            case ("ovunque"):
                $response_array["computer"] = $this->computerService->selectFromComputerWhereWhateverLikeInput($cosa_cercare);
                $response_array["libro"] = $this->libroService->selectFromLibroWhereWhateverLikeInput($cosa_cercare);
                $response_array["rivista"] = $this->rivistaService->selectFromRivistaWhereWhateverLikeInput($cosa_cercare);
                $response_array["periferica"] = $this->perifericaService->selectFromPerifericaWhereWhateverLikeInput($cosa_cercare);
                $response_array["software"] = $this->softwareService->selectFromSoftwareWhereWhateverLikeInput($cosa_cercare);
                break;                

            case ("computer"):
                $response_array = $this->computerService->executeSelect($cosa_cercare, $selettori);
                break;

            case ("libro"):
                $response_array = $this->libroService->executeSelect($cosa_cercare, $selettori);
                break;

            case ("periferica"):
                $response_array = $this->perifericaService->executeSelect($cosa_cercare, $selettori);
                break;

            case ("rivista"):
                $response_array = $this->rivistaService->executeSelect($cosa_cercare, $selettori);
                break;

            case ("software"):
               $response_array = $this->softwareService->executeSelect($cosa_cercare, $selettori);
               break;
        }

        return $response_array;
    }

    public function parseRequestBody(string $s): array{
        $req_array = explode('&', $s);
        $array = [];
        $array_new = [];
        foreach($req_array as $element){
            $couple = explode('=', $element);
            $array_new[$couple[0]] = [];  
            array_push($array, $couple);     
        }
        foreach($array as $e){
            array_push($array_new[$e[0]], $e[1]);
        }

        return $array_new;
    }

    
}