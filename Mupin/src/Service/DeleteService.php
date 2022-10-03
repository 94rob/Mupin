<?php

declare(strict_types=1);

namespace App\Service;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require 'vendor/autoload.php';

class DeleteService extends ModelService{ 
        
    public function deleteFromTableByIdCatalogo(string $table, string $id): bool
    {        
        $deleteSuccess = $this->deleteRepo->deleteFromTableById($table, $id);
        if($deleteSuccess){
            $this->imageService->deleteAllImages($id);
            $log = new Logger('login'); 
            $log->pushHandler(new StreamHandler('./public/log/file.log', Logger::INFO));
            $log->info("User " . $_SESSION["user"] . " deleted item " . $id . "(". ucfirst($table) .")");
        }
        return $deleteSuccess;
    }
}