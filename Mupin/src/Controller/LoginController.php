<?php
declare(strict_types=1);

namespace App\Controller;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Controller\ControllerInterface;
use App\Service\UserService;

class LoginController implements ControllerInterface
{
    protected Engine $plates;
   
    public function __construct(Engine $plates)
    {
        $this->plates = $plates;        
    }

    public function execute(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        $userService = new UserService();      

        if($userService->verifyPassword($email, $password)){
            return new Response(
                200,
                [],
                $this->plates->render('reserved-area')
            );
        } else {
            return new Response(
                200,
                [],
                $this->plates->render('login', [
                    'autenticazioneFallita' => true                                 
                ])
            );
        }
        
    }
}
