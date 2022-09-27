<?php
declare(strict_types=1);
namespace App\Service\Implementations;
require 'vendor/autoload.php';

use App\Repository\UserRepository;
use PDO;

class UserService
{
    public UserRepository $userRepository;

    public function __construct(){
        $config = include 'config.php';
        $pdo = new PDO($config['dsn'], $config['username'], $config['password']);
        $this->userRepository = new UserRepository($pdo);
    }

    public function verifyPassword(string $email, string $password){
        $userpass = $this->userRepository->selectPassByEmail($email);
        return $userpass;
        if (password_verify($password, $userpass[0]["PASSWORD"])){
            return true;
        } else {
            return false;
        }
    }
}