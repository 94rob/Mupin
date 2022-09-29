<?php
declare(strict_types=1);

namespace App\Controller;
require 'vendor/autoload.php';

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Controller\ControllerInterface;
use App\Service\Implementations\UserService;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

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
            $email = $_POST["email"];
            $password = $_POST["password"];
            
            $verifyPassword = $this->userService->verifyPassword($email, $password); 

            $_SESSION["user"] = $email;
            $_SESSION["logged"] = true;

            $log = new Logger('login'); 
            $log->pushHandler(new StreamHandler('./public/log/file.log', Logger::INFO));
            $log->info("User " . $email . " logged in");
            $response = new Response(200, [], $this->plates->render('reserved-area'), "");
            // if($verifyPassword === true){               
                
            //     $_SESSION["logged"] = true;
            //     $response = new Response(200, [], $this->plates->render('reserved-area'));
            // } else {              
            //     // $pass = password_hash("pippo", PASSWORD_BCRYPT);
            //     // $result = password_verify($pass, '$2y$10$RdFWo9Fm8mxJreVj3bH2Zee3AzVajCsILSmiz7LLI1XbZXO5Wq3ly');
            //     $response = new Response( 200, [], $this->plates->render('login', [ 'autenticazioneFallita' => true]));
            // }
        }
        
        return $response;
    }
}
