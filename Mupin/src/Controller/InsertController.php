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
        session_start();
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
            $idCatalogo = $_POST["id-catalogo"];

            // popolo l'oggetto
            foreach($_POST as $key => $value){
                $newKey = str_replace("-", "_", strtoupper($key));
                $array[$newKey] = $value;                
            }

            // eseguo la insert
            $service = $tabella . "Service";
            $method = "insertInto" . ucfirst($tabella);
            $this->${"service"}->${'method'}($array);

            // aggiungo l'immagine
            if((array_key_exists("img", $_FILES)) && ($_FILES["img"]["size"] != 0)){
                
                
                $temp = explode("/", $_FILES["img"]['type']);
                $ext = $temp[1];

                $path =$_SERVER['DOCUMENT_ROOT']."/img";                               
                $fileName = $path . "/" . $idCatalogo. "_0." . $ext;

                file_put_contents($fileName, file_get_contents($_FILES["img"]["tmp_name"]));

                
            }

            // ritorno la lista degli oggetti di quella categoria, aggiornata
            $className = $tabella . "Service";               
            $arr = $this->${"className"}->selectAll();
            $result[$tabella] = $arr;

            // Aggiorno il file di log
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