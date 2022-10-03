<?php

declare(strict_types=1);

namespace App\Service;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require 'vendor/autoload.php';

class UpdateService extends ModelService{ 
   
    public function updateTableWhereIdCatalogoLikeInput(string $table, string $id, array $post, $files): bool{
        
        // creo un array con le colonne da modificare
        $columns = [];
        foreach($post as $key => $value){
            if(($value != "") && ($this->utils->stringToColumnName($key) != "ID_CATALOGO")){               
                $column = $this->utils->stringToColumnName($key);
                $columns[$column] = $value;
            }                                       
        } 

        $control = $this->updateRepo->executeUpdate($table, $columns, $id); 
        
        if($control){
            $log = new Logger('update');
            $log->pushHandler(new StreamHandler('./public/log/file.log', Logger::INFO));
            $log->info("User " . $_SESSION["user"] . " alter item " . $id . "(" . ucfirst($table) . ")");
            $this->imageService->insertImage($files, $id);            
        }
        return $control;
    }
}