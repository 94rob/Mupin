<?php
declare(strict_types=1);

namespace App\Controller;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Controller\ControllerInterface;
use App\Service\Implementations;


class InsertController implements ControllerInterface
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
        $className = "App\Models\\" . ucfirst($tabella);
        $model = new ${"className"}();

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
        if($request->getMethod() == 'POST'){
            $array = [];
            // popolo l'oggetto
            foreach($_POST as $key => $value){
                $newKey = str_replace("-", "_", strtoupper($key));
                $array[$newKey] = $value;                
            }

            // eseguo la insert
            $service = $tabella . "Service";
            $method = "insertInto" . ucfirst($tabella);
            $this->${"service"}->${'method'}($array);

            // ritorno la lista degli oggetti di quella categoria, aggiornata
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
        
        // switch ($tabella) {

        //     case ("computer"):
        //         $this->computerService->insertIntoComputer($idCatalogo);
        //         $result = "Ha funzionato";
        //         break;

        //     case ("libro"):
        //         $this->libroService->deleteFromLibro($idCatalogo);
        //         $result = "Ha funzionato";
        //         break;

        //     case ("rivista"):
        //         $this->rivistaService->deleteFromRivista($idCatalogo);
        //         $result = "Ha funzionato";
        //         break;

        //     case ("software"):
        //         $this->softwareService->deleteFromSoftware($idCatalogo);
        //         $result = "Ha funzionato";
        //         break;

        //     case ("periferica"):
        //         $this->perifericaService->deleteFromPeriferica($idCatalogo);
        //         $result = "Ha funzionato";
        //         break;

        //     default:
        //         $result = "Non ha funzionato";
                
        // }


        
    }

    public function dashesToCamelCase($string, $capitalizeFirstCharacter = false) 
{

    $str = str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));

    // if (!$capitalizeFirstCharacter) {
    //     $str[0] = strtolower($str[0]);
    // }

    return $str;
}
}