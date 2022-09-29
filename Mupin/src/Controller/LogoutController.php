<?php
declare(strict_types=1);

namespace App\Controller;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Controller\ControllerInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LogoutController implements ControllerInterface
{
    protected Engine $plates;

    public function __construct(Engine $plates)
    {
        $this->plates = $plates;
    }

    public function execute(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        session_start();
        session_destroy();
        session_unset();

        $log = new Logger('logout'); 
        $log->pushHandler(new StreamHandler('./public/log/file.log', Logger::INFO));
        $log->info("User " . $_SESSION["user"] . " logged out");

        session_start();
        return new Response(
            200,
            [],
            $this->plates->render('home')
        );
    }

    
}