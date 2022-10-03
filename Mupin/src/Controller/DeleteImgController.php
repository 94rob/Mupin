<?php
declare(strict_types=1);

namespace App\Controller;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Controller\ControllerInterface;

class DeleteImgController implements ControllerInterface
{
    protected Engine $plates;

    public function __construct(Engine $plates)
    {
        $this->plates = $plates;
    }

    public function execute(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $id = $request->getAttribute("id-catalogo");
        $img = $_POST["img"];

        $path = __DIR__ . "/../../public/img/" . $img;
        $seEliminato = unlink($path)? "true" : "false";
        
        return  new Response(200,[], $path);        
    }
}
