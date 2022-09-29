<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\ComputerService as ServiceComputerService;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Controller\ControllerInterface;
use App\Service\UpdateRouter;
use App\Service\Implementations;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class UpdateController implements ControllerInterface
{
    protected Engine $plates;
    protected Implementations\ComputerService $computerService;
    protected Implementations\LibroService $libroService;
    protected Implementations\PerifericaService $perifericaService;
    protected Implementations\RivistaService $rivistaService;
    protected Implementations\SoftwareService $softwareService;
    protected UpdateRouter $updateRouter;

    public function __construct(Engine $plates)
    {
        $this->plates = $plates;
        $this->computerService = new Implementations\ComputerService();
        $this->libroService = new Implementations\LibroService();
        $this->perifericaService = new Implementations\PerifericaService();
        $this->rivistaService = new Implementations\RivistaService();
        $this->softwareService = new Implementations\SoftwareService();
        $this->updateRouter = new UpdateRouter();
    }

    public function execute(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        
        $tabella = $request->getAttribute('tabella');
        $idCatalogo = $request->getAttribute('id-catalogo');

        if ($request->getMethod() == "GET") {

            $object = $this->selectSingleItemByIdCatalogo($idCatalogo);
            $response = new Response(
                    200,
                    [],
                    $this->plates->render('item-update', [
                    'tabella' => $tabella,
                    'object' => $object[0]
                    ])
                );
            } else

        if($request->getMethod() == "POST") {
            session_start();
            if( (array_key_exists("img", $_FILES)) && ($_FILES["img"]["size"] != 0)){
                
                
                $temp = explode("/", $_FILES["img"]['type']);
                $ext = $temp[1];

                $path =$_SERVER['DOCUMENT_ROOT']."/img";
                $num = count(glob($path . "/" . $idCatalogo . "*"));                
                $fileName = $path . "/" . $idCatalogo. "_" . $num . "." . $ext;

                file_put_contents($fileName, file_get_contents($_FILES["img"]["tmp_name"]));

                $log = new Logger('add-image'); 
                $log->pushHandler(new StreamHandler('./public/log/file.log', Logger::INFO));
                $log->info("User " . $_SESSION["user"] . " added image " . basename($fileName) . " to item " . $idCatalogo);
            }
            
            if ($this->updateRouter->selectRightQuery($tabella, $idCatalogo, $_POST)) { 

                $log = new Logger('update'); 
                $log->pushHandler(new StreamHandler('./public/log/file.log', Logger::INFO));
                $log->info("User " . $_SESSION["user"] . " alter item " . $idCatalogo);

                $className = $tabella . "Service";               
                $arr = $this->${"className"}->selectAll();
                $result[$tabella] = $arr;
                $response = new Response(
                        200,
                        [],
                        $this->plates->render('select-results', [
                        'result' => $result
                        ])
                    );
                }
            }
            else {
                http_response_code(500);
            }

            return $response;
            
    }

    public function selectSingleItemByIdCatalogo(string $id)
    {

        $result_array = [];
        array_push($result_array, $this->computerService->selectWhereColumnLikeInput("ID_CATALOGO", $id));
        array_push($result_array, $this->libroService->selectWhereColumnLikeInput("ID_CATALOGO", $id));
        array_push($result_array, $this->perifericaService->selectWhereColumnLikeInput("ID_CATALOGO", $id));
        array_push($result_array, $this->rivistaService->selectWhereColumnLikeInput("ID_CATALOGO", $id));
        array_push($result_array, $this->softwareService->selectWhereColumnLikeInput("ID_CATALOGO", $id));

        foreach ($result_array as $arr) {
            if (!empty($arr)) {
                $result_array = $arr;
            }
        }


        return $result_array;
    }
}