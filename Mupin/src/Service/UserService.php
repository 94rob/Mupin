<?php
declare(strict_types=1);
namespace App\Service;
require 'vendor/autoload.php';

use App\Repository\UserRepository;
use App\Models\Software;

class UserService
{
    public UserRepository $userRepository;

    public function __construct(){
        $this->userRepository = new UserRepository();
    }

    public function verifyPassword(string $email, string $password){
        $userpass = $this->userRepository->selectPassByEmail($email);
        if (password_verify($password, $userpass[0]["password"])){
            return true;
        } else {
            return false;
        }
    }
}