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
        $log = new Logger('delete'); 
        $log->pushHandler(new StreamHandler('./public/log/file.log', Logger::INFO));
        if($deleteSuccess){
            $this->imageService->deleteAllImages($id);
            $log->info("User " . $_SESSION["user"] . " deleted item " . $id . "(". ucfirst($table) .")");
        } else {
            $log->info("User " . $_SESSION["user"] . " failed to delete item " . $id . "(". ucfirst($table) .")");
        }
        return $deleteSuccess;
    }
}