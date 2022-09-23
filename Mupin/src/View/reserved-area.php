<?php $this->layout('layout', ['title' => 'Area Riservata', 
                                'section1' => '',  
                                'section2' => '']);

use App\Service\UserService;
$userService = new UserService();      

if($userService->verifyPassword($email, $password)){
    echo "Autenticazione riuscita!";
    http_response_code(200);
} else {
    echo "Autenticazione fallita";
    http_response_code(401);
    header("refresh:2; url=/home");
}


