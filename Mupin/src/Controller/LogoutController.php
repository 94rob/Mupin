<?php
declare(strict_types=1);

namespace App\Controller;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Controller\ControllerInterface;
use App\Service\UserService;

class LogoutController implements ControllerInterface
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
        $this->userService->logout();
        
        return new Response( 200, [], $this->plates->render('home'));
    }
}