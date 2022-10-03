<?php
declare(strict_types=1);
namespace App\Service;
require 'vendor/autoload.php';

use App\Repository\UserRepository;
use PDO;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class UserService
{
    public UserRepository $userRepository;

    public function __construct(){
        $config = include 'db-config.php';
        $pdo = new PDO($config['dsn'], $config['username'], $config['password']);
        $this->userRepository = new UserRepository($pdo);
    }

    public function verifyPassword(string $email, string $password): bool{
        
        $userpass = $this->userRepository->selectPassByEmail($email);        

        if(gettype($userpass) == "string") return false; 
          
        return password_verify($password, $userpass[0]["PASSWORD"]);
    }

    public function login(string $email, string $password): bool
    {        
        $verified = $this->verifyPassword($email, $password);        
        if($verified){
            $_SESSION["user"] = $email;
            $_SESSION["logged"] = true;
    
            $log = new Logger('login'); 
            $log->pushHandler(new StreamHandler('./public/log/file.log', Logger::INFO));
            $log->info("User " . $email . " logged in");
        }
        return $verified;
    }

    public function logout(){       

        $log = new Logger('logout'); 
        $log->pushHandler(new StreamHandler('./public/log/file.log', Logger::INFO));
        $log->info("User " . $_SESSION["user"] . " logged out");
        session_destroy();
        session_unset();
        session_start();
    }
}