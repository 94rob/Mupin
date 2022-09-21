<?php
declare(strict_types=1);

namespace Mupin\Controller;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Controller\ControllerInterface;
use Mupin\Service\ServiceRouter;

class Search implements ControllerInterface
{
    protected Engine $plates;
    protected ServiceRouter $serviceRouter;

    public function __construct(Engine $plates)
    {
        $this->plates = $plates;
        $this->serviceRouter = new ServiceRouter();
    }

    public function execute(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        
        $req = $request->getBody()->__toString();
        $req_array = $this->parseBody($req);

        $result = $this->serviceRouter->find($req_array["cosa_cercare"], $req_array["dove_cercare"], $req_array["selettori"]);
        
        return new Response(
            200,
            [],
            $this->plates->render('show', [
                'req' =>$result]
                )
        );
    }

    public function parseBody(string $s): array{
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