<?php
declare(strict_types=1);

namespace App\Controller;
require 'vendor/autoload.php';

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Controller\ControllerInterface;
use App\Service\UserService;

class LoginController implements ControllerInterface
{
    protected Engine $plates;
    protected UserService $userService;
   
    public function __construct(Engine $plates)
    {
        $this->plates = $plates;     
        $this->userService = new UserService();   
    }

    public function execute(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        session_start();
        if($request->getMethod() == 'GET'){
            $response = new Response(200, [], $this->plates->render('login', ['autenticazioneFallita' => false]));
        }
        if($request->getMethod()=='POST'){ 
            $login = $this->userService->login($_POST["email"], $_POST["password"]);             
            
            $response = $login ?    new Response(200, [], $this->plates->render('reserved-area'), "") 
                                        : 
                                    new Response( 200, [], $this->plates->render('login', [ 'autenticazioneFallita' => true]));            
        }        
        return $response;
    }
}
